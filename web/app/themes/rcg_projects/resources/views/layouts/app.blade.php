@include('partials.header')

<main class="flex-grow" data-barba="container" data-barba-namespace="home">
  @yield('content')
{{--  @hasSection('sidebar')
    <aside class="sidebar">
      @yield('sidebar')
    </aside>
  @endif--}}
</main>

@include('partials.footer')
