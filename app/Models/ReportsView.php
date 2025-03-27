<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportsView extends Model {
    // Define the name of the view table
    protected $table = 'reports_views';

    // Since views are read-only
    // Prevents the model from trying to increment an ID field
    public $incrementing = false;
    // Views typically don't have timestamps
    public $timestamps = false;

    // Allow mass assignment for all columns
    protected $guarded = [];
}
