<div class="c-intro u-bg--secondary o-section">
  <div class="c-intro__bg">
    <div class="c-fixed_wrapper" data-scroll data-scroll-repeat>
      <div class="c-fixed_target" id="fixed-target"></div>
      <img src="@thumbnail('full', false)" class="c-fixed" data-scroll data-scroll-sticky data-scroll-target="#fixed-target"></img>
    </div>
  </div>
  <div class="o-section__content o-container">
    <div class="c-intro__content">
      <h1 class="c-intro__headline">@field('event_shorttitle')</h1>
    </div>
  </div>

</div>
<section data-scroll class="c-event o-section o-container" itemscope itemtype="https://schema.org/Event">
  <div class="o-section__header">
    <div class="c-event-details o-layout">
      @php
        $startdate = get_field('event_startdate');
        $enddate = get_field('event_enddate');
        $wholedate = get_field('event_wholeday');

        $dateformat = __('M j, Y', 'rcgproject');

      @endphp
      <div class="c-event-details__block o-layout__item u-padding-bottom-tiny">
        <div class="c-event-details__date" itemprop="startDate" content="{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('Y-m-d') }}">
          {{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format($dateformat) }}
        </div>
        <div class="c-event-details__type">
          @term('event-category')
        </div>
      </div>
      <div class="c-event-details__block o-layout__item u-4/12@tablet">
        <h3 class="c-event-details__title" itemprop="name">@field('event_title')</h3>
        <h6 class="c-event-details__subtitle" itemprop="alternateName">@field('event_subtitle')</h6>
      </div>
      @if($startdate && $enddate)
        <div class="c-event-details__block o-layout__item u-1/4@tablet">
          <div class="c-event-details__label">{{__('Date','rcgproject')}}</div>
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
      <div class="c-event-details__block o-layout__item u-2/12@tablet">
        <div class="c-event-details__label">{{__('Location','rcgproject')}}</div>
        <span class="c-event-details__description" itemprop="location">@field('event_location')</span>
      </div>
      @endfield

      @hasfield('event_organization_repeater')
      <div class="c-event-details__block o-layout__item u-1/4@tablet">
        <div class="c-event-details__label">{{__('Organization','rcgproject')}}</div>
        @fields('event_organization_repeater')
        <span class="c-event-details__description">@sub('event_organization')</span>
        @endfields
      </div>
      @endfield

      @hasfield('event_language')
      <div class="c-event-details__block o-layout__item u-2/12@tablet">
        <div class="c-event-details__label">{{__('Language','rcgproject')}}</div>
        <span class="c-event-details__description" itemprop="inLanguage">@field('event_language')</span>
      </div>
      @endfield

      @hasfield('event_downloads')
      <div class="c-event-details__block o-layout__item u-1/4@tablet">
        <div class="c-event-details__label">{{__('Downloads','rcgproject')}}</div>
        <span class="c-event-details__description">@field('event_downloads')</span>
      </div>
      @endfield

      @hasfield('event_addinformation')
      <div class="c-event-details__block o-layout__item u-1/4@tablet">
        <div class="c-event-details__label">{{__('Information','rcgproject')}}</div>
        <span class="c-event-details__description">@field('event_addinformation')</span>
      </div>
      @endfield

      @hasfield('event_contact')
      <div class="c-event-details__block o-layout__item 2/12@tablet">
        <div class="c-event-details__label">{{__('Contact','rcgproject')}}</div>
        <span class="c-event-details__description">@field('event_contact')</span>
      </div>
      @endfield






    </div>
  </div>
  <div data-scroll class="o-section__body o-gutenberg-content">
    @content
  </div>
</section>



