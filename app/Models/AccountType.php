<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountType extends Model
{
    use HasFactory;
    
    // Define the table name
    protected $table = 'tbl_account_type';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'account_type',
        'code',
    ];

    // Disable timestamps
    public $timestamps = false;
}
