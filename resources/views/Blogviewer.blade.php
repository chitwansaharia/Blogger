@extends('layouts.app')
<!--JQuery-->
<SCRIPT type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js">
</SCRIPT> 
<!--JQuery-->
<!--JavaScript-->
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
<div class="container" style="text-align:center">
<div class = "panel panel-info">
<div class ="panel-heading" style="text-align:left;background:#5977F0;"><a href="/userview/{{$blog->user->id}}" style="color:#000000">{{$blog->user->name}}</a><div style="float:right;color:#000000;">{{$blog->updated_at}}</div></div>
<div class="panel-body" style="background:#A8D6F0;"><b><h3 style="margin-top:-5px">{{$blog->title}}</h3></b><br>{{$blog->body}}</div>
<div class="panel-footer"  style="background:#B0B4CE;" >
@if(Auth::user()->blog->contains($blog))
<a href ="/blogs/{{$blog->id}}"><button class ="btn" style="background:#000000;color:#ffffff;">Edit&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span></button></a>
@endif
<button type="button" class = "btn btn-info like-button" style="background:#000000;"  name="{{$blog->id}}">
	<span id="{{$blog->id}}">
	<?php
	if(Auth::user()->blogs->contains($blog))
		echo "Liked";
	else
		echo "Like";
	?>
	</span>&nbsp;&nbsp;<span style="color:#ffffff" class="glyphicon glyphicon-thumbs-up"></span></button>
	&nbsp;&nbsp;&nbsp;
	<span style="background:#000000;" class= "{{$blog->id}} badge">{{$blog->likes}}</span>
	</div>
</div>
<form class="form-horizontal" method="post" action="/blogs/{{$blog->id}}/comment">
<input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}">
<textarea class="form-control" placeholder="Add a comment" name="comment"></textarea><br>
<button type="submit" class="btn btn-primary">Comment</button>
</form>
<hr>
<h1 style="text-align:center">Comments</h1>
@foreach($blog->comments as $comment)
<div class = "panel panel-info">
<div class ="panel-heading" style="text-align:left;"><a href="/userview/{{$comment->user->id}}" style="color:#000000">{{$comment->user->name}}</a><div style="float:right;color:#000000;">{{$comment->updated_at}}</div></div>
<div class="panel-body"><b>
{{$comment->body}}</b></div>
</div>
<hr>
@endforeach

</div>
@stop