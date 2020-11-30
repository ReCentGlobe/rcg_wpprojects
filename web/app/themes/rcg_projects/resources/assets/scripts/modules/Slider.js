import { module } from "modujs";
import { gsap } from "gsap";
import Swiper from "swiper";

export default class extends module {
  constructor(m) {
    super(m);
  }

  init() {
    const contentSwiper = new Swiper(".js-content-slider", {
      loop: true,
      effect: "fade",
      fadeEffect: { crossFade: true },
      speed: 2500,
      slideClass: "js-slider-item",
      slidesPerView: 1,
      autoplay: {
        delay: 10000,
      },
      preventClicks: false,
      preventClicksPropagation: false,
      on: {
        init: function () {
          //swiperAnimation.init(this).animate();
        },
        slideChange: function () {
          //swiperAnimation.init(this).animate();
        },
      },
    });
  }
}
