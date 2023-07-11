<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

use App\accountabilityHeaders;
use App\parRequests;
use App\parDetails;
use App\Items;

class DeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $datas = parDetails::where('doc_status','!=','closed')->orderBy('header_id','desc')->paginate(10);

        return view('accounting.index',compact('datas'));
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

    public function item_verification()
    {
        $items = Items::where('is_verified',0)->orderBy('id','desc')->paginate(20);

        return view('accounting.item-verification',compact('items'));
    }

    public function item_verify($id)
    {
        $item = Items::where('id',$id)->first();

        return view('accounting.item-verify',compact('item'));
    }

    public function verify(Request $req)
    {
        $item = Items::where('id',$req->iid)->update([
            'expense_type'=> $req->expense_type,
            'serial_no'   => $req->serial,
            'asset_code' => $req->asset_code,
            'is_verified' => 1
        ]);

        return redirect()->route('item_verification')->with('success','Item successfully verified!');
    }

    public function modal_verify(Request $req)
    {
        $item = Items::where('id',$req->iid)->update([
            'is_verified' => 1
        ]);

        return back()->with('success','Item successfully verified!');
    }

}
