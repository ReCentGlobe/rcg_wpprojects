<div class="c-intro u-bg--primary o-section">
  <div class="c-intro__bg">
    <div class="c-fixed_wrapper" data-scroll data-scroll-repeat>
      <div class="c-fixed_target" id="fixed-target"></div>
      <img src="@thumbnail('full', false)" class="c-fixed" data-scroll data-scroll-sticky data-scroll-target="#fixed-target"></img>
    </div>
  </div>
  <div class="o-section__content o-container">
    <div class="c-intro__content">
      <h1 class="c-intro__headline">{!! $title !!}</h1>
    </div>
  </div>

</div>

<section data-scroll class="c-event o-section o-container">
  <div class="o-section__header">
    <div class="c-event-details o-layout">
      <div class="c-event-details__block o-layout__item u-3/12@tablet">
        <div class="c-event-details__label">{{__('Published','rcgproject')}}</div>
        <span class="c-event-details__description">@published</span>
      </div>
      <div class="c-event-details__block o-layout__item u-3/12@tablet">
        <div class="c-event-details__label">{{__('Author','rcgproject')}}</div>
        <span class="c-event-details__description">@field('blog_author')</span>
      </div>


    </div>
  </div>
  <div data-scroll class="o-section__body o-gutenberg-content">
    @content
  </div>
</section>



