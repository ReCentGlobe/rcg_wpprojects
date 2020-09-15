<section class="o-container flex bg-white">
  <article @php(post_class('o-gutenberg-content flex flex-col px-8 md:px-16 lg:px-0 max-w-4xl mx-auto'))>
    <header>
      <h1 class="c-heading -h2">
        {!! $title !!}
      </h1>

      @include('partials/entry-meta')
    </header>

    <div class="entry-content">
      @content
    </div>

    <footer>
      {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
    </footer>
  </article>
</section>


