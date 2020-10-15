<section id="event-list" class="o-section o-container">
  <div class="o-section__header">
    <h2 class="o-section__headline">Events</h2>
  </div>
  <div class="o-section__body">
    <div class="u-margin-bottom">
      <div class="c-filter-wrapper js-filter-wrapper o-form">
        <div class="c-ajax-filter js-ajax-filter js-publication-list__filter u-bleed--right u-bleed--left">
          <div class="c-ajax-filter__wrapper">
            <div class="c-ajax-filter__input">
              <input class="e-input o-form__field" placeholder="Search Events" type="text" id="input" v-model="search">
            </div>
            <div class="c-ajax-filter__input">
              <datepicker :disabledDates="disabledDates" v-model="selectedDate" input-class="e-input o-form__field" @selected="getDate" placeholder="Year & Month" minimum-view="month" maximum-view="year" format="MMMM yyyy"></datepicker>
            </div>
            <div class="c-ajax-filter__input">
              <a href="#" class="c-ajax-filter__clear o-btn" @click.prevent="clearAll">Clear all filters</a>
            </div>
          </div>
          <div class="c-category-filter js-category-filter">
            <ul class="c-category-filter__list">
              @foreach($categories->terms as $category)
                <li class="c-category-filter__item">
                  <input type="checkbox" id="filter_genre[{{ $category->term_id }}]" value="{{ $category->term_id }}">
                  <label for="filter_genre[{{ $category->term_id }}]">{{ $category->name }}</label>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        <a class="c-enable-filter js-enable-filter o-btn" href="#">Filter @svg('images.icon_filter')</a>
      </div>
    </div>
    <div class="c-event -list">
      <div class="c-event-list__content js-event-list__content"></div>
      @include('components.loading')
    </div>
  </div>

</section>

