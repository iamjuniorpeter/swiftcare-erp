<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    
    // Define the table name
    protected $table = 'tbl_lga';

    // Define the primary key column name
    protected $primaryKey = 'sn';

    // Define mass-assignable columns
    protected $fillable = [
        'stateID',
        'lga_name',
    ];

    // Disable timestamps
    public $timestamps = false;

    public function state()
    {
        return $this->belongsTo(State::class, 'stateID', 'sn');
    }
}
