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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            $table->string('slug')
                ->unique();

            $table->text('title');
            $table->fullText('title');

            $table->text('description');
            $table->fullText('description');

            $table->uuid('logo_id')
                ->nullable();
            $table->foreign('logo_id')
                ->references('id')
                ->on('mediafiles');

        });

        Schema::create('categories_deliveries', function (Blueprint $table) {
            $table->uuid('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->uuid('delivery_id');
            $table->foreign('delivery_id')
                ->references('id')
                ->on('deliveries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_deliveries');
        Schema::dropIfExists('deliveries');
    }
};
