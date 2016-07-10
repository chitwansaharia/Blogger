<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Requests;
use App\Notification;

class SearchController extends Controller
{
    public function searchResults(Request $request)
    {
    		
    		$users = User::all();
    		
    		$filtered = $users->reject(function($user)
    		{
    			global $request;
               $u1= strtoupper($user->name);
                $u2=strtoupper($request->searchkey);
    		return !str_contains($u1,$u2);
    		});
    		return view('searchResults',compact('filtered'));

    		
    }
    public function viewProfile(User $user)
    {
        $user->load('blogs');
        return view('profilevisit',compact('user'));
    } 
    public function follow(Request $request)
    {
        if($request->ajax())
        {
            $userid = $_POST['userid'];
            $user = User::find($userid);
            if($_POST['button_name']=="Follow")
            {
                Auth::user()->followings()->attach($userid);
                $user->followers()->attach(Auth::user()->id);
                $notification = new Notification;
                $notification ->url = "http://localhost:8000/userview/".Auth::user()->id;
                 $notification->imageurl="\\uploads\\".Auth::user()->imgsrc();
                $notification->body = Auth::user()->name." follows you..";
                $notification->state = 'active';
                $user->notifications()->save($notification);
            
            }
            else
            {
                Auth::user()->followings()->detach($userid);
                $user->followers()->detach(Auth::user()->id);
            }

        }
    }
}
