<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemBatch extends Model
{
    protected $table = 'tbl_iv_item_batches';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = [
        'itemID',
        'batch_number',
        'warehouseID',
        'expiry_date',
        'quantity'
    ];

    /**
     * Get the item that this batch belongs to.
     * Note: We assume that the itemID in this table corresponds to the unique "item_id" field in the Item model.
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'itemID', 'item_id');
    }

    /**
     * Get the warehouse where this batch is stored.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouseID', 'sn');
    }

    public function usages()
    {
        return $this->hasMany(SalesOrderBatchItem::class, 'batchID', 'sn');
    }
}
