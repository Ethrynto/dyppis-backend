<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            $table->string('slug')
                ->unique();

            /* Product title */
            $table->uuid('title_id');
            $table->foreign('title_id')
                ->references('id')
                ->on('translations');

            /* Product description */
            $table->uuid('description_id');
            $table->foreign('description_id')
                ->references('id')
                ->on('translations');

            /* Product price */
            $table->float('price')
                ->default(1);

            /* Product old price */
            $table->float('old_price')
                ->nullable();

            /* Product stocks */
            $table->integer('in_stock')
                ->default(1);

            /* Product rating */
            $table->float('rating')
                ->nullable();

            /* Product platform */
            $table->uuid('platform_id');
            $table->foreign('platform_id')
                ->references('id')
                ->on('platforms');

            /* Product category */
            $table->uuid('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            /* Product delivery */
            $table->uuid('delivery_id');
            $table->foreign('delivery_id')
                ->references('id')
                ->on('deliveries');

            $table->timestamp('verified_at')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
