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

            $table->text('title')
                ->unique();
            $table->fullText('title');

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

            $table->text('title')
                ->unique();

            $table->fullText('title');

            $table->uuid('logo_id')
                ->nullable();
            $table->foreign('logo_id')
                ->references('id')
                ->on('mediafiles');

            $table->uuid('banner_id')
                ->nullable();
            $table->foreign('banner_id')
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
                ->nullable()
                ->default(0);

            $table->integer('views')
                ->nullable()
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
