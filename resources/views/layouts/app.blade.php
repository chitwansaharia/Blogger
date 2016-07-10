<!DOCTYPE html>
<html lang="en">
<head>


    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blogger</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
     
   

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        .popover{
            width:1000px;
        }
        div#notificationbox{
            display:none;
            position:absolute;
            position:fixed;
            top:45px;
            width: 30%;
            height: 70%;
            right:0;
            
            overflow:scroll;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
           
        }
        #notifynav{
            position:fixed;
            width:30%;
            margin-left:945px;
            margin-top:50px;
            min-height:1px;
            }
            #seemore{
                position:fixed;
                width:30%;
                margin-left:945px;
                margin-bottom:135px;
                min-height:1px;
            }
            .notif{
                margin-top:-20px;
                margin-bottom:-20px;
            }
            body{
                background-image:url("\\background.png");
                background-size: cover;
            }
            .header{
                background:#4271BA;

            }
            #searchsuggest{
                background:white;
                position:absolute;
                position:fixed;
                top:52px;
                left:295px;
                width:316px;
                 box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);


            }
            .notifications:hover{
                cursor:pointer;
            }

            

       

    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-fixed-top header ">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" style="color:#ffffff;" href="{{ url('/') }}"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;
                    Blogger
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if(!Auth::guest())
                <ul class="nav navbar-nav">
                    <li><a style="color:#ffffff;" href="{{ url('/user') }}"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Home</a></li>
                    <li><form class="form form-horizontal" method="get" action="/search"><input style="margin-top:10px;margin-bottom:-10px;" size = "40"type="text" class="form-control searchbox" name = "searchkey" placeholder="Search for your Friends"> </li>
                    <li><button style="margin-top:10px;" type="submit" class="btn btn-primary" style="background-color:#15555D;"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Search</button></li></form>
                </ul>
                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a style="color:#ffffff;" href="{{ url('/login') }}">Login</a></li>
                        <li><a style="color:#ffffff;" href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown"><a style="color:#ffffff;" data-toggle="modal" href="#newBlog" role="button" aria-expanded="false">New Blog</a></li>
                        <li class="dropdown"><a class='notifications'   aria-expanded="false"><span style="color:#ffffff;" class="glyphicon glyphicon-globe"></span>
                        </a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:white;" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                <li><a data-toggle="modal" href="#newPhoto"><span class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp;Profile Picture</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <br><br><br>
@if(!Auth::guest())
<div id="searchsuggest"  data-html="true"></div>
<div id="notificationbox" >
<nav id = "notifynav" style="text-align:center;color:white" class="navbar navbar-inverse navbar-fixed-top">Notifications
</nav>
<br><br>
@if(Auth::user()->notifications->count()>0)
@foreach(Auth::user()->notifications->reverse() as $notification)
<a  class="list-group-item notif" href = "{{$notification->url}}"><img src= "{{$notification->imageurl}}" alt="Profile Picture" style="float:left" width="50" height="50">
<div style="margin-left:10px;">
<b>
{{$notification->body}}</b><br>
{{$notification->updated_at}}
</div>
</a>
<hr>
@endforeach
<nav id="seemore" style="text-align:center;color:white;" class="navbar navbar-inverse navbar-fixed-bottom"><a href="#">See All</a>
</nav>
@else
<div>
<h3 style="text-align:center;">
No New Notifications For You!!
</h3>
</div>
@endif
</div>
<div id = "searchshow" style="display:none">

</div>
@endif
<div id = "suggest" style="display:none"></div>
<div id = "mainbody" >
    @yield('content')
</div>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
     <!-- JQuery -->
    
    </SCRIPT> 
