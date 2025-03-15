<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('booking_cancellation_after_appointments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id')->references('id')->on('bookings')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('canceled_by'); // The user who canceled
            $table->foreign('canceled_by')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('requested_by'); // The user who created the booking request
            $table->foreign('requested_by')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('booking_cancellation_after_appointments');
    }
};
