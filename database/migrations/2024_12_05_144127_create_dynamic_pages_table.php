<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('dynamic_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable(false);
            $table->string('page_slug')->nullable(false);
            $table->longText('page_content')->nullable(false);

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
        Schema::dropIfExists('dynamic_pages');
    }
};
