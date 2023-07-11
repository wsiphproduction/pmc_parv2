<?php


namespace App\Http\Controllers\Par;

use File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UploadController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    	$files = request()->file->getClientOriginalName();
        request()->file->move(public_path('upload'), $files);

    	return response()->json(['uploaded' => '/upload/'.$files]);
    }
}
