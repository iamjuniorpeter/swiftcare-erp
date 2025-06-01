<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerBankAccount extends Model
{
    use HasFactory;
    
    // Define the table name
    protected $table = 'tbl_customer_bank_account';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'customer_accountID',
        'bankID',
        'account_number',
        'account_name',
        'created_at',
        'updated_at',
    ];

    // Disable timestamps
    public $timestamps = false;

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bankID', 'sn');
    }
}
