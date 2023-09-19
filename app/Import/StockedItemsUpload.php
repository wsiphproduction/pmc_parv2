<?php
  
namespace App\Import;

use App\Models\StockedItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Carbon\Carbon;  
use App\StockedItems;
use Auth;


  
class StockedItemsUpload implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
      
        return new StockedItems([
            'stock_type'  => $row['stock_type'],
            'inv_code'    => $row['inv_code'], 
            'stock_code'  => $row['stock_code'],
            'description' => $row['description'],
            'oem_id'      => $row['oem'],
            'uom'         => $row['uom'],
            'added_by'    => Auth::user()->domainAccount,
            'uploaded_at' => Carbon::now()
        ]);
    }
}
?>