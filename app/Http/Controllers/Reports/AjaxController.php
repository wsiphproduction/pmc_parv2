<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

use App\parDetails;
use App\Items;


class AjaxController extends Controller
{

    public function ajax_par_summary_report(Request $req)
    {
        if($req->rtype == 1){
            if($req->opt_sel == 1){
                $data = parDetails::whereBetween('document_date',[$req->date_from,$req->date_to])->orderBy('header_id','desc')->get();
                $btnExport = "<a href='/export/personnel/".$req->date_from."/".$req->date_to."' class='btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5 text-white btnCSV'>Export to CSV</a>";
           } else {
                $data = parDetails::where('emp_name',$req->emp)->whereBetween('document_date',[$req->date_from,$req->date_to])->orderBy('header_id','desc')->get();
                $btnExport = "<a href='/export/per-personnel/".$req->emp."/".$req->date_from."/".$req->date_to."' class='btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5 text-white btnCSV'>Export to CSV</a>";
           }
            
            $rows = count($data);

            $output =  "<div class='row'>
                            <div class='col-md-12'>
                                <div class='d-flex flex-row justify-content-between'>
                                    <div class='pd-10'></div>
                                    <div class='pd-10 mg-t-10'>
                                        <h3>Personal Par Report</h3>
                                        <center><p>".$req->date_from." &nbsp;to&nbsp; ".$req->date_to."</p></center>
                                    </div>
                                    <div class='pd-10'></div>
                                </div>
                            </div>
                        </div>
                        <div class='df-example demo-table mg-t-10'>
                            <div class='d-sm-flex align-items-center justify-content-end p-xs h4'>
                                <div class='d-none d-md-block'>
                                    ".$btnExport."
                                </div>
                            </div>
                            <div class='table-responsive'>
                                <table class='table table-secondary table-hover table-stripped mg-b-0' style='table-layout: fixed;word-wrap: break-word;'>
                                    <thead class='thead-secondary'>
                                        <th style='width:6%;'> Par #</th>
                                        <th style='width:15%;'> Accountable </th>
                                        <th style='width:15%;'> Doc Date </th>
                                        <th style='width:10%;'> Serial # </th>
                                        <th style='width:12%;'> Batch/QR # </th>
                                        <th style='width:10%;'> Stock Code </th>
                                        <th style='width:28%;'> Description </th>
                                        <th style='width:20%;'> Department </th>
                                        <th style='width:5%;'> Qty </th>
                                        <th style='width:7%;'> Cost </th>
                                        <th style='width:9%;'> Encoder </th>
                                    </thead>";

            if($rows > 0){
                $total_cost = 0;
                foreach($data as $key => $d){
                    if($d->qty > 0){
                        $total_cost += $d->qty*$d->cost;
                    }

                    $output .= '<tbody>'.
                                    '<tr class="tx-13">'.
                                        '<td>'.$d->refcode.'</td>'.
                                        '<td>'.$d->accountable.'</td>'.
                                        '<td>'.$d->document_date.'</td>'.
                                        '<td>'.$d->serial_no.'</td>'.
                                        '<td>'.$d->doc_ref.'</td>'.
                                        '<td>'.$d->stock_code.'</td>'.
                                        '<td>'.$d->description.'</td>'.
                                        '<td>'.$d->dept.'</td>'.
                                        '<td class="text-right">'.$d->qty.'</td>'.
                                        '<td class="text-right">'.$d->cost.'</td>'.
                                        '<td>'.$d->added_by.'</td>'.
                                    '</tr>';
                }

                        $output .= '<tr>'.
                                        '<td colspan="6"><b>Grand Total</b></td>'.
                                        '<td colspan="2"><b>'.number_format($total_cost,2).'</b></td>'.
                                    '</tr>'.
                                '</tbody>'.
                            '</table>'.
                        '</div>'.
                    '</div>';

                return Response($output);
            } else {
                $output .= '<tr><td colspan="8"><center><span class="badge badge-info">No accountable items for the selected employee...</span></center></td></tr>';
                    return Response($output);
            }
        }

        if($req->rtype == 2){
            if($req->opt_sel == 1){
                $data = parDetails::where('is_dept',1)->whereBetween('document_date',[$req->date_from,$req->date_to])->orderBy('header_id','desc')->get();
                $btnExport = "<a href='/export/common/".$req->date_from."/".$req->date_to."' class='btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5 text-white btnCSV'>Export to CSV</a>";
           } else {
                $data = parDetails::where('dept',$req->dept)->whereBetween('document_date',[$req->date_from,$req->date_to])->orderBy('header_id','desc')->get();
                $dept = str_replace(':', '/', $req->dept);
                $btnExport = "<a href='/export/per-common/".$dept."/".$req->date_from."/".$req->date_to."' class='btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5 text-white btnCSV'>Export to CSV</a>";
           }
            
            $rows = count($data);

            $output =  "<div class='row'>
                            <div class='col-md-12'>
                                <div class='d-flex flex-row justify-content-between'>
                                    <div class='pd-10'></div>
                                    <div class='pd-10 mg-t-10'>
                                        <h3>Common Par Report</h3>
                                        <center><p>".$req->date_from." &nbsp;to&nbsp; ".$req->date_to."</p></center>
                                    </div>
                                    <div class='pd-10'></div>
                                </div>
                            </div>
                        </div>
                        <div class='df-example demo-table mg-t-20'>
                            <div class='d-sm-flex align-items-center justify-content-end p-xs h4'>
                                <div class='d-none d-md-block'>
                                <a class='btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5 text-white btnPrint' onclick='javascript:window.print();''>Print</a>
                                    ".$btnExport."
                                </div>
                            </div>
                            <div class='table-responsive'>
                                <table class='table table-secondary table-hover table-striped mg-b-0'>
                                    <thead>
                                        <tr>
                                            <th class='wd-5p'> Par #</th>
                                            <th class='wd-20p'> Accountable </th>
                                            <th class='wd-10p'> Doc Date </th>
                                            <th class='wd-10p'> Serial # </th>
                                            <th class='wd-12p'> Batch/QR # </th>
                                            <th class='wd-10p'> Stock Code </th>
                                            <th class='wd-30p'> Description </th>
                                            <th class='wd-20p'> Department </th>
                                            <th class='wd-5p'> Doc Status </th>
                                            <th class='wd-5p'> Item Status </th>
                                            <th class='wd-5p'> Qty </th>
                                            <th class='wd-5p'> Cost </th>
                                            <th class='wd-5p'> Encoder </th>
                                        </tr>
                                    </thead>";

            if($rows > 0){
                $total_cost = 0;
                foreach($data as $key => $d){
                    if($d->qty > 0){
                        $total_cost += $d->qty*$d->cost;
                    }

                    $output .= '<tbody>'.
                                    '<tr class="tx-13">'.
                                        '<td>'.$d->refcode.'</td>'.
                                        '<td>'.$d->accountable.'</td>'.
                                        '<td>'.$d->document_date.'</td>'.
                                        '<td>'.$d->serial_no.'</td>'.
                                        '<td>'.$d->doc_ref.'</td>'.
                                        '<td>'.$d->stock_code.'</td>'.
                                        '<td>'.$d->description.'</td>'.
                                        '<td>'.$d->dept.'</td>'.
                                        '<td>'.strtoupper($d->doc_status).'</td>'.
                                        '<td>'.strtoupper($d->status).'</td>'.
                                        '<td class="text-right">'.$d->qty.'</td>'.
                                        '<td class="text-right">'.$d->cost.'</td>'.
                                        '<td>'.$d->added_by.'</td>'.
                                    '</tr>';
                }

                        $output .= '<tr>'.
                                        '<td colspan="8"><b>Grand Total</b></td>'.
                                        '<td class="text-right"><b>'.number_format($total_cost,2).'</b></td>'.
                                        '<td colspan="1"></td>'.
                                    '</tr>'.
                                '</tbody>'.
                            '</table>'.
                        '</div>'.
                    '</div>';

                return Response($output);
            } else {
                $output .= '<tr><td colspan="10"><center><span class="badge badge-info">No accountable items for the selected employee...</span></center></td></tr>';
                    return Response($output);
            }
        }

        if($req->rtype == 3){
            $data = parDetails::where('doc_status',$req->d_status)->whereBetween('document_date',[$req->date_from,$req->date_to])->orderBy('header_id','desc')->get();
            $btnExport = "<a href='/export/doc/".$req->d_status."/".$req->date_from."/".$req->date_to."' class='btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5 text-white btnCSV'>Export to CSV</a>";
           
            $rows = count($data);
            $output =  "<div class='row'>
                            <div class='col-md-12'>
                                <div class='d-flex flex-row justify-content-between'>
                                    <div class='pd-10'></div>
                                    <div class='pd-10 mg-t-10'>
                                        <h3>Document Status Report</h3>
                                        <center><p>".$req->date_from." &nbsp;to&nbsp; ".$req->date_to."</p></center>
                                    </div>
                                    <div class='pd-10'></div>
                                </div>
                            </div>
                        </div>
                        <div class='df-example demo-table mg-t-20'>
                            <div class='d-sm-flex align-items-center justify-content-end p-xs h4'>
                                <div class='d-none d-md-block'>
                                <a class='btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5 text-white btnPrint' onclick='javascript:window.print();''>Print</a>
                                    ".$btnExport."
                                </div>
                            </div>
                            <div class='table-responsive'>
                                <table class='table table-secondary table-hover table-striped mg-b-0'>
                                    <thead>
                                        <tr>
                                            <th class='wd-5p'> Par #</th>
                                            <th class='wd-20p'> Accountable </th>
                                            <th class='wd-10p'> Doc Date </th>
                                            <th class='wd-10p'> Serial # </th>
                                            <th class='wd-12p'> Batch/QR # </th>
                                            <th class='wd-10p'> Stock Code </th>
                                            <th class='wd-30p'> Description </th>
                                            <th class='wd-20p'> Department </th>
                                            <th class='wd-5p'> Doc Status </th>
                                            <th class='wd-5p'> Item Status </th>
                                            <th class='wd-5p'> Qty </th>
                                            <th class='wd-5p'> Cost </th>
                                            <th class='wd-5p'> Encoder </th>
                                        </tr>
                                    </thead>";

            if($rows > 0){
                $total_cost = 0;
                foreach($data as $key => $d){
                    if($d->qty > 0){
                        $total_cost += $d->qty*$d->cost;
                    }

                    $output .= '<tbody>'.
                                    '<tr class="tx-13">'.
                                        '<td>'.$d->refcode.'</td>'.
                                        '<td>'.$d->accountable.'</td>'.
                                        '<td>'.$d->document_date.'</td>'.
                                        '<td>'.$d->serial_no.'</td>'.
                                        '<td>'.$d->doc_ref.'</td>'.
                                        '<td>'.$d->stock_code.'</td>'. 
                                        '<td>'.$d->description.'</td>'.
                                        '<td>'.$d->dept.'</td>'.
                                        '<td>'.strtoupper($d->doc_status).'</td>'.
                                        '<td>'.strtoupper($d->status).'</td>'.
                                        '<td class="text-right">'.$d->qty.'</td>'.
                                        '<td class="text-right">'.$d->cost.'</td>'.
                                        '<td>'.$d->added_by.'</td>'.
                                    '</tr>';
                }

                        $output .= '<tr>'.
                                        '<td colspan="8"><b>Grand Total</b></td>'.
                                        '<td class="text-right"><b>'.number_format($total_cost,2).'</b></td>'.
                                        '<td colspan="1"></td>'.
                                    '</tr>'.
                                '</tbody>'.
                            '</table>'.
                        '</div>'.
                    '</div>';

                return Response($output);
            } else {
                $output .= '<tr><td colspan="10"><center><span class="badge badge-info">No accountable items for the selected employee...</span></center></td></tr>';
                    return Response($output);
            }
        }

        if($req->rtype == 4){
            $data = parDetails::where('status',$req->i_status)->whereBetween('document_date',[$req->date_from,$req->date_to])->orderBy('header_id','desc')->get();
            $btnExport = "<a href='/export/item/".$req->i_status."/".$req->date_from."/".$req->date_to."' class='btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5 text-white btnCSV'>Export to CSV</a>";
           
            $rows = count($data);
            $output =  "<div class='row'>
                            <div class='col-md-12'>
                                <div class='d-flex flex-row justify-content-between'>
                                    <div class='pd-10'></div>
                                    <div class='pd-10 mg-t-10'>
                                        <h3>Item Status Report</h3>
                                        <center><p>".$req->date_from." &nbsp;to&nbsp; ".$req->date_to."</p></center>
                                    </div>
                                    <div class='pd-10'></div>
                                </div>
                            </div>
                        </div>
                        <div class='df-example demo-table mg-t-20'>
                            <div class='d-sm-flex align-items-center justify-content-end p-xs h4'>
                                <div class='d-none d-md-block'>
                                    <a class='btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5 text-white btnPrint' onclick='javascript:window.print();''>Print</a>
                                    ".$btnExport."
                                </div>
                            </div>
                            <div class='table-responsive'>
                                <table class='table table-secondary table-hover table-striped mg-b-0'>
                                    <thead>
                                        <tr>
                                            <th class='wd-5p'> Par #</th>
                                            <th class='wd-20p'> Accountable </th>
                                            <th class='wd-10p'> Doc Date </th>
                                            <th class='wd-10p'> Serial # </th>
                                            <th class='wd-12p'> Batch/QR # </th>
                                            <th class='wd-10p'> Stock Code </th>
                                            <th class='wd-30p'> Description </th>
                                            <th class='wd-20p'> Department </th>
                                            <th class='wd-5p'> Doc Status </th>
                                            <th class='wd-5p'> Item Status </th>
                                            <th class='wd-5p'> Qty </th>
                                            <th class='wd-5p'> Cost </th>
                                            <th class='wd-5p'> Encoder </th>
                                        </tr>
                                    </thead>";

            if($rows > 0){
                $total_cost = 0;
                foreach($data as $key => $d){
                    if($d->qty > 0){
                        $total_cost += $d->qty*$d->cost;
                    }

                    $output .= '<tbody>'.
                                    '<tr class="tx-13">'.
                                        '<td>'.$d->refcode.'</td>'.
                                        '<td>'.$d->accountable.'</td>'.
                                        '<td>'.$d->document_date.'</td>'.
                                        '<td>'.$d->serial_no.'</td>'.
                                        '<td>'.$d->doc_ref.'</td>'.
                                        '<td>'.$d->stock_code.'</td>'. 
                                        '<td>'.$d->description.'</td>'.
                                        '<td>'.$d->dept.'</td>'.
                                        '<td>'.strtoupper($d->doc_status).'</td>'.
                                        '<td>'.strtoupper($d->status).'</td>'.
                                        '<td class="text-right">'.$d->qty.'</td>'.
                                        '<td class="text-right">'.$d->cost.'</td>'.
                                        '<td>'.$d->added_by.'</td>'.
                                    '</tr>';
                }

                        $output .= '<tr>'.
                                        '<td colspan="8"><b>Grand Total</b></td>'.
                                        '<td class="text-right"><b>'.number_format($total_cost,2).'</b></td>'.
                                        '<td colspan="1"></td>'.
                                    '</tr>'.
                                '</tbody>'.
                            '</table>'.
                        '</div>'.
                    '</div>';

                return Response($output);
            } else {
                $output .= '<tr><td colspan="10"><center><span class="badge badge-info">No accountable items for the selected employee...</span></center></td></tr>';
                    return Response($output);
            }
        } 
    }
}
