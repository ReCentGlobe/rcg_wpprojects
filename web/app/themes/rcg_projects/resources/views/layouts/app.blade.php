@include('partials.header')
<div class="c-loadingscreen">
  <div class="c-loadingscreen__layer">
  </div>
</div>
<div data-barba="wrapper">
  <main class="flex-grow" data-barba="container" data-barba-namespace="{{$post->post_name}}">
    @yield('content')
  {{--  @hasSection('sidebar')
      <aside class="sidebar">
        @yield('sidebar')
      </aside>
    @endif--}}
  </main>
</div>

@include('partials.footer')
