<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use App\Blog;
use Auth;
use App\User;
use App\Notification;

class CommentController extends Controller
{
    public function addcomment(Request $request,Blog $blog)
    {
    	$this->validate($request,[
    		'comment' => 'required'
    		]);
    	$comment = new Comment;
    	$comment->body = $request->comment;
    	$comment->user_id = Auth::user()->id;
    	$blog->comments()->save($comment);
        if(!Auth::user()->blog->contains($blog))
            {
                $user = $blog->user;
                $notification = new Notification;
                $notification ->url = "http://localhost:8000/blogs/".$blog->id."/view";
                 $notification->imageurl="\\uploads\\". Auth::user()->imgsrc();
                $notification->body = Auth::user()->name." commented your blog ".$blog->title;
                $notification->state = 'active';
                $user->notifications()->save($notification);
            }
    	return back();
    }
}
