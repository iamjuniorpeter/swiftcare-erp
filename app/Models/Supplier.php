<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'tbl_iv_suppliers';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = ['supplier_id', 'merchantID', 'name', 'contact_person', 'phone', 'email', 'address', 'type', 'status', 'notes'];

    // A supplier can have many purchase orders.
    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class, 'supplierID', 'supplier_id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantID', 'merchantID');
    }
}
