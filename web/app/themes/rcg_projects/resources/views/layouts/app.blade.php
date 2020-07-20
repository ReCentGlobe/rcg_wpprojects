@include('partials.header')

<main class="container" data-barba="container" data-barba-namespace="home">
  <div class="main">
    @yield('content')
  </div>

  @hasSection('sidebar')
    <aside class="sidebar">
      @yield('sidebar')
    </aside>
  @endif
</main>

@include('partials.footer')
