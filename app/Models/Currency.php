<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'tbl_currencies';
    protected $primaryKey = 'currency_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['currency_code', 'currency_name', 'exchange_rate'];
}
