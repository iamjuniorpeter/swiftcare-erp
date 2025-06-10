<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    // Specify the table name
    protected $table = 'tbl_iv_stock_movements';

    // Primary key column
    protected $primaryKey = 'reference';

    // Disable auto-incrementing if your PK is not 'id' (optional if using 'sn')
    public $incrementing = false;

    // Define date fields (for Carbon date handling)
    protected $dates = ['created_at', 'updated_at'];

    // Allow mass assignment for these fields
    protected $fillable = [
        'reference',
        'itemID',
        'batchID',
        'from_location',
        'to_location',
        'quantity',
        'movement_type',
        'created_by',
        'created_at',
        'updated_at'
    ];

    // Set timestamps to false if you’re manually managing them
    public $timestamps = false;
}
