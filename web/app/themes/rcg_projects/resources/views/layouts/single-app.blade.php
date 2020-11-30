<div data-module-scroll="main"  class="o-scroll">
  @include('partials.fixed-header')
  <main class="js-main-content" data-scroll-section>
    @yield('content')
  </main>
  @include('partials.footer')
</div>
