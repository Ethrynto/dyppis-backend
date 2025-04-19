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
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            $table->string('slug')
                ->unique();

            $table->uuid('title_id');
            $table->foreign('title_id')
                ->references('id')
                ->on('translations');

            $table->uuid('logo_id')
                ->nullable();
            $table->foreign('logo_id')
                ->references('id')
                ->on('mediafiles');

            $table->boolean('is_public')
                ->default(false);
            $table->timestamps();
        });

        Schema::create('categories_platforms', function (Blueprint $table) {
            $table->uuid('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->uuid('platform_id');
            $table->foreign('platform_id')
                ->references('id')
                ->on('platforms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_platforms');
        Schema::dropIfExists('categories');
    }
};