<!-- Modal -->
@if(!Auth::guest())
<div id="newPhoto" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Change Profile Picture</h4>
</div>
<div class="modal-body">
<form class="form-horizontal" method="post" action="/upload" enctype="multipart/form-data">
<input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}">
<input type="file" name="file" class="form-control"><br>
<button class="btn btn-info" type="submit">Upload</button>
</form>
</div>
</div>
</div>
</div>
<!--Modal Ends-->
<!--Modal-->
<div id="newBlog" class="modal fade" role="dialog">
<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add a New Blog</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method= "POST"  action = "/{{Auth::user()->id}}/addblog">
        
        <input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}">
        
  <div class="form-group" >
    <label class="control-label col-sm-2" for="title">Topic:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="title" placeholder="Enter Topic">
    </div>
  </div>
  <div class = "form-group">
  <label class = "control-label col-sm-2" for="body">Content:</label>
  <div class = "col-sm-10">
  <textarea type = "text" rows = "8" class = "form-control input-lg" name = "body" placeholder="What's on Your Mind!!" ></textarea>
  </div>
  </div>
    <div class="form-group"> 
    <div class="col-sm-offset-4 col-sm-10">
        <input type="submit"  class="btn btn-info post"   value="Post">
    </div>
  </div>
   </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--Modal Ends-->
<!--Modal-->
<div id="followers" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Followers</h4>
</div>
<div class="modal-body">
@foreach(Auth::user()->followers as $follower)
<img src= "{{URL::to('/')}}\uploads\{{$follower->imgsrc()}}"   alt="Profile Picture" style="float:left" width="40" height="40">
&nbsp;&nbsp;&nbsp;<a href="/userview/{{$follower->id}}"><b>{{$follower->name}}</b></a><br>&nbsp;&nbsp;&nbsp;<b>{{$follower->email}}</b><hr>
@endforeach
</div>
</div>
</div>
</div>
<!--Modal Ends-->
<!--Modal-->
<div id="following" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">People You Follow</h4>
</div>
<div class="modal-body">
@foreach(Auth::user()->followings as $following)
<img src= "{{URL::to('/')}}\uploads\{{$following->imgsrc()}}"   alt="Profile Picture" style="float:left" width="40" height="40">
&nbsp;&nbsp;&nbsp;<a href="/userview/{{$following->id}}"><b>{{$following->name}}</b></a><br>&nbsp;&nbsp;&nbsp;<b>{{$following->email}}</b><hr>
@endforeach
</div>
</div>
</div>
</div>
<!--Modal Ends-->
<!--Notification Box-->

@endif
</body>

<script type="text/javascript">
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
</script>
<!-- JQuery -->
    <SCRIPT type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js">
    </SCRIPT> 
@if(!Auth::guest())
<script>
$(document).ready(function(){
    
  $('.notifications').click(function()
  {
    $('#notificationbox').toggle();
  });
 
  $('#mainbody').click(function()
    {
        $('#searchsuggest').text("");
        $('#notificationbox').hide();
    });
  $('.searchbox').keyup(function()
  {
    var hint = $('.searchbox').val();
    //alert(hint);
    if(hint=="")
    {
        $('#searchsuggest').text("");
    }
    else
    {   
        hint = hint.toLowerCase();
        //alert(hint);
        var count = 0;
        var st = "";
        @foreach(Auth::user()->followings as $following)
        var name = "{{$following->name}}";
        if(name.toLowerCase().indexOf(hint)>=0)
        {
            count++;
                st = st + "<a class='list-group-item' href='/userview/{{$following->id}}'>" + "<img src= '\\uploads\\{{$following->imgsrc()}}'  alt='Profile Picture' style='float:left' width='40' height='40'>" + "<div style='margin-left:10px;'><b>{{$following->name}}</b><br>{{$following->email}}</div></a>"
        }
        @endforeach
        st = st + "<div class='list-group-item'><h5><span class='glyphicon glyphicon-search'></span>&nbsp;&nbsp;Search All results for '<b>"+hint+"<b>'</div></h5>";
        if(count==0)
        {   
            
            document.getElementById('searchsuggest').innerHTML=st;
        }
        else
        {   
            var st1 = "<div style='background:black;color:white;'><b>Are You Looking For Any of the Following:</b></div>";
            st = st1 + st;
            document.getElementById('searchsuggest').innerHTML = st;
        }
    }
  });

  });

    
</script>
@endif



</html>
