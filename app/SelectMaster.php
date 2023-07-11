<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectMaster extends Model
{
    public $table='select_master_data';

    protected $fillable = [
        'code', 'description', 'select_option', 'is_active', 'added_by'
    ];

    public $timestamps = false;
}