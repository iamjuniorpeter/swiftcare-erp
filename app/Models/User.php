<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    // Define the table name
    protected $table = 'tbl_user';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'username',
        'password',
        'accountID',
        'account_categoryID',
        'merchantID',
        'account_typeID',
        'account_roleID',
        'created_at',
        'updated_at',
    ];

    // Disable timestamps
    public $timestamps = false;

    // Define relationships with other tables

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'accountID', 'account_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'accountID', 'account_id');
    }

    public function accountType()
    {
        return $this->belongsTo(AccountType::class, 'account_typeID', 'sn');
    }

    public function accountRole()
    {
        return $this->belongsTo(AccountRole::class, 'account_roleID', 'sn');
    }

    public function accountCategory()
    {
        return $this->belongsTo(AccountCategory::class, 'account_categoryID', 'sn');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantID', 'merchant_id');
    }


}
