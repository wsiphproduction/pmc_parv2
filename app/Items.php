<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

use App\accountabilityDetails;
use App\parDetails;
use App\parRequests;

class Items extends Model
{

    public $table='items';

    protected $fillable = [
        'stock_type', 'inv_code','stock_code','description','oem_id','uom', 'item_kind', 'expense_type', 'serial_no',
        'other_specs', 'cost', 'asset_code', 'po_no', 'dr_no', 'invoice_no', 'added_by', 'qty', 'is_verified'
    ];

    public $timestamps = true;

    public static function count_items($id){
        $data = parDetails::where('item_id','=',$id)->where('doc_status','!=','cancelled')->count();

        return $data;
    }

    // public static function check_if_open($tracking){
    //     $data = parRequests::where('par_id','=',$tracking)->where('is_approved','=',1)->count();

    //     return $data;
    // }

    public static function get_header_id($id){
        $data = accountabilityDetails::where('item','=',$id)->first();

        return $data;
    } 
       
    public static function check_item_status($id)
    {
        $data = Items::whereIn('id', function($query){ $query->select('item')->from('accountabilityDetails')->where('status','OPEN'); } )
            ->where('id',$id)
            ->get();

        if(count($data) > 0){
            return 0;
        } else {
            return 1;
        }
    }

    // public static function count_unverified_items()
    // {
    //     $count = Items::where('is_verified',0)->count();

    //     return $count;
    // }

    // public static function totalCost($id,$qty)
    // {
    //     $item = Items::where('id',$id)->first();

    //     return number_format($item->cost*$qty,2,'.','');
    // }

    public static function checkSerial($id){
        $item = accountabilityDetails::where('item', '=', $id)->where('status','OPEN')->count();

        if($item > 0){
            return 0;
        } else {
            return 1;
        } 
            
    }

    public static function totalItems(){
        $total = Items::count();

        return $total;
    }

    public static function itemType($type){
        $total = Items::where('item_kind',$type)->count();

        return $total;
    }

    public static function totalUnserveItems(){
        $total = Items::whereNotIn('id', function($query){ $query->select('item')->from('accountabilityDetails')->where('status','OPEN'); } )->count();

        return $total;
    }
}
