<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class accountabilityDetails extends Model
{
	protected $guarded = [
    	
    ];

    protected $fillable = [
        'header_id', 'item','is_new','status','closed_reason','closed_date', 'closed_by', 'new_condition', 'irms_ref',
        'qty', 't_cost', 'is_lock', 'added_by'
    ];

	public $table='accountabilityDetails';
	//public $table = 'sp_select_items_per_par';

	public function par(){
    	return $this->belongsTo('App\accountabilityHeaders','header_id');
    }

    public static function countItemQty($id)
    {
        $qtys = accountabilityDetails::where('header_id',$id)->where('status','OPEN')->count();
        
        return $qtys;
    }

   /* public function items(){
        return $this->hasMany('App\Items','id','item');
    }*/

}