/**
 * External Dependencies
 */
import "jquery";
import anime from "animejs";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { router } from "js-dom-router";
import LocomotiveScroll from "locomotive-scroll";
import { html } from "./utils/env";
import "./utils/lazyload";

gsap.registerPlugin(ScrollTrigger);

let mainNavigation = document.querySelector(".js-header-navigation");
let languageNavigation = document.querySelector(".js-languageswitcher");
let headerLogo = document.querySelector(".js-header-logo");

/**
 * DOM-based routing
 */
import home from "./routes/home";
import common from "./routes/common";
import archiveEvent from "./routes/archive-event";
/**
 * Set up DOM router
 *
 * .on(<name of body class>, callback)
 *
 * See: {@link http://goo.gl/EUTi53 | Markup-based Unobtrusive Comprehensive DOM-ready Execution} by Paul Irish
 */
router.on("home", home).on("post-type-archive-event", archiveEvent).ready();

/**
 * Locomotive Scroll
 * @type {_default}
 */
let locoScroll = new LocomotiveScroll({
  el: document.querySelector("[data-scroll-container]"),
  smooth: true,
});
locoScroll.on("scroll", ScrollTrigger.update);
locoScroll.on("call", (func) => {
  // Using jQuery events
  $(document).trigger(func);
  console.log(func);
  // Or do it your own way 😎
});

window.onload = (event) => {
  locoScroll.init();
  init();
  common();
};

function init() {
  html.classList.add("is-ready");
  html.classList.remove("is-loading");
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
  pinType: document.querySelector(".has-scroll-smooth").style.transform
    ? "transform"
    : "fixed",
});
// each time the window updates, we should refresh ScrollTrigger and then update LocomotiveScroll.
ScrollTrigger.addEventListener("refresh", () => locoScroll.update());
