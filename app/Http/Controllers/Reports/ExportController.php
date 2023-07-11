<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Excel;

use App\Exports\ExportDepartmentPar;
use App\Exports\ExportPerDepartment;
use App\Exports\ExportPersonnelPar;
use App\Exports\ExportPerPersonal;
use App\Exports\ExportItemStatus;
use App\Exports\ExportDocStatus;




class ExportController extends Controller
{   
    public $today;

    public function __construct(){
        $this->today = new Carbon();
    }

    public function personnel_par(Request $req) {
        ob_end_clean(); // this
        ob_start(); // and this
        return Excel::download(new ExportPersonnelPar($req), 'Par All Employees '.$this->today.'.xlsx');
    }

    public function per_personnel_par(Request $req) {
         ob_end_clean(); // this
         ob_start(); // and this
        return Excel::download(new ExportPerPersonal($req), 'Par Per Employee '.$this->today.'.xlsx');
    }

    public function department_par(Request $req) {
         ob_end_clean(); // this
         ob_start(); // and this
        return Excel::download(new ExportDepartmentPar($req), 'Par All Department '.$this->today.'.xlsx');
    }

    public function per_department_par(Request $req) {
         ob_end_clean(); // this
         ob_start(); // and this
        return Excel::download(new ExportPerDepartment($req), 'Par Per Department '.$this->today.'.xlsx');
    }

    public function doc_status(Request $req){
         ob_end_clean(); // this
         ob_start(); // and this
        return Excel::download(new ExportDocStatus($req), $req->status.' Document Status '.$this->today.'.xlsx');
    }

    public function item_status(Request $req){
         ob_end_clean(); // this
         ob_start(); // and this
        return Excel::download(new ExportItemStatus($req), $req->status.' Item Status '.$this->today.'.xlsx');
    }

}
