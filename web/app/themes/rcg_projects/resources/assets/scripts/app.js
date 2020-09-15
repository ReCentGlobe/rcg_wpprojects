/**
 * External Dependencies
 */
import "jquery";
import barba from "@barba/core";
import barbaPrefetch from "@barba/prefetch";
import anime from "animejs";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import modular from "modujs";
import * as modules from "./modules";
import LocomotiveScroll from "locomotive-scroll";
//import globals from './globals';
import { html } from "./utils/env";
import "./utils/lazyload";

barba.use(barbaPrefetch);
gsap.registerPlugin(ScrollTrigger);

const loadingScreen = document.querySelector(
  ".js-loadingscreen .c-loadingscreen__layer"
);
let mainNavigation = document.querySelector(".js-header-navigation");
let languageNavigation = document.querySelector(".js-languageswitcher");
let headerLogo = document.querySelector(".js-header-logo");
const app = new modular({
  modules: modules,
});

let locoScroll;

window.onload = (event) => {
  barba.init({
    // We don't want "synced transition"
    // because both content are not visible at the same time
    // and we don't need next content is available to start the page transition
    debug: true,
    timeout: 5000, // default is 2000ms
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
      {
        name: "advanced",
        enter({ current, next }) {
          document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;

          const transitionTitle = document.querySelector(
            ".js-loadingscreen .c-loadingscreen__title"
          );
          const transitionBackground = document.querySelector(
            ".js-loadingscreen .c-loadingscreen__layer"
          );
          const mainNavigation = document.querySelector(
            ".js-header-navigation"
          );
          const languageNavigation = document.querySelector(
            ".js-languageswitcher"
          );
          const headerLogo = document.querySelector(".js-header-logo");
          const contentSection = document.querySelector(".js-main-content");

          console.log("transitionBackground", transitionBackground);

          transitionTitle.innerHTML = next.container.dataset.barbaNamespace;

          document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;

          return gsap
            .timeline({
              onComplete: () => {
                //transitionTitle.innerHTML = "";
              },
            })
            .set(transitionBackground, { clearProps: "all" })
            .set(transitionTitle, { y: 100 })
            .to(transitionBackground, {
              duration: 0.7,
              scaleY: 1,
              transformOrigin: "bottom left",
              ease: "power4",
              onComplete: () => {
                current.container.style.display = "none";
              },
            })
            .to(
              transitionTitle,
              0.5,
              {
                y: 0,
                opacity: 1,
                ease: "power4",
              },
              0.1
            )
            .from(next.container, {
              duration: 0.1,
              opacity: 0,
              ease: "power4",
            })
            .to(
              transitionBackground,
              {
                duration: 0.7,
                scaleY: 0,
                transformOrigin: "top left",
                ease: "power4.inOut",
              },
              1
            )
            .to(
              transitionTitle,
              0.7,
              {
                y: -100,
                opacity: 0,
                ease: "power4.inOut",
              },
              0.8
            )
            .then();
        },
        afterEnter(data) {
          contentAnimation(data.next.container);
        },
      },
    ],
  });
  barba.hooks.once(({ next }) => {
    // init LocomotiveScroll on page load
    smooth(next.container);
  });
  barba.hooks.before(() => {
    document.documentElement.classList.add("is-transitioning");
  });
  barba.hooks.beforeEnter(({ next }) => {
    // destroy the previous scroll
    locoScroll.destroy();
    // init LocomotiveScroll regarding the next page
    smooth(next.container);
  });
  barba.hooks.beforeLeave((data) => {
    locoScroll.destroy();
  });
  barba.hooks.after(() => {
    document.documentElement.classList.remove("is-transitioning");
    locoScroll.init();
  });

  locoScroll.init();
  init();
};

function init() {
  app.init(app);
  //globals();

  html.classList.add("is-loaded", "is-ready");
  html.classList.remove("is-loading");
}

// Function to add and remove the page transition screen
function pageTransitionIn(next) {
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
  let mainNavigation = document.querySelector(".js-header-navigation");
  let languageNavigation = document.querySelector(".js-languageswitcher");
  let headerLogo = document.querySelector(".js-header-logo");
  let contentSection = document.querySelector(".js-main-content");
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
    .from(languageNavigation, { duration: 0.2, translateY: -10, opacity: 0 })
    .from(headerLogo, { duration: 0.2, translateY: -10, opacity: 0 }, ">")
    .from(mainNavigation, { duration: 0.5, translateY: -10, opacity: 0 }, "<")
    .from(contentSection, { duration: 0.5, translateY: -10, opacity: 0 }, "<");
}

function smooth(container) {
  locoScroll = new LocomotiveScroll({
    el: container.querySelector("[data-scroll-container]"),
    smooth: true,
  });
  // each time Locomotive Scroll updates, tell ScrollTrigger to update too (sync positioning)
  locoScroll.on("scroll", ScrollTrigger.update);
}

// tell ScrollTrigger to use these proxy methods for the ".smooth-scroll" element since Locomotive Scroll is hijacking things
ScrollTrigger.scrollerProxy("[data-scroll-container]", {
  scrollTop(value) {
    return arguments.length
      ? locoScroll.scrollTo(value, 0, 0)
      : locoScroll.scroll.instance.scroll.y;
  }, // we don't have to define a scrollLeft because we're only scrolling vertically.
  getBoundingClientRect() {
    return {
      top: 0,
      left: 0,
      width: window.innerWidth,
      height: window.innerHeight,
    };
  },
  // LocomotiveScroll handles things completely differently on mobile devices - it doesn't even transform the container at all! So to get the correct behavior and avoid jitters, we should pin things with position: fixed on mobile. We sense it by checking to see if there's a transform applied to the container (the LocomotiveScroll-controlled element).
  pinType: document.querySelector(".smooth-scroll").style.transform
    ? "transform"
    : "fixed",
});
