@extends('layouts.app')

@section('content')
<h4 class="center grey-text">View All Studies!</h4>
<div class="container">
    @foreach($studies as $study)    
    <div class="col s2 md2">
					<div class="card z-depth-0">
						<div class="card-content center">
   <h5>  {{$study->title}} </h5>
   <ul class="grey-text">
       <li> {{$study->subject}} </li>
       <li> {{$study->descripton}} </li>
       <img src="/images/{{$study->image}}" alt="Study Image" width="125" height="100">


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