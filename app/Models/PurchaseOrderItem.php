<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    protected $table = 'tbl_iv_purchase_order_items';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = ['poi_id', 'poID', 'itemID', 'quantity', 'unit_price'];

    // A purchase order item belongs to a purchase order.
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'poID', 'po_id');
    }

    // It also references an item by its unique item_id.
    public function item()
    {
        return $this->belongsTo(Item::class, 'itemID', 'item_id');
    }
}
