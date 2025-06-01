<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountCategory extends Model
{

    use HasFactory;

    // Define the table name
    protected $table = 'tbl_account_category';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'category',
        'code',
    ];

    // Disable timestamps
    public $timestamps = false;
}
