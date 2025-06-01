<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'tbl_iv_purchase_orders';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = [
        'po_id',
        'merchantID',
        'po_number',
        'supplierID',
        'order_date',
        'status',
        'created_at',
        'delivery_address',
        'payment_terms',
        'expected_delivery_date',
        'actual_delivery_date',
        'shipping_details',
        'remarks',
        'approval_status'
    ];

    // A purchase order belongs to a supplier.
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplierID', 'supplier_id');
    }

    // A purchase order has many purchase order items.
    public function purchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'poID', 'po_id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantID', 'merchantID');
    }
}
