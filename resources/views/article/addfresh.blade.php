
@extends('layouts.layout')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('content')

<div class=col-md-9 style="padding-top:50px;">
<div class="row">

<div class="col-md-4"> Please search for the Medium </div>



<div class="col-md-4"> 


 <form class="form-inline my-2 my-lg-0" method="POST" action="/searchmedia" role="search">

                                        {{ csrf_field() }}



      <input id="q" name="q"  class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="search">
    </form>

    </div>

    <div class="col-md-4"> </div>

    </div>

  </div>

    @endsection