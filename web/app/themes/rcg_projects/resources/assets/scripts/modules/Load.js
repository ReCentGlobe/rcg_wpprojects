import { module } from "modujs";
import modularLoad from "modularload";
import { debugLoad } from "../utils/env";

export default class extends module {
  constructor(m) {
    super(m);
  }

  init() {
    const load = new modularLoad({
      enterDelay: 300,
      transitions: {
        customTransition: {},
        portfolio: {
          enterDelay: 450,
        },
        transitionTwoName: {
          enterDelay: 600,
        },
      },
    });

    const allVideo = document.querySelectorAll("video");
    allVideo.forEach((video) => {
      video.addEventListener("click touchstart", (e) => {
        const videoWrapper = e.currentTarget.parentNode;
        if (videoWrapper.classList.contains("is-playing")) {
          e.currentTarget.pause();
          videoWrapper.classList.remove("is-playing");
        } else {
          e.currentTarget.play();
          videoWrapper.classList.add("is-playing");
        }
      });
      video.addEventListener("mouseover", (e) => {
        const videoWrapper = e.currentTarget.parentNode;
        e.currentTarget.play();
        videoWrapper.classList.add("is-playing");
      });
      video.addEventListener("mouseout", (e) => {
        const videoWrapper = e.currentTarget.parentNode;
        e.currentTarget.pause();
        videoWrapper.classList.remove("is-playing");
      });
    });

    load.on("loaded", (transition, oldContainer, newContainer) => {
      console.log("👌");
      this.call("destroy", oldContainer, "app");
      this.call("update", newContainer, "app");

      const allVideo = document.querySelectorAll("video");
      allVideo.forEach((video) => {
        video.addEventListener("click touchstart", (e) => {
          const videoWrapper = e.currentTarget.parentNode;
          if (videoWrapper.classList.contains("is-playing")) {
            e.currentTarget.pause();
            videoWrapper.classList.remove("is-playing");
          } else {
            e.currentTarget.play();
            videoWrapper.classList.add("is-playing");
          }
        });
        video.addEventListener("mouseover", (e) => {
          const videoWrapper = e.currentTarget.parentNode;
          e.currentTarget.play();
          videoWrapper.classList.add("is-playing");
        });
        video.addEventListener("mouseout", (e) => {
          const videoWrapper = e.currentTarget.parentNode;
          e.currentTarget.pause();
          videoWrapper.classList.remove("is-playing");
        });
      });
    });

    debugLoad("LOADED--ModularLoad");
  }
}
