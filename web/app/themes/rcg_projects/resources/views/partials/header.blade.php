
<header class="c-page-head" data-scroll-section>
  <div class="c-page-head__meta o-container">
    <div class="c-logo">
      <a href="/" class="c-logo__link">
        <svg id="ulLogo" class="c-logo__media">
          <use href="@asset('svg/svgMap.svg#ulLogo')"/>
        </svg>
      </a>
      <div class="c-page-head__divider --full"></div>
      <a class="c-logo__subtitle" href="">Research Centre Global Dynamics</a>
    </div>
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
  <nav data-module-nav class="c-page-head__navigation o-container">

    @if ($navigation)
      <div class="c-header-navigation -desktop || js-header-navigation">
        @foreach ($navigation as $item)
          <div class="c-header-navigation__item">
            <a href="{{ $item->url }}" class="c-header-navigation__link @if ($item->children) has-children @endif {{ $item->classes ?? '' }} {{ $item->active ? 'is-active' : '' }}">
              {!! $item->label !!}
            </a>
            @if ($item->children)
              <ul class="c-header-navigation__childlist">
                @foreach ($item->children as $child)
                  <li class="c-header-navigation__childitem {{ $item->classes ?? '' }} {{ $child->active ? 'active' : '' }}">
                    <a class="c-header-navigation__childlink" href="{{ $child->url }}">
                      {{ $child->label }}
                    </a>
                  </li>
                @endforeach
              </ul>
            @endif
          </div>
        @endforeach
      </div>
    @endif
      <button data-nav="menu" class="c-page-head__burger">
        <span></span>
        <span></span>
        <span></span>
      </button>
  </nav>
  <div class="c-page-head__divider"></div>
</header>
