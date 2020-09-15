<section class="c-news-archive bg-white">
  @while($events->have_posts())
    @php $events->the_post() @endphp
      @if($events->current_post % 2)
        @include('components.event-tile',['invert' => false])
      @else
        @include('components.event-tile',['invert' => true])
      @endif
  @endwhile
  @php wp_reset_postdata()  @endphp
</section>

