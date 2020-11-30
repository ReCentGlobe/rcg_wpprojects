<a
  @hasfield('event_external') href="@field('event_externallink','url')" @endfield
  href="@permalink"
class="c-event-tile" itemscope itemtype="https://schema.org/Event">
@php
  $startdate = get_field('event_startdate');
  $enddate = get_field('event_enddate');
  $wholedate = get_field('event_wholeday');
@endphp

  <div class="c-event-tile__content">
    <div class="o-layout">
      <div class="c-event-tile__block o-layout__item u-padding-bottom-tiny">
        <div class="c-event-tile__date" itemprop="startDate" content="{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('Y-m-d') }}">
          {{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('M j, Y') }}
        </div>
        <div class="c-event-tile__type">
          @term('event-category')
        </div>
      </div>
      <div class="c-event-tile__block o-layout__item u-1/3@tablet">
        <h3 class="c-event-tile__title" itemprop="name">@field('event_title')</h3>
        <h6 class="c-event-tile__subtitle" itemprop="alternateName">@field('event_subtitle')</h6>
      </div>
      <div class="c-event-tile__block o-layout__item u-1/3@tablet">
        <div class="c-event-tile__label">{{__('Date','rcgproject')}}</div>
        <div class="c-event-tile__description">
          @if($startdate && $enddate)
            @if( DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('Y-m-d') == DateTime::createFromFormat('Y-m-d H:i:s', $enddate)->format('Y-m-d'))
              <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('l,') }}&nbsp;</span>
              <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('j F Y') }}&nbsp;</span>
              @if(!$wholedate)
                <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('g:i a') }} - {{ DateTime::createFromFormat('Y-m-d H:i:s', $enddate)->format('g:i a') }}</span>
              @endif
            @else
              <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('l,') }}&nbsp;</span>
              <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('j F Y') }}&nbsp;</span>
              @if(!$wholedate)
                <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $startdate)->format('g:i a') }}</span>
              @endif
              <span>&nbsp;-&nbsp;</span>
              <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $enddate)->format('l,') }}&nbsp;</span>
              <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $enddate)->format('j F Y') }}&nbsp;</span>
              @if(!$wholedate)
                <span>{{ DateTime::createFromFormat('Y-m-d H:i:s', $enddate)->format('g:i a') }}</span>
              @endif
            @endif
          @endif
        </div>
      </div>
      @hasfield('event_location')
      <div class="c-event-details__block o-layout__item u-1/3@tablet">
        <div class="c-event-details__label">{{__('Location','rcgproject')}}</div>
        <span class="c-event-details__description" itemprop="location">@field('event_location')</span>
      </div>
      @endfield

    </div>
  </div>
</a>
