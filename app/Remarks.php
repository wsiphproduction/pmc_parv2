<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remarks extends Model
{
    public $table='remarks';

    protected $fillable = [
        'par_id', 'item_id', 'qty', 'remarks', 'reason', 'domain', 'closed_date', 'transfer_date', 'action'
    ];

    public $timestamps = false;
}