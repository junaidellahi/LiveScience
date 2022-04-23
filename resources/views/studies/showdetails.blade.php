@extends('layouts.app')

@section('content')
<br>
@if($likes == '0') 
<form action="/studies/like/{{$studies->id}}" class="right-align" method="POST">
             @csrf
            
             <input type="hidden" name="likestatus" value="like" >
             <input type="submit" value="Like" class="btn waves-effect waves-light btn-flat ffa000 amber darken-2 "> <br>
  </form>
  @elseif($likes == '1')
  <form action="/studies/like/{{$studies->id}}" class="right-align" method="POST">
             @csrf
             
             <input type="hidden" name="likestatus" value="unlike" >
             <input type="submit" value="Unlike" class="btn waves-effect waves-light btn-flat ffa000 amber darken-2 "> <br>
  </form>
 

  @endif



<br> <br>
<div class="row">
<div class="col s6"> <div class= "card-panel grey lighten-2"> 
    <h4  class="center grey-text"> {{$studies->title}} </h4>

    <p class="grey-text"> Abstract:</p>
    <p>{{$studies->abstract}}</p>
    <p class="grey-text"> Lead Author:</p>
    <p>  {{$studies->author}}</p>
    <p class="grey-text"> Cover Image</p>
    <img src="/images/{{$studies->image}}" alt="Study Image" width="250" height="200">

    <p class="grey-text"> Supporting documentation</p>
@if($studies->file == 'no file')
<p>No Supporting Documentation has been uploaded</p>
@else
<a href="/studies/download/{{$studies->id}}"> Download Now </a>
@endif

</div>
</div>

<div class="col s6"> <div class= "card-panel grey lighten-2">
  @if($references != '[]')
  @foreach($references as $reference)

<p><strong>{{$reference->type}}:</strong> {{$reference->title}}, by {{$reference->author}}, <strong>DOI: </strong>{{$reference->doi}}, <strong>URLI: </strong>{{$reference->url}},  <p> <br>

@endforeach
@else

<p> No references have been added to this study as of yet <p>
  @endif

<p class="grey-text"> Conclusion:</p>
<p>  {{$studies->conlcusion}}</p>
<div class="card-action center-align">
<a class=" waves-light btn-flat ffa000 amber darken-2">{{$numberoflikes}} Likes</a>
</div>
</div>

</div>
</div>

<h4  class="center grey-text"> Results and Data</h4>

@if($datasets != '[]')
  
  @foreach($datasets as $dataset)
  
  
  <div class="col s2 md2">
            <div class="card z-depth-0">
              <div class="card-content center">
  <div>
     <h5>  {{$dataset->name}}  </h5>
     <ul class="grey-text">
       <li> {{$dataset->description}}</li>
       <div class="card-action">
       <li><a href="/dataset/download/{{$dataset->id}}" > Download Now </a> </li>
          </div>
       
  </div>
  </ul>
  <div class="card-action center-align">
  
  <form action="/deletedata/{{$dataset->id}}" method="POST">
             @csrf
             @method('DELETE')
             <input type="submit" value="Delete" class="btn waves-effect waves-light btn-flat ffa000 amber darken-2 "> <br>
  </form>
  </div>
  
  </div></div>
     
  
  @endforeach
  
  @else
    <h4  class="center grey-text"> The author has not uploaded any results or data as of yet. Feel free to give your peer review, opinions or evalutation using the form below.</h4>
  @endif


<br>
<h4  class="center grey-text"> Comments</h4>
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
      
</div>
</div>
</div>
</div>
</div>
    @endforeach
 


    <div class="col s2 md2">
					<div class="card z-depth-0">
						<div class="card-content center">
<form action="/comment/{{$studies->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    <h6>Add a comment from yourself!</h6>
<input type="text" class="materialize-textarea" name="comment" ></input>
<label> Your comment will be visible with your username</label>
<input type="text" name="user" value="{{ Auth::user()->id}}" hidden>
<input type="text" name="username" value="{{ Auth::user()->name}}" hidden>
<div class="card-action">
<input type="submit" value="Comment" class="btn waves-effect waves-light btn-flat ffa000 amber darken-2">
</div> </div></div>
</form>
@if ($errors->any())
    <div class="alert alert-danger center">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red;">{{ $error }}</li>
                
            @endforeach
        </ul>
    </div>

</div>
</div>
@endif
 

 
@endsection





