<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavingsPlanCategory extends Model
{
    use HasFactory;
    
    // Define the table name
    protected $table = 'tbl_savings_plan_category';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'category_name',
        'code',
        'created_at',
        'updated_at',
    ];

    // Disable timestamps
    public $timestamps = false;
}
