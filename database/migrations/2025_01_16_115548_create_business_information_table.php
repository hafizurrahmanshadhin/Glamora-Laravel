<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('business_information', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('avatar');
            $table->string('name', 100);
            $table->text('bio');
            $table->string('business_name', 100);
            $table->text('business_address');
            $table->string('professional_title', 100);
            $table->string('license');

            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 10, 8)->nullable();
            $table->string('address')->nullable();

            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();

            $table->index('user_id', 'idx_business_info_user_id');
            $table->index(['status', 'user_id'], 'idx_business_status_user');
            $table->index(['deleted_at', 'status'], 'idx_business_soft_delete_status');
            $table->index(['latitude', 'longitude'], 'idx_business_lat_lng');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('business_information');
    }
};
