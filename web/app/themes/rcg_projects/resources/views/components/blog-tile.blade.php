<div class="c-blog -single o-layout__item u-1/3@desktop u-1/2@tablet">
  <a class="c-blog__link" href="@permalink">
  <div class="c-blog__media o-ratio o-ratio--16:9">
    <img class="o-ratio__content js-lazyload" data-src="@thumbnail('large', false)">
  </div>
  <div class="c-blog__content">
    <h5 class="c-blog__title">@title</h5>
    @php
      $dateformat = __('F j, Y', 'rcgproject');
    @endphp
    <div class="c-blog__subtitle">@published($dateformat)</div>
    <div class="c-blog__excerpt">{!! wp_trim_words( get_the_content(), 100, '' ) !!}</div>
  </div>
  </a>
</div>
