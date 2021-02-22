<div class="c-video -single {{ $isInverted }}">
  <div class="o-grid o-grid-large">
    <div class="c-video__content o-grid_cell u-1/1 u-1/2@desktop">
      <h5>@field('video_author')</h5>
      <h6>@field('video_affiliation')</h6>
      <p class="post__paragraph post__paragraph">@field('video_cv')</p>
    </div>
    <div class="c-video__embed o-grid_cell u-1/1 u-1/2@desktop">
      <figure class="wp-block-embed-youtube wp-block-embed is-type-video is-provider-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio">
        <div class="wp-block-embed__wrapper">
          @field('video_embed')
        </div>
      </figure>
    </div>
  </div>
</div>
