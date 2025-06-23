<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('email', 200)->unique()->nullable(false)->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number', 25)->unique()->nullable(false)->index();
            $table->timestamp('phone_number_verified_at')->nullable();
            $table->string('password')->nullable();

            $table->text('address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('cover_photo')->nullable();

            $table->enum('availability', ['available', 'unavailable'])->default('available');
            $table->json('unavailable_ranges')->nullable();
            $table->json('weekend_data')->nullable();

            $table->enum('role', ['admin', 'client', 'beauty_expert'])->nullable(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('banned_until')->nullable();

            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();

            $table->index(['role', 'status'], 'idx_users_role_status');
            $table->index(['email_verified_at'], 'idx_users_email_verified_at');
            $table->index(['phone_number_verified_at'], 'idx_users_phone_verified_at');
            $table->index(['availability'], 'idx_users_availability');
            $table->index(['created_at'], 'idx_users_created_at');
            $table->index(['deleted_at', 'status'], 'idx_users_soft_delete_status');
            $table->index(['banned_until'], 'idx_users_banned_until');
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
    public function down(): void {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
