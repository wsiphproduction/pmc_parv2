<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;

use App\SelectMaster;
use App\Uom;


class DataController extends Controller {

	public function data_index()
    {
        $close_data = SelectMaster::where('select_option','close_par')->orderBy('id','asc')->get();
        $stock_data = SelectMaster::where('select_option','stock_type')->orderBy('id','asc')->get();
        $dept_data  = SelectMaster::where('select_option','dept_code')->orderBy('id','asc')->paginate(5);

        return view('maintenance.data',compact('close_data','stock_data','dept_data'));
    }

// Inventory Code
    public function close_type_add(Request $req)
    {
        SelectMaster::create([
            'description' => $req->close_type,
            'select_option' => 'close_par',
            'is_active' => 1,
            'added_by' => Auth::user()->domainAccount
        ]);

        return back()->with('success','Close type successfully created.');
    }

    public function close_type_update(Request $req)
    {
        SelectMaster::where('id',$req->id)->update([
            'description' => $req->desc
        ]);

        return back()->with('success','Close Type successfully updated.');
    }

    public function close_type_delete(Request $req)
    {
        SelectMaster::where('id',$req->id)->update([
            'is_active' => 0
        ]);

        return back()->with('success','Close Type successfully deleted.');
    }
//

// Stock Type
    public function stock_add(Request $req)
    {
        SelectMaster::create([
            'code' => $req->code,
            'description' => $req->desc,
            'select_option' => 'stock_type',
            'is_active' => 1,
            'added_by' => Auth::user()->domainAccount
        ]);

        return back()->with('success','Stock Type successfully created.');
    }

    public function stock_update(Request $req)
    {
        SelectMaster::where('id',$req->id)->update([
            'code' => $req->stype,
            'description' => $req->desc
        ]);

        return back()->with('success','Stock Type successfully updated.');
    }

    public function stock_delete(Request $req)
    {
        SelectMaster::where('id',$req->id)->update([
            'is_active' => 0
        ]);

        return back()->with('success','Stock Type successfully deleted.');
    }
//

// Dept Code
    public function dept_add(Request $req)
    {
        SelectMaster::create([
            'code' => $req->code,
            'description' => $req->desc,
            'select_option' => 'dept_code',
            'is_active' => 1,
            'added_by' => Auth::user()->domainAccount
        ]);

        return back()->with('success','Department code successfully created.');
    }

    public function dept_update(Request $req)
    {
        SelectMaster::where('id',$req->id)->update([
            'code' => $req->code,
            'description' => $req->desc
        ]);

        return back()->with('success','Department code successfully updated.');
    }

    public function dept_delete(Request $req)
    {
        SelectMaster::where('id',$req->id)->update([
            'is_active' => 0
        ]);

        return back()->with('success','Department code successfully deleted.');
    }
//
}
