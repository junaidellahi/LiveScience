@extends('layouts.app')

@section('content')

<h4 class="center grey-text">Manage your studies!</h4>

    


    @foreach($studies as $study)
          
    <div class="col s2 md2">
					<div class="card z-depth-0">
						<div class="card-content center">

<div>
   <h5>  {{$study->title}} </h5>
   <ul class="grey-text">
       <li> {{$study->subject}} </li>
       <li> {{$study->descripton}} </li>
       <img src="/images/{{$study->image}}" alt="Study Image" width="125" height="100">
</ul>

<div class="card-action center-align">
   
   <a href="/studies/manage/{{$study->id}}">Edit Study Details</a>
   <a href="/studies/manageresults/{{$study->id}}">Manage results/data</a>
   <a href="/studies/managecomments/{{$study->id}}">Manage comments/feedback</a>
   
</div> 

</div>
</div>
          
        @endforeach

   
        

        
        
</div>
</div>


@endsection