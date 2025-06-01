<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'tbl_iv_inventory';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = ['inventory_id', 'merchantID', 'itemID', 'warehouseID', 'quantity', 'last_updated'];

    // Inventory belongs to an item. Here, we assume tbl_iv_inventory.itemID references tbl_iv_items.sn.
    public function item()
    {
        return $this->belongsTo(Item::class, 'itemID', 'sn');
    }

    // Inventory belongs to a warehouse.
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouseID', 'sn');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantID', 'merchantID');
    }
}
