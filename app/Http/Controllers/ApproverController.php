<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

use App\accountabilityHeaders;
use App\parRequests;
use App\parDetails;
use App\Items;

class ApproverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = parRequests::orderBy('id','desc')->get();
        return view('approver.index',compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function get_par_details($id){
        $data    = parRequests::where('id','=',$id)->first();
        $details = parDetails::where('header_id',$data->par_id)->get();
        $total = 0;
        foreach ($details as $i) {
            $total += $i->cost;
        }
        
        return view('approver.par_details',compact('data','details','total'));
    }

    public function get_item_details($id){
        $item = Items::where('tracking','=',$id)->first();
        $data = parRequests::where('par_id','=',$id)->first();
        
        return view('approver.item_details',compact('item','data'));
    }

    public function par_disapproved(Request $req){

        $data = parRequests::where('id','=',$req->rid)->where('par_id','=',$req->pid)->update([
            'status' => 'disapproved',
            'disapproved_reason' => $req->reason_deny
        ]);

        if($data){
            accountabilityHeaders::where('id','=',$req->pid)->update([ 'unpost_request' => 0 ]);

            return back()->with('success','Request was being disapproved');
        }
    }

    public function par_approved(Request $req){

        $data = parRequests::where('id',$req->rid)->update([
            'status'        => 'approved',
            'approved_by'   => Auth::user()->domainAccount,
            'approved_date' => Carbon::today(),
            'is_approved'   => 1
        ]);

        if($data){
            accountabilityHeaders::where('id','=',$req->pid)->update([
                'unpost_request' => 0,
                'doc_status'     => 'saved'
            ]);
            return back()->with('success','Par was being unposted and is now in saved status');
        }

    }

    public function item_disapproved(Request $req){

        $disapproved = parRequests::where('par_id',$req->iid)->update([
            'status'             => 'disapproved',
            'disapproved_reason' => $req->reason_deny
        ]);

        if($disapproved){
            alert()->success('DENIED','Opening item is being denied');
            return back();
        } else {
            alert()->warning('ERROR','Denied Failed');
            return back();
        }
    }

    public function item_approved(Request $req){

        $approved = parRequests::where('par_id',$req->iid)->update([
            'status'        => 'approved',
            'approved_by'   => Auth::user()->domainAccount,
            'approved_date' => Carbon::today(),
            'is_approved'   => 1
        ]);

        if($approved){
            alert()->success('DENIED','Opening item is being denied');
            return back();
        } else {
            alert()->warning('ERROR','Denied Failed');
            return back();
        }
    }

    public function print($id){

        $items = parDetails::where('header_id',$id)->get();
       
        $total = 0;
        foreach ($items as $i) {
            $total += $i->price;
        }

        return view('approver.print',compact('items','total'));
    }
}
