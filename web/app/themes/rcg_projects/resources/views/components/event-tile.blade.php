<div class="c-event -single">
  <div class="u-grid">
    @if($invert)
    <div class="u-grid_col-8">
      <a class="news-post-slideshow" href="@permalink">
        <div class="o-media">
          <picture class="o-ratio u-16:9">
            <source data-srcset="https://picsum.photos/1500/1500" media="(min-width: 768px)">
            <img class="js-lazyload" data-src="https://picsum.photos/1500/1500">
          </picture>
        </div>
      </a>
    </div>
    <div class="u-grid_col-4">
      <a class="u-text-left" href="@permalink">
        <h6 class="c-heading -h6">@published('F j, Y')</h6>
        <h3 class="c-heading -h3">  @title</h3>
      </a>
    </div>
    @else
      <div class="u-grid_col-4">
        <a class="u-text-right" href="@permalink">
          <h6 class="c-heading -h6">@published('F j, Y')</h6>
          <h3 class="c-heading -h3">@title</h3>
        </a>
      </div>
      <div class="u-grid_col-8">
        <a class="news-post-slideshow" href="@permalink">
          <div class="o-media">
            <picture class="o-ratio u-16:9">
              <img class="js-lazyload" data-src="https://picsum.photos/1500/1500">
            </picture>
          </div>
        </a>
      </div>
    @endif
  </div>
</div>
