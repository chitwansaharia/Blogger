@extends('layouts.app')
 <!-- JQuery -->
    <SCRIPT type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js">
    </SCRIPT> 
<script>
$(document).ready(function(){
$('.like-button').click(function(){
	id = $(this).attr('name');
	id1 = 'span#'+id;
	id = 'span.'+id;
	idval = $(id).text();
	
	
	 $.ajax({
      url: '/likes',
      type: "post",
      data: {'blogid':$(this).attr('name'),'button_name':$.trim($(id1).text()),'_token': $('meta[name=_token]').attr('content')},
      success: function(data){

       $(id).text(data);
    	if($.trim($(id1).text())=='Like')
       $(id1).text('Liked');
   	else
   		$(id1).text('Like');
      

      }
    }); 
    

});
});
</script>

@section('content')

<div class = "container">

<div style="text-align:center">
<div class="well" style="background:#163CB2;color:white;border-radius:10px;box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.2), 0 10px 20px 0 rgba(0, 0, 0, 0.19);
">
<img src= "{{URL::to('/')}}\uploads\{{Auth::user()->imgsrc()}}"  class="img-thumbnail" alt="Profile Picture" width="150" height="150">
<h2>{{Auth::user()->name}}</h2>
<h3>{{Auth::user()->email}}</h3>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#followers">Followers&nbsp;&nbsp;&nbsp;<span class="badge">{{Auth::user()->followers->count()}}</span></button>
&nbsp;&nbsp;&nbsp;
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#following">Following&nbsp;&nbsp;&nbsp;<span class="badge">{{Auth::user()->followings->count()}}</span></button>
</div>
<div class="well well-sm" style="background:#1E8449;height:80px;"><h1 style="letter-spacing:3px;text-shadow: 2px 2px ;margin-top:10px;">BLOGS</h1></div>

	@foreach(Auth::user()->blog as $blog)
	<div class = "panel panel-info" style="box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.2), 0 10px 20px 0 rgba(0, 0, 0, 0.19)">
	<div class ="panel-heading" style="text-align:left;background:#117A65  ;"><a style="color:#ffffff;" href="/userview/{{Auth::user()->id}}">{{Auth::user()->name}}</a><div style="float:right;color:#000000">{{$blog->updated_at}}</div></div>
	
	<div class="panel-body" style="background:#A8D6F0;"><b><h3 style="margin-top:-5px">{{$blog->title}}</h3></b><br>{{$blog->body}}</div>
	<div class="panel-footer" style="background:#B0B4CE;" >
	<a href ="/blogs/{{$blog->id}}/view"><button class ="btn" style="background:#000000;color:#ffffff;">View&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span></button></a>
	<a href="/blogs/{{$blog->id}}"><button   class ="btn" style="background:#000000;color:#ffffff;">Edit&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span></button></a>
	
	
	<button class = "btn like-button" style="background:#000000;margin-left:5px;"  name="{{$blog->id}}">
	<span id="{{$blog->id}}" style="color:#ffffff">
	<?php
	if(Auth::user()->blogs->contains($blog))
		echo "Liked";
	else
		echo "Like";
	?>
	</span>&nbsp;&nbsp;<span style="color:#ffffff" class="glyphicon glyphicon-thumbs-up"></span></button>
	&nbsp;&nbsp;&nbsp;
	<span style="background:#000000" class= "{{$blog->id}} badge">{{$blog->likes}}</span>
	</div>
	</div>

	

	@endforeach	


</div>
</div>
</div>
</div>
@stop