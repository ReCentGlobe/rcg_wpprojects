<div class="c-intro u-bg--secondary o-section">
  <div class="o-section__content o-container">
    <div class="c-intro__content">
      <h1 class="c-intro__headline">@field('event_shorttitle')</h1>
    </div>
  </div>

</div>
<section data-scroll class="c-event o-section o-container">
  <div class="o-section__header">
    <div class="c-event-details o-layout">
      @php
        $startdate = get_field('event_startdate');
        $enddate = get_field('event_enddate');
        $wholedate = get_field('event_wholeday');
      @endphp
      <div class="c-event-details__block o-layout__item u-padding-bottom-tiny">
        <div class="c-event-details__date">
          {{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('M j, Y') }}
        </div>
        <div class="c-event-details__type">
          @term('event-category')
        </div>
      </div>
      <div class="c-event-details__block o-layout__item u-4/12">
        <h3 class="c-event-details__title">@field('event_title')</h3>
        <h6 class="c-event-details__subtitle">@field('event_subtitle')</h6>
      </div>
      @if($startdate && $enddate)
        <div class="c-event-details__block o-layout__item u-1/4">
          <div class="c-event-details__label">Date</div>
          <div class="c-event-details__description">
            @if( DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('Y-m-d') == DateTime::createFromFormat('Y-m-d H:i:s', $enddate)->format('Y-m-d'))
              <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('l,') }}</span>
              <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('j F Y') }}</span>
              @if(!$wholedate)
                <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('g:i a') }} - {{ DateTime::createFromFormat('Y-m-d H:i:s', $enddate)->format('g:i a') }}</span>
              @endif
            @else
              <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('l,') }}</span>
              <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('j F Y') }}</span>
              @if(!$wholedate)
                <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('g:i a') }}</span>
              @endif
              <span>-</span>
              <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $enddate)->format('l,') }}</span>
              <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $enddate)->format('j F Y') }}</span>
              @if(!$wholedate)
                <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $enddate)->format('g:i a') }}</span>
              @endif
            @endif
          </div>
        </div>
      @endif
      @hasfield('event_location')
      <div class="c-event-details__block o-layout__item u-2/12">
        <div class="c-event-details__label">Location</div>
        <span class="c-event-details__description">@field('event_location')</span>
      </div>
      @endfield

      @hasfield('event_organization_repeater')
      <div class="c-event-details__block o-layout__item u-1/4">
        <div class="c-event-details__label">Organization</div>
        @fields('event_organization_repeater')
        <span class="c-event-details__description">@sub('event_organization')</span>
        @endfields
      </div>
      @endfield

      @hasfield('event_language')
      <div class="c-event-details__block o-layout__item u-2/12">
        <div class="c-event-details__label">Language</div>
        <span class="c-event-details__description">@field('event_language')</span>
      </div>
      @endfield

      @hasfield('event_downloads')
      <div class="c-event-details__block o-layout__item u-1/4">
        <div class="c-event-details__label">Downloads</div>
        <span class="c-event-details__description">@field('event_downloads')</span>
      </div>
      @endfield

      @hasfield('event_addinformation')
      <div class="c-event-details__block o-layout__item u-1/4">
        <div class="c-event-details__label">Information</div>
        <span class="c-event-details__description">@field('event_addinformation')</span>
      </div>
      @endfield

      @hasfield('event_contact')
      <div class="c-event-details__block o-layout__item 2/12">
        <div class="c-event-details__label">Contact</div>
        <span class="c-event-details__description">@field('event_contact')</span>
      </div>
      @endfield






    </div>
  </div>
  <div data-scroll class="o-section__body o-gutenberg-content">
    @content
  </div>
</section>



