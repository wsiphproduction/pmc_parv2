<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Import\StockedItemsUpload;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FileController extends Controller
{
    public function fileUpload(Request $req)
    {
        dd('aw');
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
        dd('aw');
        $today = date('Y-m-d', strtotime(Carbon::today()));

        if(!Storage::exists('/public/'.$today)) {
            
            Storage::makeDirectory('/public/'.$today, 0775, true);
        }

        $dir = '\\\\ftp\\FTP\\APP_UPLOADED_FILES\\par\\'.$req->par.'\\'.$req->fileName;
        $dst = storage_path().'/app/public/'.$today.'/'.$req->fileName;

        copy($dir, $dst);
    }

    public function upload_stocked_items() 
    {
        dd('aw');
        Excel::import(new StockedItemsUpload,request()->file('file'));
           
        return back()->with('success','Stocked Items successfully uploaded');
    }
    
}

