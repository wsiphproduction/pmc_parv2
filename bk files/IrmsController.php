<?php

namespace App\Http\Controllers\irms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;

use App\AccountabilityHeaders;
use App\accountabilityDetails;
use App\Items;

class IrmsController extends Controller 
{   
    public function processIrmsRequest(){
        return view('irms.process-irms');
    }

    // Save IRMS in accountabilityHeaders table
    public function store(Request $request){
        
        $emp   = explode(' - ',$request->emp);
        $data  = $request->all();
        $items = $data['item_id'];
        $qty = $data['qty'];

        $header = accountabilityHeaders::create([
            'ptype'           => 'new',
            'employee_id'     => $emp[0],
            'emp_name'        => $emp[1],
            'dept_id'         => 0,
            'is_dept'         => 0,
            'document_date'   => $request->doc_date,
            'added_by'        => Auth::user()->domainAccount,
            'doc_status'      => 'saved',
            'safety'          => $request->safety,
            'p_location'      => $request->location,
            'p_site'          => $request->site,
            'doc_ref'        => $request->doc_ref
        ]);

        if($header){
            foreach($items as $key => $i){

                $item = explode(' => ',$i);

                $items = new accountabilityDetails();
                $items->header_id = $header->id;
                $items->item = $item[0];
                $items->is_new = 1;
                $items->status = 'OPEN';
                $items->qty = $qty[$key];
                $items->save();
            }

            return back()->with('success','PAR successfully submitted');
        }

    }

    

    public function index(){

        $requests = $this->api($offset = 30, $limit = 5);

        return view('irms.index',compact('requests'));
    }

    public function api($offset = 0, $limit = 20, $searchon = false, $searchtxt = false){

        $url = env('IRMS_API', 'http://172.16.20.43/parv2/api/irms/par.php?xx=0');

        if($offset<>0){
            $url.="&offset=".$offset;
        }

        if($limit<>20){
            $url.="&limit=".$limit;
        }

        $json = file_get_contents($url);
        $obj = json_decode($json);        
        
        return $obj;

    }

    public function process($id,$emp){

        
        $irms = $this->requestedItems($id);

        $items = Items::all();

        return view('irms.process-irms',compact('irms','items','id','emp'));
    }


    public function requestedItems($id){

        $url = env('IRMS_API','http://172.16.20.43/parv2/api/irms/par-details.php?id='.$id);

        $json = file_get_contents($url);
        $obj  = json_decode($json);

        return $obj;
    }

    public static function balance_api($id){

        $url = env('IRMS_API','http://172.16.20.43/irms/api/par-details.php?id='.$id);

        $json = file_get_contents($url);
        $obj  = json_decode($json, true);

        return $obj;
        
    }

    
}