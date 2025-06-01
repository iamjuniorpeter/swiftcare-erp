<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $table = 'tbl_merchants';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = [
        'merchantID',
        'name',
        'address',
        'phone',
        'email',
        'tax_identifier',
        'subscription_plan',
        'is_active',
        'created_at'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'merchantID', 'merchantID');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'merchantID', 'merchantID');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'merchantID', 'merchantID');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'merchantID', 'merchantID');
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class, 'merchantID', 'merchantID');
    }

    public function salesOrders()
    {
        return $this->hasMany(SalesOrder::class, 'merchantID', 'merchantID');
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class, 'merchantID', 'merchantID');
    }

    public function units()
    {
        return $this->hasMany(Unit::class, 'merchantID', 'merchantID');
    }

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class, 'merchantID', 'merchantID');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'merchantID', 'merchantID');
    }
}
