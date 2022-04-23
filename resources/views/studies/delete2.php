@extends('layouts.app')

@section('content')




<div class="col s2 md2">
					<div class="card z-depth-0">
						<div class="card-content center">
<h4  class="center grey-text"> Results and Data</h4>

@foreach($datasets as $dataset)

<div class="col s6 md6 ">
					<div class="card z-depth-0">
						<div class="card-content center">
   <h5>  {{$dataset->name}} </h5>
   <ul class="grey-text">
    
       
    <a href="/dataset/download/{{$dataset->id}}"> Download Now </a>


       <form action="/deletedata/{{$dataset->id}}" method="POST">
           @csrf
           @method('DELETE')
           <input type="submit" value="Delete" class="btn waves-effect waves-light ffa000 amber darken-2 right"> <br>
</form>
</div>

</div>
</div>

@endforeach
<div class="row">
<div class="col s6 md6">
					<div class="card z-depth-0">
						<div class="card-content center">

<h6> Would you like to add a new dataset to this study? </h6>

<form action="/adddataset" method="POST" enctype="multipart/form-data">
    @csrf
<div class="container">
    <div class="row">

    <input type="hidden" name="study_id" 
value="{{$studies->id}}">

        <label> Dataset Title <label>
        <input type="text" name="title">

        <br>
        <p> Please attatch a File (XML, CSV, XLSX) </P>

<input type="file" name="file" class="file_input">

<input type="submit" value="Add" class="btn waves-effect waves-light ffa000 amber darken-2 right">
</div></div></div></div>
</form>





    

</div>
<form action="/removestudy/{{$studies->id}}" method="POST">
           @csrf
           @method('DELETE')
           <input type="submit" value="Delete this study" class="btn waves-effect waves-light ffa000 amber darken-2 right"> <br>
</form>


<form action="/comment/{{$studies->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>By adding a useful comment you can help support the study and its owner!</label>
<input type="text" class="materialize-textarea" name="comment"></input>
<label> Your comment will be visible with your username</label>
<input type="text" name="user" value="{{ Auth::user()->name}}" readonly>
<input type="submit" value="Comment" class="btn waves-effect waves-light ffa000 amber darken-2">

</form>



 


@endsection
