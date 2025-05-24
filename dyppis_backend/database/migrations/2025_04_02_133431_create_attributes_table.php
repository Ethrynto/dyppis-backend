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
        Schema::create('attributes', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            $table->string('slug')
                ->unique();

            $table->text('title');
            $table->fullText('title');

            $table->uuid('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->uuid('platform_id');
            $table->foreign('platform_id')
                ->references('id')
                ->on('platforms');

            $table->enum('value_type', ['int', 'string', 'bool', 'enum'])
                ->default('string');

            $table->jsonb('values')
                ->nullable();
            $table->timestamps();
        });

        Schema::create('attribute_values', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            $table->uuid('attribute_id');
            $table->foreign('attribute_id')
                ->references('id')
                ->on('attributes');

            $table->uuid('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products');

            $table->integer('value_int')
                ->nullable();

            $table->string('value')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('attributes');
    }
};
