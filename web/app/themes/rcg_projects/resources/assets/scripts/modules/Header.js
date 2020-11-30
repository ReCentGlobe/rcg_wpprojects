import { module } from "modujs";
import { gsap } from "gsap";

export default class extends module {
  constructor(m) {
    super(m);

    this.events = {
      click: {
        mute: "toggleSound",
        fullscreen: "toggleFullscreen",
      },
    };
  }

  init() {
    let mainNavigation = document.querySelector(".js-header-navigation");
    let languageNavigation = document.querySelector(".js-languageswitcher");
    let headerLogo = document.querySelector(".js-header-logo");
    let contentSection = document.querySelector(".js-main-content");
    // Query from container
    $(document.querySelector(".js-slider__title")).addClass("is-animating");
    // GSAP methods can be chained and return directly a promise
    gsap
      .timeline()
      .from(document.querySelector(".is-animated"), {
        duration: 0.5,
        translateY: 10,
        opacity: 0,
        stagger: 0.4,
      })
      .from(languageNavigation, { duration: 0.2, translateY: -10, opacity: 0 })
      .from(headerLogo, { duration: 0.2, translateY: -10, opacity: 0 }, ">")
      .from(mainNavigation, { duration: 0.5, translateY: -10, opacity: 0 }, "<")
      .from(
        contentSection,
        { duration: 0.5, translateY: -10, opacity: 0 },
        "<"
      );

    console.log("LOADED--HeaderAnimation");
  }

  toggleSound(e) {
    const video = this.el.querySelector("video");
    video.muted = !video.muted;
    e.currentTarget.classList.toggle("is-active");
  }

  toggleFullscreen(e) {
    const video = this.el.querySelector("video");
    if (video.requestFullscreen) {
      video.requestFullscreen();
    } else if (video.webkitRequestFullscreen) {
      /* Safari */
      video.webkitRequestFullscreen();
    } else if (video.msRequestFullscreen) {
      /* IE11 */
      video.msRequestFullscreen();
    }
  }
}
