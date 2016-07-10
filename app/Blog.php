<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    
    //
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function users()
    {
    	return $this->belongsToMany(User::class)->withTimeStamps();
    }
    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }
}
