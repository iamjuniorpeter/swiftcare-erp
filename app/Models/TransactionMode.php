<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMode extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'tbl_transaction_mode';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'trans_mode',
        'code',
        'created_at',
        'updated_at',
    ];
}
