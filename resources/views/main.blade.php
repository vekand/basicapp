<!DOCTYPE html>
<html lang="en">

@include('partials._head')

<body>
  @include('partials._nav')
  <!--  <div class="distanta"></div> -->
  <div class="container body-background">
 
    @include('partials._messages')

    @yield('content')

    @include('partials._footer')

  </div> <!-- .end of container -->

  @yield('scripts')
  
</body>
</html>