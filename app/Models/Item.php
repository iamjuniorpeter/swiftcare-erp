<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Item extends Model
{
    protected $table = 'tbl_iv_items';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = [
        'item_id',
        'merchantID',
        'item_code',
        'name',
        'description',
        'categoryID',
        'unitID',
        'status',
        'created_at',
        'updated_at',
        'cost_price',
        'selling_price',
        'barcode',
        'reorder_level'
    ];

    /**
     * Generate a unique item_id.
     *
     * Format: ITM-XXXXXXXX
     * where XXXXXXXX is an 8‑char uppercase alphanumeric string.
     *
     * @return string
     */
    public static function generateItemId()
    {
        do {
            $id = 'ITM-' . Str::upper(Str::random(8));
        } while (self::where('item_id', $id)->exists());

        return $id;
    }

    /**
     * Generate a unique item_code.
     *
     * Format: CODE-XXXXXX (6 chars)
     * @return string
     */
    public static function generateItemCode()
    {
        do {
            $code = 'CODE-' . Str::upper(Str::random(6));
        } while (self::where('item_code', $code)->exists());

        return $code;
    }

    // An item belongs to a category.
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryID', 'sn');
    }

    // An item belongs to a unit.
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unitID', 'sn');
    }

    // An item has many inventory records (using the primary key)
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'itemID', 'sn');
    }

    public function batches()
    {
        return $this->hasMany(ItemBatch::class, 'itemID', 'item_id');
    }


    // An item is referenced in purchase order items using its unique item_id.
    public function purchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'itemID', 'item_id');
    }

    // An item is referenced in sales order items using its unique item_id.
    public function salesOrderItems()
    {
        return $this->hasMany(SalesOrderItem::class, 'itemID', 'item_id');
    }

    // Transaction logs reference the item via its unique identifier.
    public function transactionLogs()
    {
        return $this->hasMany(TransactionLog::class, 'itemID', 'item_id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantID', 'merchantID');
    }
}
