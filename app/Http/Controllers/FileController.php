<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Import\StockedItemsUpload;
use App\Import\PPEItemsUpload;
use App\Import\ContractorsUpload;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Items;

class FileController extends Controller
{
    public function fileUpload(Request $req)
    {
        
        $file_path = '\\\\ftp\FTP\APP_UPLOADED_FILES\par\\';
        $files = $req->file('uploadFile');

        if(!file_exists($file_path.$req->par_id)) {
            mkdir($file_path.$req->par_id, 0775, true);

            $destinationPath = '\\\\ftp\FTP\APP_UPLOADED_FILES\par\\'.$req->par_id;
            foreach ($files as $file) { 
                $file->move($destinationPath, $file->getClientOriginalName());
            }
        } else {
            $destinationPath = '\\\\ftp\FTP\APP_UPLOADED_FILES\par\\'.$req->par_id;
            foreach ($files as $file) { 
                $file->move($destinationPath, $file->getClientOriginalName());
            }
        }
        return back()->with('success','File uploaded successfully');
    }

    public function copyFile(Request $req){

        $today = date('Y-m-d', strtotime(Carbon::today()));

        if(!Storage::exists('/public/'.$today)) {
            
            Storage::makeDirectory('/public/'.$today, 0775, true);
        }

        $dir = '\\\\ftp\\FTP\\APP_UPLOADED_FILES\\par\\'.$req->par.'\\'.$req->fileName;
        $dst = storage_path().'/app/public/'.$today.'/'.$req->fileName;

        copy($dir, $dst);
    }

    public function upload_stocked_items(Request $request) 
    {

        try {
            // Validate the uploaded file
            request()->validate([
                'file' => 'required|file|mimes:xls,xlsx',
            ]);
    
            // Import the data from the Excel file using Laravel Excel
            Excel::import(new StockedItemsUpload, request()->file('file'));

            return back()->with('success', 'Stocked Items successfully uploaded');
        } catch (\Exception $e) {
            // Handle any exceptions, e.g., if there was an issue with the import
            return back()->with('error', 'Error: ' . $e->getMessage());

        }
    }


    public function upload_ppe_items(Request $request) 
    {
        
        Excel::import(new PPEItemsUpload,request()->file('file')); 

        return back()->with('success','PPE Items successfully uploaded');
    }

    public function upload_contractors() 
    {
       
        Excel::import(new ContractorsUpload,request()->file('file')); 

        return back()->with('success','Contractor list successfully uploaded');
    }
    
    
}
