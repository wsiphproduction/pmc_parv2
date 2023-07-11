<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

use App\accountabilityDetails;
use App\parDetails;
use App\parRequests;

class Items_bk extends Model
{
    
    //public $table='v_all_items';
    public $table='items';

        public function accountabilityHeaders(){

        return $this->belongsTo('App\accountabilityHeaders','id','accountabilityHeader_id');

    }

    protected $guarded = [];

    public static function itemrefcodetemp($n,$y){
        $dd=date('Y-m-d');
        $r=strlen($n);
        $e=4 - $r;
        $z="";
        for($x=1;$x<=$e;$x++){
            $z.="0";
        }
        $refcode=date('y',strtotime($dd)).date('m',strtotime($dd)).$y.$z.$n;
        return $refcode;
    }

    public static function itemrefcode($category,$series,$created){
        $dd=$created;
        $r=strlen($series);
        $e = 4 - $r;
        $z="";
        for($x=1;$x<=$e;$x++){
            $z.="0";
        }
        $refcode=date('y',strtotime($dd)).date('m',strtotime($dd)).$category.$z.$n;
        return $refcode;
    }

    public static function get_category_series($category){

        $last = Items::where('is_deleted','=','0')->where('category','=',$category)->orderBy('categorySeries','desc')->first();

        if($last === null){
            $n = 1;
        }
        else{
            $n = $last->categorySeries + 1;
        }

        return $n;
    }

    // public static function get_item_type($category){
    //     if($category == 1){
    //         $type = 'PPE';
    //     } elseif($category == 2){
    //         $type = 'Tools';
    //     } elseif($category == 3){
    //         $type = 'CAPEX';
    //     } elseif($category == 4){
    //         $type = 'Others';
    //     }

    //     return $type;
    // }

    public static function count_items($id){
        $data = parDetails::where('item_id','=',$id)->where('doc_status','!=','cancelled')->count();

        return $data;
    }

    public static function check_if_open($tracking){
        $data = parRequests::where('par_id','=',$tracking)->where('is_approved','=',1)->count();

        return $data;
    }

    public static function get_header_id($id){
        $data = accountabilityDetails::where('item','=',$id)->first();

        return $data;
    } 
        
}
