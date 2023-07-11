<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

use App\Notifications\RequestOpenItem;
use App\Notifications\UnpostPar;
use App\Notifications\emailPar;

use App\accountabilityHeaders;
use App\UserDetails;
use App\parRequests;
use App\Items;

class EmailController extends Controller
{
    public function email_par_details(Request $request){

        $user = new UserDetails();
        $user->email = $request->to_email;
        $user->notify(new emailPar($request));

        return back()->with('success','Accountability details was sent to the recepient . . .'); 
    }

    public function email_open_item(Request $request){

        $user = new UserDetails();
        $user->email = $request->to_email;
        $user->notify(new RequestOpenItem($request));

        if($user){
            parRequests::create([
                'par_id'         => $request->tracking,
                'reason'         => $request->message,
                'status'         => 'waiting',
                'requested_by'   => Auth::user()->fullName,
                'requested_date' => Carbon::today(),
                'is_served'      => 1,
                'type'           => 'ITEM',
                'is_approved'    => 0
            ]);

            Items::findOrFail($request->tid)->update(['unpostRequest' => 1]);

            return back()->with('success','Email Sent! Please wait for the approver to approved your request . . .');
        } else {
            return back()->with('failed','Email not sent . . .');
        }
    }
}
