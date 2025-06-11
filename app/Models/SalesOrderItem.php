<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrderItem extends Model
{
    protected $table = 'tbl_iv_sales_order_items';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = ['soi_id', 'merchantID', 'itemID', 'quantity', 'unit_price', 'customer_name', 'customer_email'];

    // A sales order item belongs to a sales order.
    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'soID', 'so_id');
    }

    // It references an item by its unique item_id.
    public function item()
    {
        return $this->belongsTo(Item::class, 'itemID', 'item_id');
    }
}
