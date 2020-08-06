/**
 * External Dependencies
 */
import "jquery";
import barba from "@barba/core";
import barbaPrefetch from "@barba/prefetch";
import anime from "animejs";
import gsap from "gsap";
import modular from "modujs";
import * as modules from "./modules";
//import globals from './globals';
import { html } from "./utils/env";

barba.use(barbaPrefetch);

const loadingScreen = document.querySelector(".c-loadingscreen__layer");
const mainNavigation = document.querySelector(".c-header-navigation");
const app = new modular({
  modules: modules,
});

window.onload = (event) => {
  barba.init({
    // We don't want "synced transition"
    // because both content are not visible at the same time
    // and we don't need next content is available to start the page transition
    sync: false,
    debug: true,
    transitions: [
      {
        name: "basic",
        leave(data) {
          pageTransitionIn();
          // Loading screen is hiding everything, time to remove old content!
          data.current.container.remove();
        },
        enter(data) {
          pageTransitionOut(data.next.container);
        },
        once(data) {
          contentAnimation(data.next.container);
        },
      },
    ],
  });
  init();
};

function init() {
  app.init(app);
  //globals();

  html.classList.add("is-loaded", "is-ready");
  html.classList.remove("is-loading");
}

// Function to add and remove the page transition screen
function pageTransitionIn() {
  // GSAP methods can be chained and return directly a promise
  // but here, a simple tween is enough
  return (
    gsap
      // .timeline()
      // .set(loadingScreen, { transformOrigin: 'bottom left'})
      // .to(loadingScreen, { duration: .5, scaleY: 1 })
      .to(loadingScreen, {
        duration: 0.5,
        scaleY: 1,
        transformOrigin: "bottom left",
      })
  );
}

// Function to add and remove the page transition screen
function pageTransitionOut(container) {
  // GSAP methods can be chained and return directly a promise
  return gsap
    .timeline({ delay: 1 }) // More readable to put it here
    .add("start") // Use a label to sync screen and content animation
    .to(
      loadingScreen,
      {
        duration: 0.5,
        scaleY: 0,
        skewX: 0,
        transformOrigin: "top left",
        ease: "power1.out",
      },
      "start"
    )
    .call(contentAnimation, [container], "start");
}

// Function to animate the content of each page
function contentAnimation(container) {
  // Query from container
  $(container.querySelector(".js-slider__title")).addClass("is-animating");
  // GSAP methods can be chained and return directly a promise
  return gsap
    .timeline()
    .from(container.querySelector(".is-animated"), {
      duration: 0.5,
      translateY: 10,
      opacity: 0,
      stagger: 0.4,
    })
    .from(mainNavigation, { duration: 0.5, translateY: -10, opacity: 0 });
}
