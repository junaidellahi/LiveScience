@extends('layouts.app')

@section('content')


<h4  class="center grey-text"> Manage Comments/Peer Review</h4>

    


 @if($comments != '[]')
 @foreach($comments as $comment)
  
 <div class= "row">
<div class="col s12 m12 lg12">
    <div class="col s12 m12 lg12">
    <div class="card horizontal">
      <div class="card-image"> </div>
      <div class="card-stacked">
        <div class="card-content">
        <h5 class=" header">{{$comment->username}}</h5>
          <p> {{$comment->comment}} </p>
        </div>
        <div class="card-action center">
        <form action="/deletecomment/{{$comment->id}}" method="POST">
          @csrf
          @method('DELETE')
          <input type="submit" value="delete" class="btn waves-effect waves-light btn-flat ffa000 amber darken-2"></input>
        </div> </form>
</div>
</div>
</div>
</div>
</div>
    @endforeach
      @else
      <h4  class="center grey-text"> No Comments have been added as of yet. You can use this page to delete
         any comments you wish from your study.</h4>
    @endif

    
    
   


@endsection
