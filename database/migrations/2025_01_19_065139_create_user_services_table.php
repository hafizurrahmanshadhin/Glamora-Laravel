<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('user_services', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->boolean('selected')->default(false);
            $table->decimal('offered_price', 10)->nullable(false);
            $table->decimal('total_price', 10)->nullable(false);
            $table->string('image')->nullable();

            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();

            $table->index('status', 'idx_user_services_status');
            $table->index('service_id', 'idx_user_services_service_id');
            $table->index(['user_id', 'status'], 'idx_user_services_user_status');
            $table->index(['selected'], 'idx_user_services_selected');
            $table->index(['deleted_at', 'status'], 'idx_user_services_soft_delete_status');
            $table->index(['service_id', 'status'], 'idx_user_services_service_status');
            $table->index(['user_id', 'selected'], 'idx_user_services_user_selected');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('user_services');
    }
};
