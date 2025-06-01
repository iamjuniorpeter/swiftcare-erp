<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    
    // Define the table name
    protected $table = 'tbl_transaction';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'trans_reference',
        'customer_accountID',
        'account_officerID',
        'trans_typeID',
        'amount',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];

    // Disable timestamps
    public $timestamps = false;

    // Define relationships with other tables

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_accountID', 'account_id');
    }

    public function accountOfficer()
    {
        return $this->belongsTo(Staff::class, 'account_officerID', 'account_id');
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'trans_typeID', 'sn');
    }

    public function transactionMode()
    {
        return $this->belongsTo(TransactionMode::class, 'trans_modeID', 'sn');
    }
}
