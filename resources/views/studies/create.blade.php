@extends('layouts.app')

@section('content')
<h4 class="center grey-text">Create a new study using the form below</h4>
 
<form action="/createstudy" method="POST" enctype="multipart/form-data">
    @csrf
<div class="container">
    <div class="row">
        

    <label>Study Title </label>
    <input type="text" name="title" value="{{ old('title') }}">
      <div class="input-field col s12">
    <select  name="subject">
      <option value="" disabled selected>Select the subject</option>
      <option value="Physics">Physics</option>
      <option value="Animals">Animals</option>
      <option value="Earth">Earth</option>
      <option value="Health">Health</option>
      <option value="Technology">Technology</option>
      <option value="Other">Other</option>
    </select>
    <label>Select the subject</label>
  </div>

    <label>Please provide an abstract/description of the study?</label>
    
    <input type="text" class="materialize-textarea" value="{{ old('abstract') }}" name="abstract"></input>

    <label>Would you like to add some images to your study gallery?</label>
    <br>

    <input type="file" name="image" value="{{ old('image') }}" class="file_input" accept="image/*">
    <br>
<label> Author: </label>
<input type="text" name="author" value="{{ Auth::user()->email}}" readonly>

<label>Would you like to a relevant file to your study?</label>
    <br>

    <input type="file" name="file" value="{{ old('title') }}" class="file_input" accept=".pdf">
</div>
</div>
</div>
</div>
    <br>
    <br>
    <div class="row">
        <div class="col s6 offset-s4">
            
            <input type="submit" value="Create Study" class=" center btn waves-effect waves-light ffa000 amber darken-2">
        </div>
    </div>
 

</div>
            
</div>
</div> 
</form>
<div class="container">
    <div class="row">
        
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