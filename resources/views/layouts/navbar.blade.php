
<!DOCTYPE html>
<html>
<head>

        <meta charset="utf-8">


         
         @if(isset($medium->name)) 
          <title>{{$medium->name}} on whoisfaking.online</title>
          <meta name="description" content="{{$medium->name}} on whoisfaking.online {{$medium->bio}}">
         @elseif(isset($article->topic))
          <title>{{$article->media->name}} on whoisfaking.online</title>
         <meta name="description" content="{{$article->topic}} | {{$article->media->name}} on whoisfaking.online">
         @else
        <title>whoisfaking.online</title>
         <meta name="description" content="whoisfaking.online - Wikipedia for Fakes">

         @endif
 
         @if(isset($medium->name))
          <meta name="keywords" content="{{$medium->name}}">
         @elseif(isset($article->topic))
         <meta name="keywords" content="{{$article->media->name}},fakenews,@foreach($article->media->category as $categoryname) {{$categoryname->name}},@endforeach">
         @else
         <meta name="keywords" content="whoisfaking.online">
         @endif


         @if(isset($media->user))
          <meta name="author" content="{{$media->user->name}}">
         @elseif(isset($article->user))
         <meta name="author" content="{{$article->user->name}}">
         @else
         <meta name="author" content="whoisfaking.online">

         @endif


        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

 

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

     <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>



</head>
<body>



<div> 
<nav class="navbar navbar-expand-lg navbar-light bg-lg">
  <a class="navbar-brand" href="{{route('index')}}">whoisfaking.online</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      <li>
        <div class="dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" > MEDIA </a>

        <div class="dropdown-menu dropdown-menu-center">
 <a class="dropdown-item" href="{{route('index')}}">All Media</a>
 <a class="dropdown-item" href="{{route('media.add')}}">Add Medium</a>
 <a class="dropdown-item" href="{{route('media.random')}}">Random Medium</a>
  <div class="dropdown-divider"></div>
        <a style="color:tomato" class="dropdown-item" href="{{route('media.review')}}">Review</a>
          </div>
      </div>
      </li>

    <li>
        <div class="dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" > ARTICLE </a>

        <div class="dropdown-menu dropdown-menu-center">
 <a class="dropdown-item" href="{{route('article.index')}}">All Articles</a>
 <a class="dropdown-item" href="{{route('article.addfresh')}}">Add Article</a>
 <a class="dropdown-item" href="{{route('article.random')}}">Random Article</a>
   <div class="dropdown-divider"></div>
   @auth
   @if(Auth::user()->role->name == 'admin' or 'contributor' )
        <a style="color:tomato" class="dropdown-item" href="../article/review">Review</a>
    @else
      <a style="color:tomato" class="dropdown-item" href="../article/review">Review</a>
    @endif
    @endauth


            </div>
        </div>
     </li>

     <li>
        <div class="dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" > CATEGORIES </a>

        <div class="dropdown-menu dropdown-menu-center">

          @if(isset($categories))
          @foreach($categories as $category)

          <a class="dropdown-item" href="{{route('media.categories',$category->id)}}">{{$category->name}}    <span style="background-color:lightblue" class="badge badge-light">{{$category->category_media->count()}}</span></a>



          @endforeach
          @endif
 

            </div>
        </div>
     </li>

     

      @auth
      <li class="nav-item">
       <div class="dropdown">
        



    <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"">{{Auth::user()->name}} </a> 
      <div class="dropdown-menu dropdown-menu-center"> 
                                         

                          <a class="nav-link" href="{{ route('home') }}" > Home</a> 

                               <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                      Logout
                               </a>

                               @if(Auth::user()->role->name = 'admin')

                               <a class="nav-link" style="color:red" href="{{ route('admin') }}" > admin dahsboard</a>


                               @endif

                               


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                  
          </div>
        </div>
        </li>

    @if(Auth::user()->isAdmin())
   <li class="nav-item"> <a class="nav-link" href="">AdminDash</a></li>
   @endif


      @else
      <li class="nav-item">
        <a class="nav-link" href="{{route('login')}}">Login</a>
      </li>
            <li class="nav-item">
        <a class="nav-link" href="{{route('register')}}">Register</a>
      </li>

      @endauth

     
      
      <li class="nav-item">
        <a class="nav-link" style="color:red" class="btn btn-primary" data-toggle="modal" data-target="#messagemodal"  ">write us <span class="glyphicon glyphicon-envelope"></span> </a>

        <div class="modal fade" id="messagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Write us a message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ action('MessageController@store')}}">
                          {{ csrf_field() }}

                          <div class="form-group">
                            <label for="email" class="col-form-label">email</label>
                            <input type="text" class="form-control" name="email" placeholder="@if(isset(Auth::user()->email) ){{Auth::user()->email}} @endif">
                          </div>

                          <div class="form-group">
                            <label for="text" class="col-form-label">Message:</label>
                            <textarea class="form-control" name="text"></textarea>
                          </div>


                          @if(isset(Auth::user()->id))
                            <input type="hidden" name="user_id" vaule="{{Auth::user()->id}}" >
                            @endif                         
                       
                      </div>
                      <div class="modal-footer">
                      
                        <input type="submit" class="btn btn-primary" value="send">
                      </div>
                       </form>
                    </div>
                  </div>
                </div>

      </li>


      
    </ul>

    <form class="form-inline my-2 my-lg-0" method="POST" action="/searchmedia" role="search">

                                        {{ csrf_field() }}



      <input id="q" name="q"  class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="search">
    </form>
  </div>
</nav>
@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
</div>

