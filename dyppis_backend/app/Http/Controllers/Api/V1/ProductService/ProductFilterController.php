<?php

namespace App\Http\Controllers\Api\V1\ProductService;


use App\Http\Controllers\Controller;
use App\Models\ProductService\Attribute;
use App\Models\ProductService\Product;
use Illuminate\Http\Request;

class ProductFilterController extends Controller
{
    /**
     * Функция для парсинга значений фильтров из GET-параметров
     */
    private static function parseFilterValue($value)
    {
        if (strpos($value, '-') !== false) {
            // Диапазон значений, например, "10-16" или "-9999"
            list($min, $max) = explode('-', $value);
            return [
                'min' => $min === '' ? null : $min,
                'max' => $max === '' ? null : $max
            ];
        } elseif (strpos($value, ',') !== false) {
            // Список значений, например, "silver,global,berkut"
            return explode(',', $value);
        } else {
            // Одиночное значение
            return $value;
        }
    }

    /**
     * Основной метод для фильтрации товаров
     */
    public static function filterProducts(Request $request, int $size = 30)
    {
        $products = Product::query();

        // Фильтрация по базовым полям: категория, платформа, способ доставки
        if ($request->has('category_id')) {
            $products->where('category_id', $request->input('category_id'));
        }

        if ($request->has('platform_id')) {
            $products->where('platform_id', $request->input('platform_id'));
        }

        if ($request->has('delivery_id')) {
            $products->where('delivery_id', $request->input('delivery_id'));
        }

        // Фильтрация по атрибутам
        $attributeFilters = $request->except(['category_id', 'platform_id', 'delivery_id', 'price', 'hasReviews', 'hasDiscount']);
        foreach ($attributeFilters as $slug => $value) {
            $attribute = Attribute::where('slug', $slug)->first();
            if ($attribute) {
                $parsedValue = self::parseFilterValue($value);
                $products->whereHas('attributeValues', function ($query) use ($attribute, $parsedValue) {
                    $query->where('attribute_id', $attribute->id);
                    if ($attribute->value_type === 'int') {

                        // Обработка диапазона или одиночного значения для int
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
                        // Обработка для string, bool, enum
                        if (is_array($parsedValue)) {
                            $query->whereIn('value', $parsedValue);
                        } else {
                            $query->where('value', $parsedValue);
                        }
                    }
                });
            }
        }

        // Фильтрация по цене
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

        // Фильтрация по наличию отзывов
        if ($request->has('hasReviews') && $request->input('hasReviews') === 'true') {
            $products->whereHas('users', function ($query) {
                $query->whereHas('reviews');
            });
        }

        // Фильтрация по наличию скидки
        if ($request->has('hasDiscount') && $request->input('hasDiscount') === 'true') {
            $products->whereNotNull('old_price');
        }

        // Получение отфильтрованных товаров
        $filteredProducts = $products->paginate($size);

        return $filteredProducts;
    }
}
