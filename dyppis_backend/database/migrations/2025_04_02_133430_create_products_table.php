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
            $table->text('title');
            $table->fullText('title');

            /* Product description */
            $table->text('description');
            $table->fullText('description');

            /* Product price */
            $table->integer('price')
                ->default(1);

            /* Product old price */
            $table->integer('old_price')
                ->nullable();

            /* Product stocks */
            $table->integer('in_stock')
                ->default(1);

            /* Product sales */
            $table->integer('sales')
                ->default(0);

            /* Product views */
            $table->integer('views')
                ->default(0);

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
