<?php

namespace App\Http\Controllers\Par;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Auth;
use DB;

use App\accountabilityHeaders;
use App\accountabilityDetails;
use App\SelectMaster;
use App\UserDetails;
use App\parDetails;
use App\Remarks;
use App\Items;
use App\Logs;

class ParController extends Controller {

    public function landing(){
        return view('landing');
    }

    public function dashboard(){
        $transactions = Logs::where('affected_field','doc_status')->orderBy('id','desc')->get();
        $items        = Logs::where('affected_field','qty')->orderBy('id','desc')->get();
        $activities   = Logs::orderBy('id','desc')->paginate(10);

        return view('par.home',compact('transactions','items','activities'));
    }

    public function index(Request $request){

        
        $close_data = SelectMaster::where('select_option','close_par')->orderBy('id','asc')->get();

        $datas = parDetails::orderBy('header_id', 'desc');

        if (request()->has('header_id')) {
            $accountable = request('header_id');
            $datas->where('header_id', 'like', "%$accountable%");
        }

        if (request()->has('accountable')) {
            $accountable = request('accountable');
            $datas->where('accountable', 'like', "%$accountable%");
        }
        
        if (request()->has('description')) {
            $description = request('description');
            $datas->where('description', 'like', "%$description%");
        }
        
        if (request()->has('doc_status')) {
            $docStatus = request('doc_status');
            $datas->where('doc_status', 'like', "%$docStatus%");
        }

        $datas = $datas->paginate(20);

        return view('par.index',compact('datas','close_data',));

    }

    public function details($par){

        $par_details = parDetails::where('header_id','=',$par)->get();

        return view('par.details',compact('par_details'));

    }

    public function items_per_employee($id){

        $datas = parDetails::where('employee_id',$id)->get();
        
        return view('par.items_per_employee',compact('datas'));
    }

    public function edit($id){

        $items = parDetails::where('header_id',$id)->get();
        $par   = accountabilityHeaders::where('id',$id)->first();
        $count_items = accountabilityDetails::where('header_id',$id)->count();

        return view('par.edit',compact('items','par','count_items'));

    }

    public function item_delete(Request $req){
        $item = accountabilityDetails::where('id',$req->id)->update([ 
            'added_by' => Auth::user()->domainAccount,
            'closed_reason' => $req->remarks
        ]);

        if($item){
            accountabilityDetails::find($req->id)->delete();
        }
        
        return back()->with('sucess','Item deleted successfully!');
    }

    public function recreate($id){

        $items = parDetails::where('header_id',$id)->get();
        $par   = accountabilityHeaders::where('id',$id)->first();

        return view('par.recreate_par',compact('items','par'));

    }

    public function create(){

        return view('par.add');

    }

