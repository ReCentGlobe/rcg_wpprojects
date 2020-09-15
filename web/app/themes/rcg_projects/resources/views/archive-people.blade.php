@extends('layouts.app')

@section('content')
  <section class="c-news-archive bg-white">
    <div class="c-event -single">
      <div class="u-grid">
        <div class="u-grid_col-8">
          <a class="news-post-slideshow" href="/news/post/fonts-in-use-wulkan-display">
            <div class="o-media">
              <picture class="o-ratio u-16:9">
                <source srcset="https://picsum.photos/1500/1500" media="(min-width: 768px)">
                <img class="js-lazyload" data-src="https://picsum.photos/1500/1500">
              </picture>
            </div>
          </a>
        </div>
        <div class="u-grid_col-4">
          <a class="u-text-left" href="/news/post/fonts-in-use-wulkan-display">
            <h6 class="c-heading -h6">09.10.20</h6>
            <h3 class="c-heading -h3">Lorem Ipsum: Dolor</h3>
          </a>
        </div>
      </div>
    </div>
    <div class="c-event -single">
      <div class="u-grid">
        <div class="u-grid_col-4">
          <a class="u-text-right" href="/news/post/fonts-in-use-wulkan-display">
            <h6 class="c-heading -h6">09.10.20</h6>
            <h3 class="c-heading -h3">Lorem Ipsum: Dolor</h3>
          </a>
        </div>
        <div class="u-grid_col-8">
          <a class="news-post-slideshow" href="/news/post/fonts-in-use-wulkan-display">
            <div class="o-media">
              <picture class="o-ratio u-16:9">
                <source srcset="https://picsum.photos/1500/1500" media="(min-width: 768px)">
                <img class="js-lazyload" data-src="https://picsum.photos/1500/1500">
              </picture>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
@endsection
