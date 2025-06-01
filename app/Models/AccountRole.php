<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountRole extends Model
{
    use HasFactory;
    
    // Define the table name
    protected $table = 'tbl_account_role';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'role',
        'code',
        'account_categoryID',
    ];

    // Disable timestamps
    public $timestamps = false;

    // Define relationship with AccountCategory model
    public function accountCategory()
    {
        return $this->belongsTo(AccountCategory::class, 'account_categoryID', 'sn');
    }
}
