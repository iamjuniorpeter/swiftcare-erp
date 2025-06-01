<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'tbl_iv_categories';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = ['merchantID', 'name', 'description'];

    // A category has many items
    public function items()
    {
        return $this->hasMany(Item::class, 'categoryID', 'sn');
    }

    // A category belongs to a merchant
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantID', 'merchantID');
    }
}
