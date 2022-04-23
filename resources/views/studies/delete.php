@extends('layouts.app')

@section('content')



<div class="container">
    


    
    @foreach($studies as $study)
          
    <div class="col s2 md2">
					<div class="card z-depth-0">
						<div class="card-content center">
   <h5>  {{$study->title}} </h5>
   <ul class="grey-text">
       <li> {{$study->subject}} </li>
       <li> {{$study->descripton}} </li>


       <img src="{{$study->image}}" alt="Study Image">

    

</ul>

<form action="mystudies/{{$study->id}}" method="POST">
    @CSRF
    @method('DELETE')
<div class="card-action right-align">
<input type="submit" value="DELETE" class="btn waves-effect waves-light ffa000 amber darken-2">
</div> 
</form>

</div>
</div>
          
        @endforeach
</div>
</div>


@endsection