<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class accountabilityHeaders extends Model
{
	protected $guarded = [
    	
    ];

    protected $fillable = [
        'employee_id', 'dept_id','is_dept','bis_header_id','ref_par','document_date', 'added_by', 'po', 'doc_status',
        'safety', 'posted_by', 'posted_date', 'unpost_request', 'emp_name', 'p_location', 'p_site', 'doc_ref',
        'rq_no', 'ptype', 'dept', 'isContractor','notes', 'po_no', 'cis_si_no', 'serial_no'
    ];

	public $table='accountabilityHeaders';
    //public $table = 'v_all_par';

    public function items(){

   		return $this->hasMany('App\Items','accountabilityHeader_id');

   	}

   	public function getRefcodeAttribute(){
   		$ref = $this->parRefCode($this->id);
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

    public static function parHeaderId($n){     
        $r=strlen($n);
        $e=6 - $r;
        $z="";
        for($x=1;$x<=$e;$x++){
            $z.="0";
        }
        $refcode=$z.$n;
        return $refcode;
    }

    // public static function employee_status($employee){  
    //     $employees  = file_get_contents("http://172.16.20.27/parv2/api/employee-status.php?emp_id=".$employee);
    //     $array_result = explode('|',$employees);
        
    //     if(in_array($employee, $array_result)){
    //         return 1; // resigned
    //     } else {
    //         return 0; // active 
    //     }
    // }

   
    //end
    public $timestamps = true;
}