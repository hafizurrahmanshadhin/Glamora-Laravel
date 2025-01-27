<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('user_service_id');
            $table->foreign('user_service_id')->references('id')->on('user_services')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->enum('service_type', ['mobile_services', 'salon_services'])->nullable(false);
            $table->date('appointment_date')->nullable(false);
            $table->string('appointment_time')->nullable(false);
            $table->decimal('price', 10, 2)->nullable();

            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('bookings');
    }
};
