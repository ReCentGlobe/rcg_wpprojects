import { gsap } from "gsap";
/**
 * Home
 */
export default () => {
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
    .from(contentSection, { duration: 0.5, translateY: -10, opacity: 0 }, "<");

  console.log("common");
};
