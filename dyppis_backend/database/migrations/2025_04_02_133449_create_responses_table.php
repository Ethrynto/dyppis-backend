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
        Schema::create('responses', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();

            /* Response product */
            $table->uuid('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->text('value')
                ->nullable();

            $table->jsonb('value_json')
                ->nullable();

            $table->timestamp('created_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
