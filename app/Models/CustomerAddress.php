<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerAddress extends Model
{
    use HasFactory;
    
    // Define the table name
    protected $table = 'tbl_customer_address';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'customer_accountID',
        'house_no',
        'state_of_residenceID',
        'city',
        'residential_address',
        'postal_code',
        'major_landmark',
        'business_address',
        'created_at',
        'updated_at',
    ];

    // Disable timestamps
    public $timestamps = false;


    public function stateOfResidence()
    {
        return $this->belongsTo(State::class, 'state_of_residenceID', 'sn');
    }
}
