
<header class="c-page-head is-fixed" data-scroll-sticky data-scroll-section data-scroll data-scroll-speed=".2" data-scroll-delay="1">
  <div class="c-page-head__meta o-container">
    <div class="c-languageswitcher js-languageswitcher">
      <div class="c-languageswitcher__homelink">
        <a href="{{ home_url('/') }}" class="">{{ $siteName }}</a>
      </div>
      <ul class="c-languageswitcher__list o-list-bare">
      @php
        $languages = apply_filters( 'wpml_active_languages', NULL, 'skip_missing=0&orderby=code' );
        if(!empty($languages)){
            foreach($languages as $l){
              if($l['active']) {
                echo '<li class="o-list-bare__item" style="text-transform:uppercase;">';
                echo apply_filters( 'wpml_current_language', NULL );
                echo '</li>';
              }
              if(!$l['active'])  {
                  echo '<li class="o-list-bare__item">';
                  echo '<a href="'.$l['url'].'"  alt="'.$l['language_code'].'" style="text-transform:uppercase;">';
                  echo apply_filters( 'wpml_display_language_names', NULL, $l['code'], false );
                  echo '</a>';
                  echo '</li>';
              }
            }
        }
      @endphp
      </ul>
    </div>
  </div>
  <div class="c-page-head__divider"></div>
  <nav class="c-page-head__navigation o-container">
    @if ($navigation)
      <div class="c-header-navigation -desktop js-header-navigation">
        @foreach ($navigation as $item)
          <div class="c-header-navigation__item">
            <a href="{{ $item->url }}" class="c-header-navigation__link @if ($item->children) has-children @endif {{ $item->classes ?? '' }} {{ $item->active ? 'is-active' : '' }}">
              {!! $item->label !!}
            </a>
          </div>
        @endforeach
      </div>
    @endif
  </nav>
  <div class="c-page-head__divider"></div>
</header>
