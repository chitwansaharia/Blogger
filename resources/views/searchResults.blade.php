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
       if($.trim($(id1).text())=='Follow')
       $(id1).text('Following');
   	else
   		$(id1).text('Follow');
      

      }
    }); 
   
    

});
});
</script>
<style>
a:hover{
  box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.2), 0 10px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
@section('content')
<div class = "container">
@if($filtered->isEmpty())
<h3 style="text-align:center;">No User Matches your Search</h3>
@else
<h3>Following Users Match your Search</h3><br><hr>
@endif
<div class="list-group">
@foreach($filtered as $user)
<a style="background:#1F618D;height:120px;color:white;" href = "/userview/{{$user->id}}" class = "list-group-item">
<img src= "{{URL::to('/')}}\uploads\{{$user->imgsrc()}}"  class="img-thumbnail" alt="Profile Picture" style="float:left" width="100" height="100">
<b>&nbsp;&nbsp;Name:&nbsp;</b>{{$user->name}}<br>
<b>&nbsp;&nbsp;Email:&nbsp;</b>{{$user->email}}
</a>
<br>
@if($user->id != Auth::user()->id)
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

<hr>

@endforeach
</div>
</div>


@stop