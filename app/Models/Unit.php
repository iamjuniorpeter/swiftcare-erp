<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'tbl_iv_units';
    protected $primaryKey = 'sn';
    public $incrementing = true;

    protected $fillable = ['merchantID', 'unit_name', 'abbreviation'];

    // A unit can be assigned to many items.
    public function items()
    {
        return $this->hasMany(Item::class, 'unitID', 'sn');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantID', 'merchantID');
    }
}
