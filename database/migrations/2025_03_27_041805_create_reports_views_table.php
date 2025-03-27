<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        DB::statement("
            CREATE OR REPLACE VIEW reports_views AS
            SELECT
                r.id,
                r.booking_id,
                r.message,
                r.status,
                r.created_at,
                r.updated_at,
                r.deleted_at,
                CONCAT(reporting.first_name, ' ', reporting.last_name) AS report_from,
                CONCAT(reported.first_name, ' ', reported.last_name) AS report_to
            FROM reports r
            LEFT JOIN users reporting ON r.user_id = reporting.id
            LEFT JOIN bookings b ON r.booking_id = b.id
            LEFT JOIN user_services us ON b.user_service_id = us.id
            LEFT JOIN users reported ON us.user_id = reported.id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('reports_views');
    }
};
