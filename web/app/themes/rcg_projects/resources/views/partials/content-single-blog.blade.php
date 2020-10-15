<div class="c-intro u-bg--primary o-section">
  <div class="o-section__content o-container">
    <div class="c-intro__content">
      <h1 class="c-intro__headline">{!! $title !!}</h1>
    </div>
  </div>

</div>

<section data-scroll class="c-event o-section o-container">
  <div class="o-section__header">
    <div class="c-event-details o-layout">
      <div class="c-event-details__block o-layout__item u-3/12">
        <div class="c-event-details__label">Published</div>
        <span class="c-event-details__description">@published</span>
      </div>
      <div class="c-event-details__block o-layout__item u-3/12">
        <div class="c-event-details__label">Author</div>
        <span class="c-event-details__description">@author</span>
      </div>


    </div>
  </div>
  <div data-scroll class="o-section__body o-gutenberg-content">
    @content
  </div>
</section>



