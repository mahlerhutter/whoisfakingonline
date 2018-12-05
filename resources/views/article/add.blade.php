
@extends('layouts.layout')
@extends('layouts.sidebar')
@extends('layouts.navbar')


@section('content')

	<div class="col-md-9" style="padding-top:50px"> 

@if(isset($q))


<div class="alert alert-warning" role="alert">
 sorry, we did not find any matching Medium for <strong>{{$q}} </strong>- do you want to <a href="{{route('media.add')}}">add it</a>?
</div>

@endif

@if(isset($media))

	<table class="table  table-striped table-hover">

 <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Pic</th>
      <th scope="col">Principal</th>
      <th scope="col">Short</th>
     
      
    </tr>
  </thead>
  <tbody>
    @foreach($media as $medium)
    <tr>
      <th scope="row"><a href="../media/view/{{$medium->id}}">{{$medium->name}}</a></th>
      <td>
        @if(isset($medium->picpath->logo))
        <img src="../img/{{$medium->picpath->logo}}" class="img-fluid img-thumbnail" style="height: 70px;width: 70px"> @endif</td>
      <td>{{$medium->finalprincipal}}</td>
      
      <td>{{substr($medium->bio,0,100)}}<a href="../media/view/{{$medium->id}}">.....</a></td>

        <td><a href="../article/addarticle/{{$medium->id}}">add fake article</a></td>
    
    </tr>
    @endforeach
  </tbody>

	


</table>


@endif
</div>

@endsection