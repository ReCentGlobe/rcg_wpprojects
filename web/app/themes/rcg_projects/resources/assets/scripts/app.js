/**
 * External Dependencies
 */
import "jquery";
import barba from "@barba/core";
import anime from "animejs";

barba.init({
  transitions: [
    {
      name: "basic",
      leave(data) {
        return anime({
          targets: data.current.container,
          opacity: [1, 0],
          easing: 'easeInOutQuad',
          duration: 2000
        });
      },
      enter(data) {
        return anime({
          targets: data.next.container,
          opacity: [0, 1],
          easing: 'easeInOutQuad',
          duration: 2000
        });
      },
    },
  ],
});

$(document).ready(() => {
  // console.log('Hello world');
});
