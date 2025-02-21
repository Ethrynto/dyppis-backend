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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('code', 100)
                ->unique();
            $table->char('symbol');
        });
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_id');      // From currency
            $table->foreign('from_id')
                ->references('id')
                ->on('currencies');

            $table->unsignedBigInteger('to_id');        // To currency
            $table->foreign('to_id')
                ->references('id')
                ->on('currencies');

            $table->float('value')
                ->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_rates');
        Schema::dropIfExists('currencies');
    }
};
