@if( have_rows('theme_logowrapper', 'options') )
<div class="c-logoFooter" data-scroll-section >
  <div class="o-container">
    <div class="c-logoFooter_inner">
      @php
        $logos = get_field('theme_logowrapper','options')
      @endphp

      @while(have_rows('theme_logowrapper', 'options'))
        @php
          the_row()
        @endphp
        <a href="@sub('link','url')" target="_blank" class="c-logoFooter_link">
          <img class="c-logoFooter_media" src="@sub('logo','url')" alt="@sub('logo','alt')">
        </a>
      @endwhile
    </div>
  </div>
</div>
@endif
<footer data-scroll-section class="c-footer">
  <div class="o-section">
    <div class="o-section__content o-container">
      <div class="c-footer__content o-layout">
        <div class="o-layout__item u-1/2@tablet">
          <div class="c-footer__logo">
            <a href="{{ home_url('/') }}" class="">{{ $siteName }}</a>
          </div>
          <div class="c-footer__box c-footer__box--left">
            <div class="c-footer__newsletter">
              <h4>
                @option('newsletter_headline')
              </h4>
              <p>
                @option('newsletter_content')
              </p>
              <a
                href="@option('newsletter_link', 'url')"
                target="@option('newsletter_link', 'target')"
                class="o-btn">@option('newsletter_link', 'title')</a>
            </div>
          </div>
        </div>
        <div class="o-layout__item u-1/2@tablet">
          <div class="c-footer__box c-footer__box--right">
            @option('imprint_content')
          </div>
        </div>

      </div>
      <div class="c-footer__footer">
        @if ($footernavigation)
        <ul class="c-footer__footernav">
              @foreach ($footernavigation as $item)
                <li class="c-footer-navigation__item">
                  <a href="{{ $item->url }}" class="c-footer-navigation__link @if ($item->children) has-children @endif {{ $item->classes ?? '' }} {{ $item->active ? 'is-active' : '' }}">
                    {!! $item->label !!}
                  </a>
                </li>
              @endforeach
        </ul>
        @endif
      </div>
    </div>
  </div>
</footer>
