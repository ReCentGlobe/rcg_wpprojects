<footer data-scroll-section class="c-footer">
  <div class="o-section">
    <div class="o-section__content o-container">
      <div class="c-footer__content o-layout">
        <div class="o-layout__item u-1/2">
          <div class="c-footer__logo">
            <a href="{{ home_url('/') }}" class="">{{ $siteName }}</a>
          </div>
          <div class="c-footer__box c-footer__box--left">
            <div class="c-footer__newsletter">
              <p>
                @option('newsletter_headline')
              </p>
              <a
                href="@option('newsletter_link', 'url')"
                target="@option('newsletter_link', 'target')"
                class="o-btn">@option('newsletter_link', 'title')</a>
            </div>
          </div>
        </div>
        <div class="o-layout__item u-1/2">
          <div class="c-footer__box c-footer__box--right">
            <p class="text-gray-600 hidden lg:block p-0 lg:pr-12">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
          </div>
        </div>

      </div>
      <div class="c-footer__footer">
        <ul class="c-footer__footernav">
          <li>Contact</li>
          <li>Imprint</li>
        </ul>
      </div>
    </div>
  </div>
</footer>
