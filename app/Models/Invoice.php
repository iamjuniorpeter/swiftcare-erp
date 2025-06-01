<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'tbl_invoices';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = [
        'invoice_id',
        'merchantID',
        'so_id',
        'invoice_date',
        'due_date',
        'total_amount',
        'paid_amount',
        'status'
    ];

    // An invoice belongs to a sales order.
    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'so_id', 'so_id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantID', 'merchantID');
    }
}
