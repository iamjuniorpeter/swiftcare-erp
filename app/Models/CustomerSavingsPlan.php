<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerSavingsPlan extends Model
{
    use HasFactory;
    
    // Define the table name
    protected $table = 'tbl_customer_savings_plan';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'customer_accountID',
        'savings_planID',
        'balance',
        'status',
        'created_at',
        'updated_at',
    ];

    // Disable timestamps
    public $timestamps = false;

    public function plans()
    {
        return $this->belongsTo(SavingsPlan::class, 'savings_planID', 'sn');
    }
}
