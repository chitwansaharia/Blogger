<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Blog;
use Auth;
use App\Notification;

class BlogController extends Controller
{
    public function addPost(Request $request,User $user)
    {
    	$this->validate($request,[
    		'body' => 'required',
            'title'=>'required'
    		]);
    	$blog = new Blog;
    	$blog->body = $request->body;
        $blog->title = $request->title;
        $blog->likes = 0;
    	$user->blog()->save($blog);
    	return back();
    }
    public function editForm(Blog $blog)
    {
    	return view('editblog',compact('blog'));
    }
    public function editBlog(Request $request,Blog $blog)
    {
    	$this->validate($request,[
    		'body' => 'required',
            'title'=>'required'
    		]);
        $blog->title = $request->title;
    	$blog->body = $request->body;
    	$blog->save();
    	return redirect('/user');
    }
    public function likes(Request $request)
    {

    if($request->ajax())
    {
        $blogid= $_POST['blogid'];
        $blog = Blog::find($blogid);
        if($_POST['button_name']=='Like')
        {
            $blog->likes++;
            Auth::user()->blogs()->attach($blogid);
            if(!(Auth::user()->blog->contains($blog)))
            {
                $user = $blog->user;
                $notification = new Notification;
                $notification->url = "http://localhost:8000/blogs/".$blog->id."/view";
                $notification->imageurl="\\uploads\\". Auth::user()->imgsrc();
                $notification->body = Auth::user()->name." likes your blog ".$blog->title;
                $notification->state = 'active';
                $user->notifications()->save($notification);
            }
        }
        else
        {
            $blog->likes--;
            Auth::user()->blogs()->detach($blogid);
        }
        $blog->save();
        return $blog->likes;

        
    }

    }
    public function viewBlog(Blog $blog)
    {
        return view('Blogviewer',compact('blog'));
    }
}
