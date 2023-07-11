<?php
  
namespace App\Import;


use Maatwebsite\Excel\Concerns\ToModel;

use Carbon\Carbon;  
use App\Contractor;
use Auth;

  
class ContractorsUpload implements ToModel
{
    public function model(array $row)
    {
        return new Contractor([
            'contractor_id'     => $row[0],
            'contractor_fname'  => $row[1], 
            'contractor_mname'  => $row[2], 
            'contractor_lname'  => $row[3],
            'contractor_dept'   => $row[4],
        ]);
    }
}