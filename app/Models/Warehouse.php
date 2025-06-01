<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'tbl_iv_warehouses';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = ['warehouse_id', 'merchantID', 'name', 'location', 'contact_person', 'phone', 'email'];

    // A warehouse has many inventory records.
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'warehouseID', 'sn');
    }

    // And many transaction logs.
    public function transactionLogs()
    {
        return $this->hasMany(TransactionLog::class, 'warehouseID', 'sn');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantID', 'merchantID');
    }
}
