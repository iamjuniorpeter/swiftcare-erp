<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    protected $table = 'tbl_iv_transactions_logs';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = [
        'merchantID',
        'itemID',
        'warehouseID',
        'transaction_type',
        'quantity',
        'reference',
        'remarks',
        'created_by',
        'transaction_date',
        'document_type',
        'document_id'
    ];

    // The transaction log belongs to an item (referenced by its unique item_id).
    public function item()
    {
        return $this->belongsTo(Item::class, 'itemID', 'item_id');
    }

    // It also belongs to a warehouse.
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouseID', 'sn');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantID', 'merchantID');
    }
}
