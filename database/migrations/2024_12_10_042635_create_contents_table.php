<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['termsAndConditions', 'privacyPolicy', 'inclusionsCancellation'])->nullable(false);
            $table->string('title');
            $table->string('slug');
            $table->longText('content');

            $table->enum('status', ['active', 'inactive'])->default('active')->nullable(false);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('contents');
    }
};
