<?php

namespace App\Http\Controllers\Par;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Auth;
use DB;

use App\accountabilityHeaders;
use App\accountabilityDetails;
use App\Departments;
use App\UserDetails;
use App\parRequests;
use App\parDetails;
use App\Employees;
use App\Items;
use App\Stock;

class ParController extends Controller {

    public function dashboard(){
        return view('par.home');
    }

    public function index(){

        $datas = parDetails::orderBy('header_id','desc')->paginate(10);

        return view('par.index',compact('datas'));

    }

    public function details($par){

        $par_details = parDetails::where('header_id','=',$par)->get();

        return view('par.details',compact('par_details'));

    }

    public function edit($id){

        $par_details = parDetails::where('header_id',$id)->get();

        return view('par.edit',compact('par_details'));

    }

    public function create(){

        return view('par.add');

    }

    public function store(Request $request){
        $emp = explode(' - ',$request->emp);
        $data = $request->all();
        $items = $data['item_id'];
        $costs = $data['cost'];
        //$rqs   = $data['rq']; 

        $header = accountabilityHeaders::create([
            'employee_id'     => $emp[0],
            'emp_name'        => $emp[1],
            'dept_id'         => $request->dept,
            'is_dept'         => $request->dept != '' ? '1' : '0',
            'ref_code'        => $request->ref_code,
            'document_date'   => $request->doc_date,
            'added_by'        => Auth::user()->domainAccount,
            'doc_status'      => 'saved',
            'safety'          => $request->safety_control_no,
            'unpost_request'  => 0
        ]);

        if($header){
            foreach($items as $key => $i){
                $items = new accountabilityDetails();
                $items->header_id = $header->id;
                $items->item = $i;
                $items->is_new = 1;
                $items->status = 'OPEN';
                $items->save();

                $it = Stock::find($i);
                $it->cost = $costs[$key];
                //$it->price = $costs[$key];
                //$it->rq = $rqs[$key];
                $it->save();  
            }

            if(isset($request->saveNew)){
                return back()->with('success','PAR successfully submitted');
            } else {
                return redirect()->route('par/index')->with('success','PAR successfully submitted');   
            }
        } else {
            return back()->with('failed','PAR submission failed');
        }
    }

    public function update(Request $req){
        $emp = explode(' - ',$req->emp);
        $data  = $req->all();
        $items = $data['item_id'];
        $costs = $data['cost'];
        // $rqs   = $data['rq']; 
        
        $header = accountabilityHeaders::where('id',$req->hid)->update([
            'employee_id'     => $emp[0],
            'emp_name'        => $emp[1],
            'dept_id'         => $req->dept,
            'is_dept'         => $req->dept != '' ? '1' : '0',
            'ref_code'        => $req->ref_code,
            'document_date'   => $req->doc_date,
            'safety'          => $req->safety_control_no,
            'ref_code'        => $req->ref_code
        ]);

        if($header){

            foreach($items as $key => $i){ 

                $items = accountabilityDetails::where('item', '=', $i)->exists();
                
                if($items){

                    $it = Stock::find($i);
                    $it->cost = $costs[$key];
                    //$it->rq = $rqs[$key];
                    $it->save();  

                } else {
                   
                    $items = new accountabilityDetails();
                    $items->header_id = $req->hid;
                    $items->item = $i;
                    $items->is_new = 1;
                    $items->status = 'OPEN';
                    $items->save();

                    $it = Stock::find($i);
                    $it->cost = $costs[$key];
                    //$it->rq = $rqs[$key];
                    $it->save();  

                }
            }
        }
        return back()->with('success','Par details successfully updated . . .');
    }

    public function post(Request $r){

        $post = accountabilityHeaders::find($r->pid)->update([
            'posted_by'  => 'rcnolasco',
            'doc_status' => 'posted',
            'posted_date'=> Carbon::today() 
        ]);

        if($post){
            return back()->with('success','Selected par posted successfully . . .');
        } else {
            return back()->with('failed', 'Error occur while posting par');
        }

    }

    public function cancel(Request $request){

        $header = accountabilityHeaders::find($request->pid)->update([ 'doc_status' => 'cancelled' ]);

        if($header){
            accountabilityDetails::where('header_id','=',$request->pid)->update([ 'status' => 'CLOSED' ]);
            return back()->with('success','Par cancelled successfully');
        } else {
            return back()->with('failed','Par Cancellation Failed');
        }

    }
//

