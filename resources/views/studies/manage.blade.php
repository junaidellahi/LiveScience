@extends('layouts.app')

@section('content')
<div class="row">
<div class="col s6"> <div class= "card-panel grey lighten-2"> 

<form action="/update/{{$studies->id}}" method="POST" enctype="multipart/form-data">
@csrf
    <h4  class="center grey-text"> {{$studies->title}}</h4>


<label> Edit Study Title</label>
    <input type="text" value="{{$studies->title}}" name="title" >

    <label> Edit Abstract</label>
    <input type="text" value="{{$studies->abstract}}" name="abstract" >

    <label> Edit Conlusion</label>

    <input type="text" value="{{$studies->conlcusion}}" name="conclusion" >



    <input type="submit" value="Update" class="btn waves-effect waves-light ffa000 amber darken-2">



    <p class="grey-text">  Author:</p></p>
    
    {{ Auth::user()->name }}
    

</form>
@if ($errors->any())
    
    
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</li>
                
            @endforeach
       
@endif

    

    <p class="grey-text"> Cover Image</p>
    <img src="/images/{{$studies->image}}" alt="Study Image" width="250" height="200">

    <p class="grey-text"> Supporting Document/Eperiment Design</p>

    <a href="/studies/download/{{$studies->id}}"> Download Now <a>




</div></div> 
<div class="col s6"> <div class= "card-panel grey lighten-2">
<p class="grey-text"> Refrences:</p>

@if($references != '[]')
  
@foreach($references as $reference)

<p>{{$reference->type}}, {{$reference->title}},{{$reference->author}},{{$reference->doi}},{{$reference->url}},  <p> <br>

@endforeach
@else

  <p> No references have been added to this study as of yet <p>
  @endif
<form action="/addreference/{{$studies->id}}" method="POST" enctype="multipart/form-data">




    @csrf

    <select  name="type">
      <option value="" disabled selected>Select reference type</option>
      <option value="Book">Book</option>
      <option value="Website">Website</option>
      <option value="Journal">Journal</option>
      <option value="Other">Other</option>
    </select>
    <label>Reference Tyoe</label>
    
    

    <label>Title</label>
    <input type="text" name="title" value="{{ old('title') }}" >
    <label>Author</label>
    <input type="text" name="author" value="{{ old('author') }}">
    <label>DOI</label>
    <input type="text" name="doi">
    <label>URL</label>
    <input type="text" name="url">
    <input type="submit" value="Add reference" class="btn waves-effect waves-light ffa000 amber darken-2 right"> <br>
</form>

@if ($errors->any())
    
    
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</li>
                
            @endforeach
       
@endif


<br><br>










@endsection
