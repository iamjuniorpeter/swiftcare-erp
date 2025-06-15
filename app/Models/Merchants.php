<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $table = 'tbl_iv_merchants';
    protected $primaryKey = 'merchant_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'company_name',
        'contact_person',
        'email',
        'phone',
        'address',
        'state',
        'country',
        'website',
        'industry',
        'registration_number',
        'tax_id',
        'logo_url',
        'status'
    ];

    // Relationship: One merchant has many users
    public function users()
    {
        return $this->hasMany(User::class, 'merchantID', 'merchant_id');
    }
}
