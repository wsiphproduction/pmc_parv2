<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Hash;
use Auth;
use DB;

use App\UserDetails;

class UserController extends Controller {

	public function user(){
        $employees = file_get_contents("http://172.16.20.27/parv2/api/search-emp-hris.php");
        $users = UserDetails::all();

    	return view('maintenance.user', compact('users','employees'));
    }

    public function add(Request $r){

        $emp = explode(' - ', $r->emp);

        $user = UserDetails::create([
            'domainAccount' => $r->domain,
            'fullName'      => $emp[1],
            'password'      => \Hash::make($r->pword, array('rounds'=>12)),
            'isActive'      => 1,
            'dept'          => $r->dept,
            'role'          => $r->role,
            'addedBy'       => 'rcnolasco',
            'is_dept'       => $r->role == 'Department User' ? 1 : 0,
            'remember_token'=> str_random(10)
        ]);

        return back()->with('success','User created successfully');
    }

    public function update_account(Request $req){

        UserDetails::find($req->id)->update([
            'email'      => $req->email
        ]);

        if($req->password != ''){
            $password = UserDetails::find($req->id)->update([
                'password' => \Hash::make($req->password, array('rounds'=>12)),
            ]);

            if($password){
               return redirect('/par/logout')->with('success','Password successfully change. To login again, please use your new password!'); 
            }
        }

    }

    public function upload_avatar(Request $req){

        if($req->hasFile('avatar')) {
            //$image_url = Storage::putFileAs('/public/avatars/', $file,$req->domain.'.'.$ext);  
            //$destinationPath = storage_path() . '/app/public/avatars/';

            $file = $req->file('avatar');
            $fileName = $file->getClientOriginalName();

            $file->move(public_path('avatars'), $fileName);

            UserDetails::find($req->id)->update([
                'avatar'  => $fileName
            ]);

            return back()->with('success','Avatar successfully changed.');
        }
    }


    public function deactivate(Request $r){
        
        $user = UserDetails::find($r->uid)->update([
            'isActive' => 0
        ]);

        if($user)
            return back()->with('success','User deactivated successfully');

        else
            return back()->with('failed','User deactivation failed');
        
    }

    public function activate(Request $r){
        
        $user = UserDetails::find($r->uid)->update([
            'isActive' => 1
        ]);

        if($user)
            return back()->with('success','User activated successfully');
        else
            return back()->with('failed','User activation failed');
    }

    public function update(Request $r){

        $user = UserDetails::find($r->uid)->update([
            'domainAccount' => $r->domain,
            'password'      => \Hash::make($r->pword, array('rounds'=>12)),
            'role'          => $r->role
        ]);

        if($user)
            return back()->with('success','User updated successfully');
        else
            return back()->with('failed','Error occur while updating user');
    }
}
?>