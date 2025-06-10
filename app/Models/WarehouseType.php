<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseType extends Model
{
    protected $table = 'tbl_iv_warehouses_type';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = ['merchantID', 'name', 'code'];

    // A unit can be assigned to many items.
    public function warehouse()
    {
        return $this->hasMany(Item::class, 'typeID', 'sn');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantID', 'merchantID');
    }
}
