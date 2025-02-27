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
        /*
         * For the mediafile categories
         */
        Schema::create('mediafile_categories', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->string('slug', 100)
                ->unique();
            $table->string('title', 100);
            $table->string('path')
                ->nullable();
            $table->string('url')
                ->nullable();
            $table->timestamps();
        });

        /*
         * For the mediafiles
         */
        Schema::create('mediafiles', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->string('file_name');                // File name
            $table->string('file_type');                // File type (example image/png)
            $table->integer('file_size');               // File size (in bytes)
            $table->uuid('category_id');                // File category
            $table->foreign('category_id')
                ->references('id')
                ->on('mediafile_categories')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mediafiles');
        Schema::dropIfExists('mediafile_categories');
    }
};
