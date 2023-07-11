<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Session;
use Alert;
use toast;
class LoginController extends Controller
{
    
    public function index()
    {
    	return view('auth.login');
    }

    public function checklogin(Request $request)
    {
        $user_data = array(
            'domainAccount' => $request->domainAccount,
            'password'      => $request->password
        );

    	if(Auth::attempt($user_data))
    	{	
            file_get_contents('http://172.16.20.27/parv2/api/delete-temp-folder.php');
            
            if(Auth::user()->is_dept == 0){
                return redirect('/landing');
            } else {
                return redirect('/par/index');
            }
    		
    	}
    	else
    	{
            return back();
    		//return back()->with('error','Incorrect Login Credentials!');
    	}
    }

    public function dept_checklogin(Request $request)
    {
        $user_data = array(
            'domainAccount' => $request->domainAccount,
            'password'      => $request->password
        );

        if(Auth::attempt($user_data))
        {   
            file_get_contents('http://172.16.20.27/parv2/api/delete-temp-folder.php');
            
            return redirect('/par/index');

            // if($dept == 'ACCOUNTING'){
            //     return redirect('/accounting/home');
            // } else {
            //     return back()->with('error','Unauthorized login! The page you are about to access is for MCD users only!');
            // }
            
        }
        else
        {
            return back()->with('failed','Incorrect Login Credentials!');
        }
    }

    public function dept_logout()
    {
        Auth::logout();
        Session::flush();
        
        return redirect('/dept/login');
    }

    public function logout()
    {
        Auth::logout();
        $msg = Session::get('success');

        return redirect('/par/login')->with('msg', $msg);

    }
}
?>