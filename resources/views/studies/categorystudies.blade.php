@extends('layouts.app')

@section('content')

<h4 class="center grey-text">View all {{$category}} studies!</h4>

<div class="container">
    

    @foreach($studies as $study)
          
    <div class="col s2 md2">
					<div class="card z-depth-0">
						<div class="card-content center">
   <h5>  {{$study->title}} </h5>
   <ul class="grey-text">
       <li> {{$study->subject}} </li>
       <li> {{$study->descripton}} </li>

</ul>
<div class="card-action right-align">
    
   <a href='/studies/{{$study->id}}'> See More</a>
   
  
   
</div> 

</div>
</div>
          
        @endforeach

    
</div>
</div>


@endsection