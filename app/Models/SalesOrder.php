<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $table = 'tbl_iv_sales_orders';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = [
        'so_id',
        'merchantID',
        'customerID',
        'so_number',
        'order_date',
        'status',
        'created_at',
        'billing_address',
        'shipping_address',
        'payment_method',
        'payment_status',
        'invoice_number',
        'discount_amount',
        'tax_amount',
        'total_amount',
        'delivery_method',
        'tracking_number',
        'expected_delivery_date'
    ];

    // A sales order belongs to a customer.
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerID', 'customer_id');
    }

    // A sales order has many sales order items.
    public function salesOrderItems()
    {
        return $this->hasMany(SalesOrderItem::class, 'soID', 'so_id');
    }

    // A sales order can have one invoice.
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'so_id', 'so_id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantID', 'merchantID');
    }
}
