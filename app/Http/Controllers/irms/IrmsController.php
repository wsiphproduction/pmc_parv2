<?php

namespace App\Http\Controllers\irms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;

use App\AccountabilityHeaders;
use App\accountabilityDetails;
use App\Employees;
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
        $ppeNo = $data['request_no'];
        $qty   = $data['qty'];

        $header = accountabilityHeaders::create([
            'ptype'          => 'new',
            'employee_id'    => $request->dept != '' ? 0 : $emp[0],
            'emp_name'       => $request->dept != '' ? '' : $emp[1],
            'dept_id'        => $emp[0] != '' ? 0 : $request->dept,
            'is_dept'        => $request->dept != '' ? '1' : '0',
            'dept'           => $emp[0] != '' ? $request->emp_dept : $request->dept,
            'document_date'  => $request->doc_date,
            'added_by'       => Auth::user()->domainAccount,
            'doc_status'     => 'saved',
            'safety'         => $request->safety,
            'p_location'     => $request->p_location,
            'p_site'         => $request->p_site,
            'doc_ref'        => $request->doc_ref,
        ]);

        if($header){
            foreach($items as $key => $i){
                if($i <> 0){
                    $items = new accountabilityDetails();
                    $items->header_id = $header->id;
                    $items->item = $i;
                    $items->is_new = 1;
                    $items->status = 'OPEN';
                    $items->qty = $qty[$key];
                    $items->irms_ref = $request->safety;
                    $items->is_lock = 0;
                    $items->added_by = Auth::user()->domainAccount;
                    $items->save();

                    DB::connection('sqlsrv_ppe')->update("update is_detail set qtyReleased = qtyReleased + '".$qty[$key]."' where id = '".$ppeNo[$key]."'");
                }
            }

            return redirect()->route('par/index')->with('success','PAR successfully submitted');
        }

    }

    
    public function index(){

        $requests = $this->api($limit = 20000);

        return view('irms.index',compact('requests'));
    }

    public function api($limit = 20, $searchon = false, $searchtxt = false){

        $url = env('IRMS_API', 'http://172.16.20.27/parv2/api/irms/par.php?xx=0');

        // if($offset<>0){
        //     $url.="&offset=".$offset;
        // }

        if($limit<>20){
            $url.="&limit=".$limit;
        }

        $json = file_get_contents($url);
        $obj = json_decode($json);        
        
        return $obj;

    }

    public function process($id,$emp){

        
        $irms = $this->requestedItems($id);

        return view('irms.process-irms',compact('irms','id','emp'));
    }


    public function requestedItems($id){

        $url = env('IRMS_API','http://172.16.20.27/parv2/api/irms/par-details.php?id='.$id);

        $json = file_get_contents($url);
        $obj  = json_decode($json);

        return $obj;
    }

    public static function balance_api($id){

        $url = env('IRMS_API','http://172.16.20.27/parv2/api/irms/par-details.php?id='.$id);

        $json = file_get_contents($url);
        $obj  = json_decode($json, true);

        return $obj;
        
    }

    
}
?>