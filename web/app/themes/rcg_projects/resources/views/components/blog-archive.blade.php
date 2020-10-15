<section class="o-section o-container">
  <div class="o-section__header">
    <h2 class="o-section__headline">Blog</h2>
  </div>
  <div class="o-section__body">
    <div class="c-blogarchive o-layout o-layout--large">
      @while($blogs->have_posts())
        @php $blogs->the_post() @endphp
        @include('components.blog-tile')
      @endwhile
      @php wp_reset_postdata()  @endphp
    </div>
  </div>
</section>

