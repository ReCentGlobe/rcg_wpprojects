<div data-barba="container" data-barba-namespace="{{ (is_archive()) ? post_type_archive_title() : get_the_title() }}">
  <div data-scroll-container>
  @include('partials.header')
  <main class="flex-grow js-main-content" data-scroll-section>
    @yield('content')
  </main>
  @include('partials.footer')
  </div>
</div>
<div class="c-loadingscreen js-loadingscreen">
  <div class="c-loadingscreen__layer">
  </div>
  <div class="c-loadingscreen__title">
  </div>
</div>
