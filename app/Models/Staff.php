<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;
    
    // Define the table name
    protected $table = 'tbl_staff';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'account_id',
        'surname',
        'first_name',
        'other_names',
        'date_of_birth',
        'phone_1',
        'phone_2',
        'email_address',
        'home_address',
        'status',
        'created_at',
        'updated_at',
    ];

    // Disable timestamps
    public $timestamps = false;
}