    public function store(Request $request){
        if(isset($request->emp)){
            $emp = explode(' - ',$request->emp);
        }

        if(isset($request->cont)){
            $emp = explode(' - ',$request->cont);
        }
        //dd($request->all());
        $data  = $request->all();
        $items = $data['item_id'];
        $costs = $data['cost'];
        //$cost = $data['tcost'];
        $qty = $data['qty'];
        $today = Carbon::today();

        if($request->par_type == 'new'){

            $header = accountabilityHeaders::create([
                'ptype'           => 'new',
                'employee_id'     => $request->dept != '' ? 0 : $emp[0],
                'emp_name'        => $request->dept != '' ? '' : $emp[1],
                'dept_id'         => $request->emp != '' ? 0 : $request->dept,
                'is_dept'         => $request->dept != '' ? '1' : '0',
                'dept'            => $request->emp != '' ? $request->emp_dept : $request->dept,
                'document_date'   => $request->doc_date,
                'added_by'        => Auth::user()->domainAccount,
                'doc_status'      => 'saved',
                'p_location'      => $request->location,
                'p_site'          => $request->site,
                'doc_ref'         => $request->doc_ref,
                'isContractor'    => $request->cont != '' ? '1' : '0' ,
                'po_no'           => $request->po_no ,
                'cis_si_no'       => $request->cis_si_no , 
                'serial_no'       => $request->serial_no
            ]);

            if($header) {

                foreach($items as $key => $i){
                    $items = new accountabilityDetails();
                    $items->header_id = $header->id;
                    $items->item = $i;
                    $items->is_new = 1;
                    $items->status = 'OPEN';
                    $items->qty = $qty[$key];
                    $items->t_cost = $costs[$key];
                    $items->is_lock = 0;
                    $items->added_by = Auth::user()->domainAccount;
                    $items->save(); 
                }

                return redirect()->route('par/index')->with('success','PAR successfully submitted');
            }
        } else {

            $query = accountabilityHeaders::create([
                'ptype'           => 'transfer',
                'employee_id'     => $request->dept != '' ? 0 : $emp[0],
                'emp_name'        => $request->dept != '' ? '' : $emp[1],
                'dept_id'         => $request->emp != '' ? 0 : $request->dept,
                'is_dept'         => $request->dept != '' ? '1' : '0',
                'dept'            => $request->emp != '' ? $request->emp_dept : $request->dept,
                'document_date'   => $request->doc_date,
                'added_by'        => Auth::user()->domainAccount,
                'doc_status'      => 'saved',
                'safety'          => $request->safety,
                'p_location'      => $request->location,
                'p_site'          => $request->site,
                'doc_ref'        => $request->doc_ref,
                'posted_by'       => Auth::user()->domainAccount,
                'posted_date'     => $today,
                'isContractor'    => $request->cont != '' ? '1' : '0' ,
                'po_no'           => $request->po_no ,
                'cis_si_no'       => $request->cis_si_no , 
                'serial_no'       => $request->serial_no
            ]);

            if($query){

                foreach($items as $key => $i){

                    $this->close_transfered_item($qty[$key],$i,$req->refpar);

                    accountabilityDetails::where('item',$i)->where('status','=','OPEN')->update([
                        // 'status' => 'CLOSED',
                        'closed_date' => $today,
                        'closed_by' => 'manual transfer'
                    ]);

                    $items = new accountabilityDetails();
                    $items->header_id = $query->id;
                    $items->item = $i;
                    $items->is_new = 1;
                    $items->status = 'OPEN';
                    $items->qty = $qty[$key];
                    $items->t_cost = $costs[$key];
                    $items->is_lock = 0;
                    $items->save();

                }

                return redirect()->route('par/index')->with('success','Accountability successfully transfered');
            }
        }

    }

    public function update(Request $request){
        $emp   = explode(' - ',$request->emp);
        $data  = $request->all();
        $items = $data['item_id'];
        $costs = $data['cost'];
        $qty = $data['qty'];
        $today = Carbon::today();
        
        $header = accountabilityHeaders::where('id',$request->hid)->update([
            'employee_id'    => $request->dept != '' ? 0 : $emp[0],
            'emp_name'       => $request->dept != '' ? '' : $emp[1],
            'dept_id'        => $emp[0] != '' ? 0 : $request->dept,
            'is_dept'        => $request->dept != '' ? '1' : '0',
            'dept'           => $emp[0] != '' ? $request->emp_dept : $request->dept,
            'document_date'  => $request->doc_date,
            'added_by'       => Auth::user()->domainAccount,
            'safety'         => $request->safety,
            'p_location'     => $request->location,
            'p_site'         => $request->site,
            'doc_ref'        => $request->doc_ref,
            'po_no'           => $request->po_no ,
            'cis_si_no'       => $request->cis_si_no , 
            'serial_no'       => $request->serial_no
        ]);

        if($header){

            foreach($items as $key => $i){ 

                $items = accountabilityDetails::where('item', '=', $i)->where('header_id',$request->hid)->exists();
                
                if($items){

                    accountabilityDetails::where('header_id',$request->hid)->where('item',$i)->update([
                        'qty' => $qty[$key],
                        't_cost' => $costs[$key]
                    ]);

                } else {
                   
                    $items = new accountabilityDetails();
                    $items->header_id = $request->hid;
                    $items->item = $i;
                    $items->is_new = 1;
                    $items->status = 'OPEN';
                    $items->qty = $qty[$key];
                    $items->t_cost = $costs[$key];
                    $items->save();

                }
            }
        }
        return redirect()->route('par/index')->with('success','Par details successfully updated . . .');
    }

