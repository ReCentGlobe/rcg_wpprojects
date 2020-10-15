@extends('layouts.app')
@section('content')
  @posts
{{--  <div class="o-section o-container">
    <div class="o-module">
      <div class="c-content-slider js-content-slider">
        <div class="c-content-slider__item o-slider__item js-slider-item">
          <div class="o-ratio o-ratio--3:2">
            <div class="o-ratio__content">
              <img class="c-slider__media js-lazyload" src="@field('header_image','url')" alt="">
              <div class="c-slider__controls   o-slider__arrows   js-slider-arrows">
                <button type="button" class="c-slider__arrow c-slider__arrow--prev   o-slider__arrow o-slider__arrow--prev   js-slider-arrow-prev" tabindex="0">
                  <span class="u-sr-only"></span>
                  <svg role="img" class="c-slider__arrow-icon   o-slider__arrow-icon" aria-label="" viewBox="0 0 53 79" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 .038L17.427 39.44 0 78.84h12.448l17.428-39.4L12.448.037z"></path><path d="M22.863.038L40.29 39.44 22.863 78.84H35.31l17.427-39.4L35.311.037z"></path>
                  </svg>
                </button>

                <button type="button" class="c-slider__arrow c-slider__arrow--next   o-slider__arrow o-slider__arrow--next   js-slider-arrow-next" tabindex="0">
                  <span class="u-sr-only"></span>
                  <svg role="img" class="c-slider__arrow-icon   o-slider__arrow-icon" aria-label="Right arrow icon" viewBox="0 0 53 79" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 .038L17.427 39.44 0 78.84h12.448l17.428-39.4L12.448.037z"></path><path d="M22.863.038L40.29 39.44 22.863 78.84H35.31l17.427-39.4L35.311.037z"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
          <div class="c-slider__content o-layout">
            <div class="o-layout__item u-1/2">
              <div class="c-intro-box">
                <div class="c-intro-box__content   u-theme-bg-yellow">
                  <div class="c-intro-box__header">
                    <h2 class="c-intro-box__headline">
                      Title Title
                    </h2>
                  </div>

                  <div class="c-intro-box__text">
                    <p class="c-intro-box__description">Watch the grand IAA Concept Release Event from Munich again and learn all about the new ideas</p>

                    <a href="/en/cars/newsroom/current-issues/concept-release" class="c-intro-box__link" style="transition-delay: .4s" tabindex="0">
                      Continue to the video
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>--}}
  <section class="o-section c-frontpage-slider js-frontpage-slider">
    <div class="o-section__content o-container -canvas"  data-scroll>
      <div class="c-footer__content o-layout">
        <div class="o-layout__item u-1/2">
          <h2 class="c-slider__title" data-scroll data-scroll-speed="2" data-scroll-delay="1">
            <span class="js-slider__title">@field('header_headline')</span>
          </h2>
          <div class="c-slider__description" data-scroll data-scroll-speed="2" data-scroll-delay="1">@field('header_content')</div>
        </div>
        <div class="o-layout__item u-1/2 c-fixed_wrapper c-frontpage-slider__background" data-scroll data-scroll-call="dynamicBackground" data-scroll-repeat style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
          <div class="c-fixed_target" id="fixed-target"></div>
          <div class="c-fixed" data-scroll data-scroll-sticky data-scroll-target="#fixed-target" style="background-image: url(@field('header_image','url'))"></div>
        </div>

      </div>
    </div>
  </section>
{{--
  <div class="c-frontpage-slider js-frontpage-slider" data-scroll data-scroll-call="contentAnimation">
    <div class="o-layout flex bg-white flex-grow" style="min-height:60vh;">
      <div class="o-layout__item u-1/2">
        <div class="c-slider u-padding-large">
          <h2 class="c-slider__title" data-scroll data-scroll-speed="2" data-scroll-delay="1">
            <span class="js-slider__title">@field('header_headline')</span>
          </h2>
          <div class="c-slider__description" data-scroll data-scroll-speed="2" data-scroll-delay="1">@field('header_content')</div>
        </div>
      </div>
      <div class="o-layout__item u-1/2 c-fixed_wrapper" data-scroll data-scroll-call="dynamicBackground" data-scroll-repeat style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
        <div class="c-fixed_target" id="fixed-target"></div>
        <div class="c-fixed" data-scroll data-scroll-sticky data-scroll-target="#fixed-target" style="background-image: url(@field('header_image','url'))"></div>
      </div>
    </div>
    <div style="" class="c-partners u-hidden" data-scroll data-scroll-speed="1" data-scroll-delay="1">
      <div class="u-grid">
        @fields('header_logowrapper')
        <div class="c-partners__logo u-grid_col-2">
          <a href="@sub('link','url')" target="@sub('link','target')" title="@sub('link','name')">
            <img src="@sub('logo','url')" srcset="@sub('logo','srcset')" alt="@sub('logo','alt')">
          </a>
        </div>
        @endfields
      </div>
    </div>

  </div>
--}}

  <section class="o-container flex bg-white">
    <div data-scroll class="o-gutenberg-content flex flex-col px-8 md:px-16 lg:px-0 max-w-4xl mx-auto">
      @content
    </div>
  </section>
  @endposts
@endsection

