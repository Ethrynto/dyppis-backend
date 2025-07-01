<?php

namespace App\Http\Controllers\Api\V1\ProductService;


use App\Http\Controllers\Controller;
use App\Models\ProductService\Attribute;
use App\Models\ProductService\Product;
use Illuminate\Http\Request;

class ProductFilterController extends Controller
{
    /**
     *  This method parses the filter value from the request.
     */
    private static function parseFilterValue($value)
    {
        if (strpos($value, '-') !== false) {
            // Range values can be in the format "min-max" or "min-" or "-max"
            list($min, $max) = explode('-', $value);
            return [
                'min' => $min === '' ? null : $min,
                'max' => $max === '' ? null : $max
            ];
        } elseif (strpos($value, ',') !== false) {
            // The list of values can be in the format "value1,value2,value3"
            return explode(',', $value);
        } else {
            // Alone value or single integer
            return $value;
        }
    }

    /**
     *  This method filters products based on various criteria such as category, platform, delivery, attributes, price range, reviews, and discounts.
     */
    public static function filterProducts(Request $request, int $size = 30)
    {
        $products = Product::query();

        // Filtering by category, platform, and delivery
        if ($request->has('category_id')) {
            $products->where('category_id', $request->input('category_id'));
        }

        if ($request->has('platform_id')) {
            $products->where('platform_id', $request->input('platform_id'));
        }

        if ($request->has('delivery_id')) {
            $products->where('delivery_id', $request->input('delivery_id'));
        }

        // Filtering by attributes
        $attributeFilters = $request->except(['category_id', 'platform_id', 'delivery_id', 'price', 'hasReviews', 'hasDiscount']);
        foreach ($attributeFilters as $slug => $value) {
            $attribute = Attribute::where('slug', $slug)->first();
            if ($attribute) {
                $parsedValue = self::parseFilterValue($value);
                $products->whereHas('attributeValues', function ($query) use ($attribute, $parsedValue) {
                    $query->where('attribute_id', $attribute->id);
                    if ($attribute->value_type === 'int') {

                        // Handle by integer range or single value
                        if (is_array($parsedValue) && isset($parsedValue['min'])) {
                            if ($parsedValue['min'] !== null) {
                                $query->where('value_int', '>=', $parsedValue['min']);
                            }
                            if ($parsedValue['max'] !== null) {
                                $query->where('value_int', '<=', $parsedValue['max']);
                            }
                        } else {
                            $query->where('value_int', $parsedValue);
                        }
                    } else {
                        // Handle by string, bool, enum
                        if (is_array($parsedValue)) {
                            $query->whereIn('value', $parsedValue);
                        } else {
                            $query->where('value', $parsedValue);
                        }
                    }
                });
            }
        }

        // Filtering by price range
        if ($request->has('price')) {
            $priceRange = self::parseFilterValue($request->input('price'));
            if (is_array($priceRange) && isset($priceRange['min'])) {
                if ($priceRange['min'] !== null) {
                    $products->where('price', '>=', $priceRange['min']);
                }
                if ($priceRange['max'] !== null) {
                    $products->where('price', '<=', $priceRange['max']);
                }
            }
        }

        // Filtering by reviews
        if ($request->has('hasReviews') && $request->input('hasReviews') === 'true') {
            $products->whereHas('users', function ($query) {
                $query->whereHas('reviews');
            });
        }

        // Filtering by discount
        if ($request->has('hasDiscount') && $request->input('hasDiscount') === 'true') {
            $products->whereNotNull('old_price');
        }

        // Get the filtered products
        $filteredProducts = $products->paginate($size);

        // TODO: remove this line in production
        for ($i = 0; $i < count($filteredProducts); $i++) {
            $filteredProducts[$i]->images = [
                [
                    'file_name' => 'cs-2.jpeg',
                    'file_type' => 'image/jpeg',
                    'file_size' => 8096,
                    'url' => 'http://127.0.0.1:8000/storage/uploads/images/products/cs-2.jpeg',
                ],
                [
                    'file_name' => 'gta-5.jpg',
                    'file_type' => 'image/jpg',
                    'file_size' => 8096,
                    'url' => 'http://127.0.0.1:8000/storage/uploads/images/products/gta-5.jpg',
                ],
                [
                    'file_name' => 'forza-horizon-5.jpeg',
                    'file_type' => 'image/jpeg',
                    'file_size' => 8096,
                    'url' => 'http://127.0.0.1:8000/storage/uploads/images/products/forza-horizon-5.jpeg',
                ]
            ];
        }

        return $filteredProducts;
    }
}
