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
        Schema::create('platform_categories', function (Blueprint $table) {
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
        });

        Schema::create('platforms', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            $table->string('slug')
                ->unique();

            $table->string('title')
                ->unique();

            $table->uuid('logo_id')
                ->nullable();
            $table->foreign('logo_id')
                ->references('id')
                ->on('mediafiles');

            $table->uuid('category_id')
                ->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('platform_categories');

            $table->uuid('parent_id')
                ->nullable();
//            $table->foreign('parent_id')
//                ->references('id')
//                ->on('platforms');

            $table->integer('sales')
                ->default(0);

            $table->integer('views')
                ->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platforms');
        Schema::dropIfExists('platform_categories');
    }
};
