<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;


use App\Contractor;

class ContractorController extends Controller {

    public function index()
    {
        $contractors = Contractor::paginate(10);

        return view('maintenance.contractor',compact('contractors'));
    }

    public function store(Request $req)
    {
        Contractor::create([
            'contractor_id' => $req->cid,
            'contractor_fname' => $req->c_fname,
            'contractor_lname' => $req->c_lname,
            'contractor_mname' => $req->c_mname,
            'contractor_dept' => $req->c_dept
        ]);

        return back()->with('success','Contractor successfully saved!');
    }
}
