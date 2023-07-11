<?php

namespace App\Exports;

use App\parDetails;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportDepartmentPar implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $r;

    public function __construct($request)
    {
        $this->r = $request;

    }

    public function collection()
    {
        // $dept = str_replace(':', '/', $this->r->accountable);
        return parDetails::select('header_id','dept_id','document_date','serial_no','doc_ref','stock_code','description','dept','doc_status','status','qty','t_cost','added_by')->where('is_dept',1)->whereBetween('document_date',[$this->r->from,$this->r->to])->orderBy('header_id','desc')->get();

    }

    public function headings(): array
    {
        return [
            'Par #',
            'Accountable',
            'Document Date',
            'Serial #',
            'Batch/QR #',
            'Stock Code',
            'Description',
            'Department',
            'Document Status',
            'Item Status',
            'Qty',
            'Cost',
            'Added By'
        ];
    }
}
?>