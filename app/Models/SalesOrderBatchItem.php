<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrderBatchItem extends Model
{
    protected $table = 'tbl_iv_sales_order_batch_items';

    protected $fillable = [
        'sales_order_itemID',
        'batchID',
        'quantity',
    ];

    public $timestamps = true;

    public function orderItem()
    {
        return $this->belongsTo(SalesOrderItem::class, 'sales_order_itemID');
    }

    public function batch()
    {
        return $this->belongsTo(ItemBatch::class, 'batchID', 'sn');
    }
}
