@extends('layouts.app')

@section('content')


<h4  class="center grey-text"> Manage Results and Data</h4>



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
  <h4  class="center grey-text"> No datasets have been added to this study as of yet</h4>
@endif
  
<h4  class="center grey-text"> As the author of this study your are authorised to add new Results/Data</h4>

<div class="col s2 md2">
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
        <input type="text" name="title" value="{{ old('title') }}">
        <label> Description <label>
        <input type="text" name="description" value="{{ old('description') }}">

        <br>
        <p> Please attatch a File (XML, CSV, XLSX) </P>

<input type="file" name="file" class="file_input" accept=".xls,.xlsx,.csv,.xml" >

<input type="submit" value="Add" class="btn waves-effect waves-light btn-flat ffa000 amber darken-2 right">
</div></div></div></div>
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
