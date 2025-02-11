<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('receiver_id');
            $table->foreign('receiver_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->text('text');

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
        Schema::dropIfExists('messages');
    }
};
