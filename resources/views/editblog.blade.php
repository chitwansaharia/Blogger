@extends('layouts.app')
@section('content')
<div class = "container" >
<div class = "well well-sm " style="margin:0 auto;text-align:center;background:#5e88ac;width:50%;">
<h2><b>Edit the Blog</b></h2>
</div>
<br>
<div style="margin:0 auto;width:50%">
<form method = "post" action="/blogs/{{$blog->id}}/edit">
 <input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}">
        
  <div class="form-group">
    <label class="control-label col-sm-2" for="title">Topic:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="title" value="{{$blog->title}}">
    </div>
  </div>
  <br><br>
  <div class = "form-group">
  <label class = "control-label col-sm-2" for="body">Content:</label>
  <div class = "col-sm-10">
  <textarea type = "text" rows = "8" class = "form-control input-lg" name = "body" >{{$blog->body}}</textarea>
  </div>
  </div>
  <br><br><br>
    <div class="form-group"> 
    <div class="col-sm-offset-4 col-sm-10">
        <input type="submit"  class="btn btn-primary"   value="Save Blog">
    </div>
  </div>
	
</form>
</div>
</div>
@stop