    public function print($id){

        $items = parDetails::where('header_id',$id)->get();
       
        $total = 0;
        foreach ($items as $i) {
            $total += $i->cost;
        }

        return view('par.print',compact('items','total'));

    }

// Close Item
    public function close_item(Request $req){

        $close = accountabilityDetails::where('item',$req->tid)->where('header_id',$req->aid)->update([
            'closed_date' => Carbon::today(),
            'closed_by'   => Auth::user()->domainAccount,
            'closed_reason' => $req->reason,
            'status' => 'CLOSED',
            'new_condition' => $req->condition
        ]);

        if($close)
            return back()->with('success','Accountability successfully closed');
        else
            return back()->with('failed','Closing accountability failed');

    }
//

// Transfer Accountability
    public function auto_transfer_item(Request $req){

        $td = accountabilityHeaders::create([
            'employee_id'   => $req->emp_id,
            'dept_id'       => 0,
            'is_dept'       => 0,
            'bis_header_id' => $req->hid,
            'document_date' => Carbon::today(),
            'added_by'      => Auth::user()->domainAccount,
            'doc_status'    => 'posted',
            'safety'        => '',
            'posted_by'     => Auth::user()->domainAccount,
            'posted_date'   => Carbon::today()
        ]);

        $transfered = $this->transfer_items($req, $td);

        return back()->with('success','Accountability transfered successfully');

    }

    public function transfer_items($r,$t){

        accountabilityDetails::create([
            'header_id'     => $t->id,
            'item'          => $r->tid,
            'is_new'        => 0,
            'status'        => 'OPEN',
            'new_condition' => $r->new_condition
        ]);

        accountabilityDetails::where('item',$r->tid)->where('header_id',$r->hid)->update([
            'status' => 'CLOSED',
            'closed_date' => Carbon::today(),
            'closed_by' => 'AUTO - TRANSFER'
        ]);

    }
//

//  Manual Transfer
    public function transfer(){

        return view('par.transfer');
        
    }
            // store
    public function put(Request $request){
        $emp = explode(' - ',$request->emp);
        $data = $request->all();
        $items = $data['item_id'];
        $costs = $data['cost'];
        //$rqs   = $data['rq']; 

        $header = accountabilityHeaders::create([
            'employee_id'     => $emp[0],
            'emp_name'        => $emp[1],
            'dept_id'         => $request->dept,
            'is_dept'         => $request->dept != '' ? '1' : '0',
            'ref_code'        => $request->ref_code,
            'document_date'   => $request->doc_date,
            'added_by'        => Auth::user()->domainAccount,
            'doc_status'      => 'saved',
            'safety'          => $request->safety_control_no,
            'unpost_request'  => 0
        ]);

        if($header){
            foreach($items as $key => $i){
                $items = new accountabilityDetails();
                $items->header_id = $header->id;
                $items->item = $i;
                $items->is_new = 1;
                $items->status = 'OPEN';
                $items->save();

                $it = Stock::find($i);
                $it->cost = $costs[$key];
                //$it->price = $costs[$key];
                //$it->rq = $rqs[$key];
                $it->save();  
            }

            if(isset($request->saveNew)){
                return back()->with('success','PAR successfully submitted');
            } else {
                return redirect()->route('par/index')->with('success','PAR successfully submitted');   
            }
        } else {
            return back()->with('failed','PAR submission failed');
        }

    }

    
    public function manual_transfer_item(Request $rq){

        $today = Carbon::today();

        $query = accountabilityHeaders::create([
            'employee_id'   => $rq->emp_id,
            'dept_id'       => $rq->dept_id,
            'is_dept'       => ($rq->dept_id != 0) ? '1' : '0',
            'bis_header_id' => $rq->hid,
            'document_date' => $today,
            'added_by'      => 'rcnolasco',
            'doc_status'    => 'posted',
            'ref_code'      => $rq->ref_code,
            'safety'        => $rq->safety_control_no,
            'posted_by'     => 'rcnolasco',
            'posted_date'   => $today
        ]);

        $transfered = $this->manual_transfer_items($rq, $query);

        if($query)
            return back()->with('success','Accountability successfully transfered');
        else
            return back()->with('failed','Error occured while transfering accountability');
    }

    public function manual_transfer_items($r,$q){
        $today = Carbon::today();
        $i = 0;

        foreach($r->item_id as $it){
            $i++;

            accountabilityDetails::where('item',$r->item_id[$i])->update([
                'status' => 'CLOSED',
                'closed_date' => $today,
                'closed_by' => 'AUTO - TRANSFER'
            ]);

            accountabilityDetails::create([
                'item' => $r->item_id[$i],
                'header_id' => $q->id,
                'is_new' => 0,
                'status' => 'OPEN'
            ]);

            Items::findOrFail($it)->update([
                'price' => $r->cost[$i],
                'rq' => $r->rq[$i],
            ]);
        }
    }
//

    
}