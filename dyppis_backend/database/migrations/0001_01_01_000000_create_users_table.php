<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->string('nickname', 100)
                ->unique();
            $table->string('email', 100)
                ->unique();
            $table->string('password');
            $table->float('balance')
                ->default(0);
            $table->float('rating')
                ->nullable();
            $table->uuid('avatar_id')
                ->nullable();
            $table->foreign('avatar_id')
                ->references('id')
                ->on('mediafiles');

            $table->string('register_ip', 50)
                ->nullable();

            $table->string('phone', 50)
                ->nullable();

            $table->string('seo_source', 100)
                ->nullable();

            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('user_logs', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->string('ip', 50)
                ->nullable();

            $table->integer('attempts')
                ->default(1);

            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::create('user_notifications', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->text('title');
            $table->fullText('title');

            $table->text('message');
            $table->fullText('message');

            $table->timestamp('read_at');

            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_logs');
        Schema::dropIfExists('user_notifications');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
