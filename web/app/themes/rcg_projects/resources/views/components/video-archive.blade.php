<section class="o-section -no-padding">
  <div class="o-container">
    <h2 class="e-maptitle o-section__headline">Videos</h2>
    <h4 class="e-countrytitle js-countrytitle"></h4>
  </div>
  <div id="projectmap" class="c-projectmap" data-module-maps></div>
</section>

<section class="o-section o-container">

  <div class="o-section__body">
    <div class="c-videoarchive">
      @while($videos->have_posts())
        @php $videos->the_post() @endphp
        @include('components.video-tile')
      @endwhile
      @php wp_reset_postdata()  @endphp
    </div>
  </div>
</section>

