<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    
  <script>
    $(document).ready(function(){

      $('.sidenav').sidenav();

    });
  </script>
 <script>
$(document).ready(function(){
    $('select').formSelect();
  });
  </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
    nav.nav-center ul {
    text-align: center;
}
nav.nav-center ul li {
    display: inline;
    float: none;
}
nav.nav-center ul li a {
    display: inline-block;
}
.home-img {
float: left; 
margin-right: 10px
 margin-bottom: 5px
}

.home-text{
    font-size: 15px;
}
</style>
</head>
<nav class="nav-wrapper brand-logo #ffa000 amber darken-2">

        <a href="/home" class="brand-logo ">LiveScience!</a>
        <a href="#" class="sidenav-trigger" data-target="mobile-menu">
          <i class="material-icons">menu</i>
        </a>
        <ul class="right hide-on-med-and-down">
        <li><a href="/home">Home</a></li>
          

          @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li><a href="/studies">Study Feed</a></li>
           
           <li><a href="/create">Create Study</a></li>
           <li><a href="/managemystudies">Manage My Studies</a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
</li>

<li>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
</li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
</form>
                            </li>
                            

                        @endguest
         
      
      </ul>
    </div>

    <ul class="sidenav grey lighten-2" id="mobile-menu">
    @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li><a href="/studies">Study Feed</a></li>
           
           <li><a href="/create2">Create Study</a></li>
           <li><a href="/managemystudies">Manage My Studies</a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
</li>

<li>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
</li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
</form>
                            </li>
                            

                        @endguest
</ul>
        
     
  </nav>
</div>
</div>
</div>
@auth
    
   <nav>
    <div class="nav-center">
    <div class="nav-wrapper container">
      <ul id="nav-mobile" class="nav center">
        <li><a href="/studies/category/physics">Physics</a></li>
        <li><a href="/studies/category/animals">Animals</a></li>
        <li><a href="/studies/category/earth">Earth</a></li>
        <li><a href="/studies/category/health">Health</a></li>
        <li><a href="/studies/category/technology">Technology</a></li>
        <li><a href="/studies/category/other">Other</a></li>
      </ul>
    </div>
  </nav>
@endauth

  @yield('content')


</body>
</html>
