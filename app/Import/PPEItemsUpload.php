<?php
  
namespace App\Import;


use Maatwebsite\Excel\Concerns\ToModel;

use Carbon\Carbon;  
use App\Items;
use Auth;

  
class PPEItemsUpload implements ToModel
{
    public function model(array $row)
    {
        return new Items([
            'stock_type'  => $row[0],
            'inv_code'    => $row[1], 
            'stock_code'  => $row[2],
            'description' => $row[3],
            'oem_id'      => $row[4],
            'uom'         => $row[5],
            'expense_type'=> $row[6],
            'other_specs' => $row[7],
            'cost'        => $row[8],
            'qty'         => 0,
            'item_kind'   => 1,
            'added_by'    => Auth::user()->domainAccount,
            'created_at' => Carbon::now()
        ]);
    }
}
?>