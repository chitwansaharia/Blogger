<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function blog()
    {
        return $this->hasMany(Blog::class);
    }
    public function blogs()
    {
        return $this->belongsToMany(Blog::class)->withTimeStamps();
    }
    public function followers() 
    {   
        return $this->belongsToMany(User::class,'followerlist', 'user_id', 'follower_id'  );
    }
    public function followings()
    {
        return $this->belongsToMany(User::class,'followinglist','user_id','following_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function imgsrc()
    {
        $baseid = public_path().'\\uploads\\'.$this->id;
        if(file_exists($baseid.'.jpg'))
        return $this->id.'.jpg';
        elseif(file_exists($baseid.'.png'))
        return $this->id.'.png';
        elseif(file_exists($baseid.'.gif'))
        return $this->id.'.gif';
        else
        return 'default_profile.png';
        
    }
    public function notifications()
    {
    return  $this->hasMany(Notification::class);
       
    }
   
}