    public function adjustments(Request $request){
        $emp   = explode(' - ',$request->emp);
        $data  = $request->all();
        $items = $data['item_id'];
        $costs = $data['cost'];
        $qty = $data['qty'];
        $today = Carbon::today();

        $header = accountabilityHeaders::create([
            'ptype'           => 'adjustment',
            'bis_header_id'   => $request->hid,
            'employee_id'     => $request->dept != '' ? 0 : $emp[0],
            'emp_name'        => $request->dept != '' ? '' : $emp[1],
            'dept_id'         => $emp[0] != '' ? 0 : $request->dept,
            'is_dept'         => $request->dept != '' ? '1' : '0',
            'dept'            => $emp[0] != '' ? $request->emp_dept : $request->dept,
            'document_date'   => $request->doc_date,
            'added_by'        => Auth::user()->domainAccount,
            'doc_status'      => 'adjustment',
            'safety'          => $request->safety,
            'p_location'      => $request->location,
            'p_site'          => $request->site,
            'doc_ref'         => $request->doc_ref
        ]);

        if($header){
            foreach($items as $key => $i){
                $items = new accountabilityDetails();
                $items->header_id = $header->id;
                $items->item = $i;
                $items->is_new = 1;
                $items->status = 'OPEN';
                $items->qty = $qty[$key];
                $items->t_cost = $costs[$key];
                $items->is_lock = 0;
                $items->added_by = Auth::user()->domainAccount;
                $items->save();  

                accountabilityDetails::where('header_id',$request->hid)->where('item',$i)->update([
                    // 'status' => 'CLOSED'
                ]);

            }

        accountabilityHeaders::where('id',$request->hid)->update([
            'doc_status' => 'closed',
            'remarks'    => 'par # '.$request->hid.' adjustment'
        ]);

            return redirect()->route('par/index')->with('success','PAR successfully adjusted');
        }
    }

    public function post(Request $req){

        
        $header = accountabilityHeaders::find($req->pid)->update([
            'posted_by'  => Auth::user()->domainAccount,
            'doc_status' => 'posted',
            'posted_date'=> Carbon::today() 
        ]);

        $file_path = '\\\\ftp\FTP\APP_UPLOADED_FILES\par\\';

        if(!file_exists($file_path.$req->pid)) {
            mkdir($file_path.$req->pid, 0775, true);
            $destinationPath = '\\\\ftp\FTP\APP_UPLOADED_FILES\par\\'.$req->pid;

            $this->upload_file($req->pid,$req->file('uploadFile'),$destinationPath);
            
        } else {
            $destinationPath = '\\\\ftp\FTP\APP_UPLOADED_FILES\par\\'.$req->pid;

            $this->upload_file($req->pid,$req->file('uploadFile'),$destinationPath);
        }
        
        if($req->refpar != ''){
            $string = rtrim($req->items,'|');
            
            $items  = explode('|', $req->items);
            foreach($items as $i){
                if($i != ''){
                    $item = explode(':', $i);
                    $this->close_transfered_item($item[0],$item[1],$req->refpar);
                }
            }
        }
         
        return back()->with('success','Selected par posted successfully . . .');

    }

    public function close_transfered_item($qty,$id,$ref){

        $item = accountabilityDetails::where('item',$id)->where('header_id',$ref)->first();
        
        if($item){

            $deduct = ($item->qty - $qty);
            accountabilityDetails::where('item',$id)->where('header_id',$ref)->update([  
                'status' => $deduct == 0 ? 'CLOSED' : 'OPEN',
                'qty' => $deduct,
                'closed_reason' => 'auto-transfer',
                'closed_date' => $deduct == 0 ? Carbon::today() : NULL,
                'closed_by' => Auth::user()->domainAccount
            ]);

            accountabilityDetails::where('item',$id)->where('header_id',$ref)->where('is_lock',1)->update([ 'is_lock' => 0 ]); 

        }
    }

    public function close_par(Request $req){

        $header = accountabilityHeaders::find($req->pid)->update([ 
            'doc_status' => 'closed',
            'remarks'    => $req->remarks 
        ]);

        $file_path = '\\\\ftp\FTP\APP_UPLOADED_FILES\par\\';

        if(!file_exists($file_path.$req->pid)) {
            mkdir($file_path.$req->pid, 0775, true);
            $destinationPath = '\\\\ftp\FTP\APP_UPLOADED_FILES\par\\'.$req->pid;

            $this->upload_file($req->pid,$req->file('uploadFile'),$destinationPath);
            
        } else {
            $destinationPath = '\\\\ftp\FTP\APP_UPLOADED_FILES\par\\'.$req->pid;

            $this->upload_file($req->pid,$req->file('uploadFile'),$destinationPath);
        }

        if($header){
            accountabilityDetails::where('header_id','=',$req->pid)->update([ 
                // 'status'   => 'CLOSED',
                'added_by' => Auth::user()->domainAccount
            ]);
        } 

        return back()->with('success','Par cancelled successfully');
    }
//

