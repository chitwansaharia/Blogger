@extends('layouts.app')
 <!-- JQuery -->
    <SCRIPT type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js">
    </SCRIPT> 
<script>

$(document).ready(function(){
	$('.follow-button').click(function(){
	id = $(this).attr('name');
    id1 = 'div#'+id;
	 $.ajax({
      url: '/follow',
      type: "post",
      data: {'userid':$(this).attr('name'),'button_name':$.trim($(id1).text()),'_token': $('meta[name=_token]').attr('content')},
      success: function(data){

       
      // $(this).prop('value','Liked');
      // alert($(this).attr('value'));
      	if($.trim($(id1).text())=='Follow')
       $(id1).text('Following');
   	else
   		$(id1).text('Follow');
      

      }
    }); 
   
    

});
$('.like-button').click(function(){
	id = $(this).attr('name');
	id1 = 'div#g'+id;
	
	id = 'span.'+id;
	idval = $(id).text();
	
	
	 $.ajax({
      url: '/likes',
      type: "post",
      data: {'blogid':$(this).attr('name'),'button_name':$.trim($(id1).text()),'_token': $('meta[name=_token]').attr('content')},
      success: function(data){

       $(id).text(data);
      // $(this).prop('value','Liked');
      // alert($(this).attr('value'));
      	if($.trim($(id1).text())=='Like')
       {
       	$(id1).text('Liked');
       	
       }
   	else
   		$(id1).text('Like');
      
   	
      }
    });
   // alert($(id1).text());
   
   
});
});
</script>

@section('content')
<div class="container">
<div style="text-align:center">
<div class="well" style="background:#163CB2;color:white;border-radius:10px;box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.2), 0 10px 20px 0 rgba(0, 0, 0, 0.19);
">
<img src="{{URL::to('/')}}/uploads/{{$user->imgsrc()}}"  class="img-thumbnail" alt="Profile Picture" width="150" height="150">
<h2>{{$user->name}}</h2>
<h3>{{$user->email}}</h3>
@if(Auth::user()->id != $user->id)
<button type="submit" class="btn btn-primary follow-button" name="{{$user->id}}">
<div id="{{$user->id}}">
	<?php
	if(Auth::user()->followings->contains($user))
		echo "Following";
	else
		echo "Follow";
	?>
	</div>
</button>
@endif
</div>
@foreach($user->blog as $blog)
	<div class = "panel panel-info" style="box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.2), 0 10px 20px 0 rgba(0, 0, 0, 0.19);">
	<div class ="panel-heading" style="text-align:left;background:#117A65;"><a style="color:#ffffff;" href="/userview/{{$user->id}}">{{$user->name}}</a><div style="float:right;color:#000000">{{$blog->updated_at}}</div></div>
	
	<div class="panel-body" style="background:#A8D6F0;"><b><h3 style="margin-top:-5px">{{$blog->title}}</h3></b><br>{{$blog->body}}</div>
	<div class="panel-footer" style="background:#B0B4CE;" >
	<a href ="/blogs/{{$blog->id}}/view"><button class ="btn" style="background:#000000;color:#ffffff;">View&nbsp;&nbsp;&nbsp;
	<span class="glyphicon glyphicon-pencil"></span></button></a>
	<button class = "btn like-button" style="background:#000000;margin-left:5px;"  name="{{$blog->id}}">
	<div id="g{{$blog->id}}" style="color:#ffffff">
	<?php
	if(Auth::user()->blogs->contains($blog))
		 echo "Liked";
	else
		 echo "Like";
	?>&nbsp;&nbsp;
	</div>
	</button>
	&nbsp;&nbsp;&nbsp;
	<span style="background:#000000" class= "{{$blog->id}} badge">{{$blog->likes}}</span>
	</div>
	</div>
@endforeach
</div>
</div>

@stop