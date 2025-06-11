<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    
    // Define the table name
    protected $table = 'tbl_iv_customers';

    // Define the primary key column name
    protected $primaryKey = 'customer_id';
    public $incrementing = false;

    // Define mass-assignable columns
    protected $fillable = [
        'merchantID',
        'customer_id',
        'name',
        'email',
        'phone',
        'address',
        'contact_person',
        'status',

        'account_id',
        'account_no',
        'old_account_no',
        'other_names',
        'gender',
        'marital_status',
        'date_of_birth',
        'phone_1',
        'phone_2',
        'lga_of_originID',
        'state_of_originID',
        'is_employed',
        'zoneID',
        'account_officerID',
        'mothers_maiden_name',
        'remark',
        'avatar',
        'created_at',
        'updated_at',
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zoneID', 'sn');
    }

    public function accountOfficer()
    {
        return $this->belongsTo(Staff::class, 'account_officerID', 'account_id');
    }

    public function stateOfOrigin()
    {
        return $this->belongsTo(State::class, 'state_of_originID', 'sn');
    }

    public function lgaOfOrigin()
    {
        return $this->belongsTo(Lga::class, 'lga_of_originID', 'sn');
    }

    public function bankAccount()
    {
        return $this->hasOne(CustomerBankAccount::class, 'customer_accountID', 'account_id');
    }

    public function address()
    {
        return $this->hasOne(CustomerAddress::class, 'customer_accountID', 'account_id');
    }

    public function nextOfKin()
    {
        return $this->hasOne(CustomerNok::class, 'customer_accountID', 'account_id');
    }

    public function savingsPlan()
    {
        return $this->hasMany(CustomerSavingsPlan::class, 'customer_accountID', 'account_id');
    }
}
