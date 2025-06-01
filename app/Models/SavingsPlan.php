<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavingsPlan extends Model
{
    use HasFactory;
    
    // Define the table name
    protected $table = 'tbl_savings_plan';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'plan_name',
        'code',
        'amount',
        'plan_categoryID',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];

    // Disable timestamps
    public $timestamps = false;

    public function planCategory()
    {
        return $this->belongsTo(SavingsPlanCategory::class, 'plan_categoryID', 'sn');
    }
}
