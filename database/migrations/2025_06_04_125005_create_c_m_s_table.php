<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('c_m_s', function (Blueprint $table) {
            $table->id();

            $table->enum('section', [
                'questionnaires',
                'join_us',
                'user-type-container',
                'user-dashboard',
                'home-page-banner',
                'question-mark-text',
                'profile-review-message',
                'home-counter',
            ])->nullable(false)->index();

            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
            $table->softDeletes();

            $table->index('section', 'idx_cms_section');
            $table->index(['section', 'status'], 'idx_cms_section_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('c_m_s');
    }
};
