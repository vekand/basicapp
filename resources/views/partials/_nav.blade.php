
<!-- Default Bootstrap Navbar -->
<nav role="navigation" class="navbar navbar-default navigation-bar ">
  <div class="container-fluid ">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
     <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">{{ trans('messages.chess') }}</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div id="navbarCollapse" class="collapse navbar-collapse navbar-custom"  >
    <ul class="nav navbar-nav" >
      <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">{{ trans('messages.home') }} </a></li>
      <li class="{{ Request::is('carousel') ? 'active' : '' }}"><a href="{{ route('carousel') }}">{{ trans('messages.images') }}</a></li>
      <li class="{{ Request::is('blog') ? 'active' : '' }}"><a href="{{ route('blog') }}">Blog</a></li>
      {{-- <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="{{ route('about') }}">{{ trans('messages.about') }}</a></li>     --}}
      {{-- <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact</a></li> --}}
      @if (Auth::check())
      {{-- <li class="{{ Request::is('help') ? 'active' : '' }}"><a href="{{ route('help') }}">Help</a></li> --}}
      @endif 

       @if (Auth::check())
      <li class="{{ Request::is('tournament') ? 'active' : '' }}"><a href="{{ route('tournamentauth') }}">{{ trans('messages.tournament') }}</a></li>
      @else
      <li class="{{ Request::is('tournament') ? 'active' : '' }}"><a href="{{ route('tournamentguest') }}">{{ trans('messages.tournament') }}</a></li>
      @endif
      
       @if (Auth::check())
      <li class="{{ Request::is('courses') ? 'active' : '' }}"><a href="{{ route('courses.index') }}">{{ trans('messages.course') }}</a></li>
      @endif 
     
    </ul>
     @if (Auth::check())
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ Auth::user()->last_name.' '.Auth::user()->first_name  }}
    @endif
    <ul class="nav navbar-nav navbar-right">
    
      @if (Auth::check())
      <li class="dropdown">
        @if (Auth::user()->hasRole('Visitor')  || Auth::user()->hasRole('Blogger') || Auth::user()->hasRole('Referee') || Auth::user()->hasRole('Teacher') || Auth::user()->hasRole('Student')  || Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
        <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-user" aria-hidden="true"></i> {{ trans('messages.welcome') }} {{ Auth::user()->first_name.' '.Auth::user()->last_name  }}<span class="caret"></span></a>
        @else
        <li><a href="{{ route('logout') }}">Logout {{ Auth::user()->first_name.' '.Auth::user()->last_name  }}</a></li>
        @endif         
        <ul class="dropdown-menu">
          <li><a href="{{ route('posts.index') }}">{{ trans('messages.postu') }}</a></li>
          <li><a href="{{ route('categories.index') }}">{{ trans('messages.cat') }}</a></li>
          <li><a href="{{ route('tags.index') }}">{{ trans('messages.tag') }}</a></li>
          {{--  <li><a href="{{ route('pdf') }}">PDF</a></li> --}}
          <li><a href="{{ route('admin') }}">{{ trans('messages.assign') }}</a></li>
           <li><a href="{{ route('prof') }}">{{ trans('messages.profs') }}</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
      </li>
      @else
      <li class=""><a href="{{ route('login') }}" class=""><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
      <li class=""><a href="{{ route('register') }}" class=""><i class="fa fa-lock" aria-hidden="true"></i> Register</a></li>
      @endif
      <li><a href="#" >|</a></li>      

      @foreach(config('app.languages') as $lang)
      <li class="{{ session('locale') == $lang ? 'active' : '' }}">
        <a href="{{ url('language', $lang) }}" >{{ $lang }}</a>
      </li>
      @endforeach
      
    </ul>
  </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
