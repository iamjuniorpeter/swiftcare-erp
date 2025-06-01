<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;

    // Define the table name
    protected $table = 'tbl_bank';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    protected $fillable = [
        'bank_name',
        'branch',
        'sort_code',
        'status',
    ];
}