    public function print($id){

        $items = parDetails::where('header_id',$id)->get();
       
        $total = 0;
        foreach ($items as $i) {
            $total += $i->t_cost;
        }

        return view('par.print',compact('items','total'));

    }

// Close Item
    public function close_item(Request $req){

        $item = accountabilityDetails::where('item',$req->iid)->where('header_id',$req->hid)->first();
        $deduct = ($item->qty - $req->qty);

        accountabilityDetails::where('item',$req->iid)->where('header_id',$req->hid)->update([
            'closed_date' => $deduct == 0 ? Carbon::today() : NULL,
            'closed_by'   => Auth::user()->domainAccount,
            'closed_reason' => 'auto-close',
            'status' => $deduct == 0 ? 'CLOSED' : 'OPEN',
            'status' => $deduct == 0, 'OPEN',
            'qty' => $deduct,
            'new_condition' => $req->condition
        ]);


        $file_path = '\\\\ftp\FTP\APP_UPLOADED_FILES\par\\';

        if(!file_exists($file_path.$req->hid)) {
            mkdir($file_path.$req->hid, 0775, true);
            $destinationPath = '\\\\ftp\FTP\APP_UPLOADED_FILES\par\\'.$req->hid;

            $this->upload_file($req->hid,$req->file('uploadFile'),$destinationPath);
            
        } else {
            $destinationPath = '\\\\ftp\FTP\APP_UPLOADED_FILES\par\\'.$req->hid;

            $this->upload_file($req->hid,$req->file('uploadFile'),$destinationPath);
        }
        
        return back()->with('success','Accountability successfully closed');
    }

    public function upload_file($id,$files,$dest){

        $destinationPath = '\\\\ftp\FTP\APP_UPLOADED_FILES\par\\'.$id;
        foreach ($files as $file) {
            $file->move($dest, $file->getClientOriginalName());
        }
    }
//

// Transfer Accountability
    public function auto_transfer_item(Request $req){
        
        $emp  = explode(' - ',$req->emp);

        $lock = accountabilityDetails::where('item',$req->iid)->where('header_id',$req->hid)->update([ 'is_lock' => 1 ]);

        if($lock){
            $item_data = accountabilityHeaders::create([
                'ptype'           => 'transfer',
                'ref_par'         => $req->hid,
                'employee_id'     => $req->dept != '' ? 0 : $emp[0],
                'emp_name'        => $req->dept != '' ? '' : $emp[1],
                'dept_id'         => $emp[0] != '' ? 0 : $req->dept,
                'is_dept'         => $req->dept != '' ? '1' : '0',
                'dept'            => $req->emp_dept,
                'document_date'   => Carbon::today(),
                'added_by'        => Auth::user()->domainAccount,
                'doc_status'      => 'saved'
            ]);

            $transfered = $this->transfer_item($req,$item_data);
        }

        return back()->with('success','Accountability transfered successfully');

    }

    // multiple transfer item
    public function multiple_transfer(Request $req){

        
        $emp  = explode(' - ',$req->emp);
        $lock = accountabilityDetails::where('item',$req->iid)->where('header_id',$req->hid)->update([ 'is_lock' => 1 ]);
        // dd($req->new_condition[1]);
        foreach($req->quantity as $key => $quantity)
        {
            if($lock){
                $item_data = accountabilityHeaders::create([
                    'ptype'           => 'transfer',
                    'ref_par'         => $req->hid,
                    'employee_id'     => $req->dept != '' ? 0 : $emp[0],
                    'emp_name'        => $req->dept != '' ? '' : $emp[1],
                    'dept_id'         => $emp[0] != '' ? 0 : $req->dept,
                    'is_dept'         => $req->dept != '' ? '1' : '0',
                    'dept'            => $req->emp_dept,
                    'document_date'   => Carbon::today(),
                    'added_by'        => Auth::user()->domainAccount,
                    'doc_status'      => 'saved'
                ]);
                $req['new_condition'] = $req->condition[$key];
                $req['qty'] = $quantity;
                $transfered = $this->transfer_item($req,$item_data);
            }
        }
     

        return back()->with('success','Accountability transfered successfully');

    }





    public function transfer_item($r,$i){
        
        // dd('breathe');
        $header = accountabilityDetails::create([
            'header_id'     => $i->id,
            'item'          => $r->iid,
            'is_new'        => 0,
            'qty'           => $r->qty,
            't_cost'        => $r->cost,
            'status'        => 'OPEN',
            'new_condition' => $r->new_condition,
            'added_by'      => Auth::user()->domainAccount
        ]);
    }

    public function transaction_details($id)
    {
    $par_details = parDetails::where('header_id','=',$id)->get();

    return view('par.transaction_details',compact('par_details'));
    }

//
    // new update for par controller
}
?>
