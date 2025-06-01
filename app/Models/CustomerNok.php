<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerNok extends Model
{
    use HasFactory;
    
    // Define the table name
    protected $table = 'tbl_customer_nok';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'customer_accountID',
        'surname',
        'other_names',
        'relationship',
        'phone_number',
        'contact_address',
        'created_at',
        'updated_at',
    ];

    // Disable timestamps
    public $timestamps = false;

    // Define relationships with other tables if needed
}
