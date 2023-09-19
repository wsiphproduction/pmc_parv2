<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\accountabilityHeaders;
use Auth;

use App\Contractor;

class ReportController extends Controller {

    public function par_personnel(){

        $employees   = file_get_contents("http://172.16.20.27/parv2/api/add-issuance.php");

        return view('reports.personnel',compact('employees'));
    }

    public function par_department(){

        $departments = file_get_contents("http://172.16.20.27/parv2/api/dept-api.php");

        return view('reports.department',compact('departments'));
    }

    public function index()
    {
        return view('reports.index');
    }

    public function notes(Request $request,$id)
    {        
        // if($request->other_specs==null) {
            accountabilityHeaders::findOrfail($id)->update(['notes' => $request->notes]);
            // dd($request);
        // }
    }

    public function contractor()
    {
        $contractors = Contractor::paginate(10);

        return view('reports.contractor',compact('contractors'));
    }
}








































    // public function generateDepartment(Request $req){
        
    //     if($req->ajax()){

    //         $depts = reportDepartments::where('dept_id','=',$req->search)->get();

    //     return view('reports.result-department-par',compact('depts',$depts));

    //     }  
    // }



    // public function ictItems(){

    //     $ict = parDetails::where('isict','=','1')->get();

    //     return view('reports.ict-items',compact('ict'));

    // }

    // public function ItemsWithOutPar(){

    //     $items = Items::whereNotIn('id', function($query){ $query->select('item')->from('accountabilityDetails'); } )->get();

    //     return view('reports.items_without_par',compact('items',$items));
    // }




    ## EXPORT

    // public function exportDepartmentPar(Request $req) {
    //     $today = new Carbon();
    //     return Excel::download(new DepartmentExport($req), 'Department_Par '.$today.'.xlsx');
    // }

    // public function exportPersonnelPar(Request $req){
    //    $today = new Carbon();
    //     return Excel::download(new PersonnelExport($req), 'Personnel_Par '.$today.'.xlsx');
    // }

    // public function exportSavedPar(Request $req) {
    //     $today = new Carbon();
    //     return Excel::download(new SavedParExport($req), 'Saved_Par '.$today.'.xlsx');
    // }

    // public function exportPostedPar(Request $req){
    //     $today = new Carbon();
    //     return Excel::download(new PostedParExport($req), 'Posted_Par '.$today.'.xlsx');
    // }

    // public function exportCancelledPar(Request $req){
    //     $today = new Carbon();
    //     return Excel::download(new CancelledParExport($req),'Cancelled_Par '.$today.'.xlsx' );
    // }

    // public function exportClosedPar(Request $req){
    //     $today = new Carbon();
    //     return Excel::download(new ClosedParExport($req), 'Closed_Par '.$today.'.xlsx');
    // }

    // public function exportICTItems(){
    //     $today = new Carbon();
    //     return Excel::download(new IctItemsExport(), 'ICT Items '.$today.'.xlsx');
    // }

    // public function itemsWOPar(){
    //     $today = new Carbon();
    //     return Excel::download(new ItemsWithOutPar(), 'Items WithOut Par '.$today.'.xlsx');
    // }
