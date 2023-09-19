<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;
use DB;



class parDetails extends Model
{
	protected $guarded = [
    	
    ];
    
	public $table='v_par_details';

	public function getRefcodeAttribute(){
		$ref = $this->parRefCode($this->header_id);
		return "{$ref}";
	}

	// Par Ref Code
	public function parRefCode($n){     
		$r=strlen($n);
		$e=6 - $r;
		$z="";
		for($x=1;$x<=$e;$x++){
			$z.="0";
		}
		$refcode=$z.$n;
		return $refcode;
	}

	public static function unreturned($id)
    {
        $par = parDetails::where('employee_id',$id)->where('status','OPEN')->first();
        
        return $par->qty;
    }

    public static function totalActiveAccountability(){
    	$total = parDetails::where('doc_status','<>','closed')->count();

    	return $total;
    }

    public static function docStatus($status){
    	$total = parDetails::where('doc_status',$status)->count();

    	return $total;

    }

	protected static function boot(){
		
		parent::boot();

		
		static::addGlobalScope('header_id', function (Builder $builder){
			if(Auth::user()->is_dept == 1){
				$builder->where('dept','=', Auth::user()->dept);
			}
			else {

			}
			
		});
	}
 	
}