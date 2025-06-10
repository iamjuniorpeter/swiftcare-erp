<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'tbl_iv_subcategory';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = ['merchantID', 'categoryID', 'name', 'status'];

    // A category has many items
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryID', 'sn');
    }

    // A category belongs to a merchant
    public function items()
    {
        return $this->hasMany(Item::class, 'subCategoryID', 'sn');
    }

    // A category belongs to a merchant
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantID', 'merchantID');
    }
}
