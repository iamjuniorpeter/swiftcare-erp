<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    
    // Define the table name
    protected $table = 'tbl_zone';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'zone_name',
        'code',
        'status',
        'created_at',
        'updated_at',
    ];

    // Disable timestamps
    public $timestamps = false;

    // Define relationships with other tables if needed

    public function customers()
    {
        return $this->hasMany(Customer::class, 'zoneID', 'sn');
    }
}

