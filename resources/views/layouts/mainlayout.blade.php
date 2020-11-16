<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layouts.partials.head')
    <script type="text/javascript"src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Jrp9PtHe0WapppUzxbIpMDWMAcV3qE4"></script>
    <script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
  </head>
  <body>
@if(\Illuminate\Support\Facades\Auth::check())
 @include('layouts.partials.nav')

        @include('layouts.partials.header')
 @yield('content')
 @include('layouts.partials.footer-scripts')
@else
  @include('layouts.partials.head')
  @yield('content')
  @endif

  </body>
</html>