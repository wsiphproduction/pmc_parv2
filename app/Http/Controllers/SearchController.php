<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\StockedItems;
use App\parDetails;
use App\Items;
use App\Contractor;

class SearchController extends Controller
{   

    public function fecth_employee(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data  = file_get_contents("http://172.16.20.27/parv2/api/hris-api.php?emp=".$query);
            
            $output = '<ul class="dropdown-menu wd-100p" style="display:block; position:relative">';

            foreach (explode("|",$data) as $row) {
                $output .= $row;
        }
            $output .= '</ul>';

            echo $output;
        }
    }

    public function api_department(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data  = file_get_contents("http://172.16.20.27/parv2/api/hris-api.php?dept=".$query);
            
            $output = '<ul class="dropdown-menu wd-100p" style="display:block; position:relative">';

            foreach (explode("|",$data) as $row) {
                $output .= $row;
            }
            $output .= '</ul>';

            echo $output;
        }
    }

    public function api_contractor(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data  = Contractor::where('contractor_lname','LIKE',"$query%")->get();
            
            $output = '<ul class="dropdown-menu wd-100p" style="display:block; position:relative">';
            // <span style='display:none;'>=".$rowempdata['DeptDesc'].'</span>
            foreach ($data as $row) {
                $output .= "<li class='cont_li'><a href='#'>".$row->contractor_id." - ".$row->contractor_fname.",".$row->contractor_mname." ".$row->contractor_lname."</a></li>";
            }
            $output .= '</ul>';

            echo $output;
        }
    }

    public function fecth_accountable(Request $request)
    {
        if($request->get('query'))
        {   
            $output = "";

            $query = $request->get('query');
            $data  = parDetails::distinct()->select('emp_name')->where('emp_name','LIKE',"%$query%")->get();
            $count = $data->count();
            
            if($count > 0){
                
               $output .= '<ul class="dropdown-menu wd-100p" style="display:block; position:relative">';

                foreach ($data as $row) {
                    $output .= "<li class='emp_li'><a href='#'>".$row->emp_name."</a></li>";
                }
                $output .= '</ul>'; 
            } else {
                $output .= '<ul class="dropdown-menu wd-100p" style="display:block; position:relative"><li>Employee has no existing par</li></ul>';
            }
            

            echo $output;
        }
    }

    public function fetch_department(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data  = parDetails::distinct()->select('dept')->where('dept','LIKE',"$query%")->get();

            
            $output = '<ul class="dropdown-menu wd-100p" style="display:block; position:relative">';

            foreach ($data as $row) {
                $output .= "<li class='dept_li'><a href='#'>".$row->dept."</a></li>";
            }
            $output .= '</ul>';

            echo $output;
        }
    }

    public function fetch_item(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data  = Items::where('inv_code','=','SAF')->where('description','LIKE', "$query%")->orWhere('stock_code','LIKE', "$query%")->get();
            
            $output = '<ul class="dropdown-menu wd-100p" style="display:block; position:relative">';

            foreach ($data as $row) {
                $output .= "<li class='item_li_".$request->cNum."'><a href='#'>".$row->id." => ".$row->description." => ".$row->stock_code."</a></li>";
            }
            $output .= '</ul>';

            echo $output;
        }
    }

    public function items_to_par(Request $req)
    {

        $search = $req->search;
        $type = $req->ptype;

        if($type == 'transfer'){

            $items = Items::whereIn('id', function($query){ $query->select('item')->from('accountabilityDetails'); } )
                ->where('description','LIKE', "%$search%")
                ->orWhere('serial_no','LIKE',"%$search%")
                ->orWhere('stock_code','LIKE',"%$search%")
                ->orWhere('description', 'LIKE', "%$search%")
                ->get();

        } else {

            $items  = Items::where('description','LIKE',"%$search%")
                ->orWhere('serial_no','LIKE',"%$search%")                 
                ->orWhere('stock_code','LIKE',"%$search%")
                ->orWhere('description', 'LIKE', "%$search%")
                ->get();                

        }
        
        return view('search.items_to_par',compact('items','type'));
    }

    public function serial_check(Request $req)
    {
        $serial = Items::where('serial_no',$req->serial)->exists();

        if($serial){
            return 'Serial # '.$req->serial.' is already in the list.';
        } else {
            return 'none';
        }
    }

    // public function stock_code(Request $req){

    //     $search = $req->search;

    //     $items = StockedItems::where('stock_code','LIKE', "%$search%")->get();

    //     return view('search.stock_code',compact('items'));
    // }


    public function filter_stock_code_masterfile(Request $req){

        if($req->ajax()){

            if($req->oem_id != ''){
                $items = StockedItems::where('inv_code','LIKE',"$req->inv_code%")
                    ->where('stock_code','LIKE',"$req->stock_c%")
                    ->where('description','LIKE',"$req->dscrptn%")
                    ->where('oem_id','LIKE',"$req->oem_id%")
                    ->where('uom','LIKE',"$req->uom%")
                    ->get();
            } else {
                $items = StockedItems::where('inv_code','LIKE',"$req->inv_code%")
                    ->where('stock_code','LIKE',"$req->stock_c%")
                    ->where('description','LIKE',"$req->dscrptn%")
                    ->where('uom','LIKE',"$req->uom%")
                    ->get();
            }

            return view('search.filter_stocked_items',compact('items'));
        }  
    }

    public function filter_saved_stock_items(Request $req){
        
        if($req->ajax()){

            if($req->oemid != '' || $req->serial){
                $items = Items::where('item_kind','=',1)
                    ->where('stock_code','LIKE',"$req->scode%")
                    ->where('inv_code','LIKE',"$req->icode%")
                    ->where('description','LIKE',"$req->descr%")
                    ->where('serial_no','LIKE',"$req->serial%")
                    ->where('oem_id','LIKE',"$req->oemid%") 
                    ->where('uom','LIKE',"$req->uom%")
                    ->where('expense_type','LIKE',"$req->extyp%")
                    ->get();
            } else {
                $items = Items::where('item_kind','=',1)
                    ->where('stock_code','LIKE',"$req->scode%")
                    ->where('inv_code','LIKE',"$req->icode%")
                    ->where('description','LIKE',"$req->descr%")
                    ->where('uom','LIKE',"$req->uom%")
                    ->where('expense_type','LIKE',"$req->extyp%")
                    ->get();
            }
                return view('search.filter_saved_stocked_items',compact('items'));
            }  
    }

    public function filter_saved_nonstock_items(Request $req){
        
        if($req->ajax()){

            if($req->assetc != ''){
                $items = Items::where('item_kind','=',2)
                    ->where('id','LIKE',"$req->itemid%")
                    ->where('description','LIKE',"$req->dscptn%")
                    ->where('expense_type','LIKE',"$req->exptyp%")
                    ->where('serial_no','LIKE',"$req->serial%")
                    ->where('asset_code','LIKE',"$req->assetc%")
                    ->where('po_no','LIKE',"$req->po_num%")
                    ->where('dr_no','LIKE',"$req->dr_num%")
                    ->get();
            } else {
                $items = Items::where('item_kind','=',2)
                    ->where('id','LIKE',"$req->itemid%")
                    ->where('description','LIKE',"$req->dscptn%")
                    ->where('expense_type','LIKE',"$req->exptyp%")
                    ->where('serial_no','LIKE',"$req->serial%")
                    ->where('po_no','LIKE',"$req->po_num%")
                    ->where('dr_no','LIKE',"$req->dr_num%")
                    ->get();
            }
            return view('search.filter_saved_nonstock_items',compact('items'));
        }  
    }

    public function filter_par_list(Request $req){

        $par_details = parDetails::where('header_id','LIKE',"$req->header_id%")
            ->where('accountable','LIKE',"$req->accountable%")
            ->where('description','LIKE',"$req->description%")
            ->where('doc_status','LIKE',"$req->doc_status%")
            ->get();
            
        return view('search.par_search_result',compact('par_details')); 
    }

    

}
