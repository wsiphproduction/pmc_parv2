<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class StockedItems extends Model
{

    public $table='stockedItemsMaster';

    protected $fillable = [
        'stock_type', 'inv_code','stock_code','description','oem_id','uom','uploaded_by','uploaded_at'
    ];

    public $timestamps = false;
       
}
