<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'tbl_iv_warehouses';
    protected $primaryKey = 'warehouse_id';
    public $incrementing = false;

    protected $fillable = ['warehouse_id', 'merchantID', 'name', 'typeID', 'location', 'contact_person', 'phone', 'email'];

    // A warehouse has many inventory records.
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'warehouseID', 'sn');
    }

    // And many transaction logs.
    public function warehouseType()
    {
        return $this->belongsTo(WarehouseType::class, 'typeID', 'sn');
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
