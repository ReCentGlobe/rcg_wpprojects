import { module } from "modujs";
import LocomotiveScroll from "locomotive-scroll";
import { debugLoad, html } from "../utils/env";

export default class extends module {
  constructor(m) {
    super(m);
  }

  init() {
    this.scroll = new LocomotiveScroll({
      el: this.el,
      smooth: false,
      getDirection: true,
      getSpeed: true,
    });

    const header = document.querySelector(".js-page-head");
    let prevState = header.classList.contains("is-fixed");
    const mutationObserver = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        if (mutation.attributeName === "class") {
          const currentState = mutation.target.classList.contains("is-fixed");
          if (prevState !== currentState) {
            prevState = currentState;
            this.update();
            console.log(
              `'is-fixed' class ${currentState ? "added" : "removed"}`
            );
          }
        }
      });
    });
    mutationObserver.observe(header, {
      attributes: true,
      attributeOldValue: true,
      attributeFilter: ["class"],
    });

    this.scroll.on("call", (func, way, obj, id) => {
      // Using modularJS
      this.call(func[0], { way, obj }, func[1], func[2]);
    });

    this.scroll.on("scroll", (args) => {
      //window.app.scroll.state = args;
      if (args.scroll.y < 100) {
        //html.style.setProperty('--sig-header-height', 'var(--sig-header-large)');
        document.querySelector(".js-page-head").classList.remove("is-fixed");
      }
      if (args.scroll.y > 100) {
        //html.style.setProperty('--sig-header-height', 'var(--sig-header-small)');
        document.querySelector(".js-page-head").classList.add("is-fixed");
        document.documentElement.setAttribute("data-direction", args.direction);
      }
    });
    debugLoad("LOADED--SmoothScroll");
  }

  toggleLazy(args) {
    let src = this.getData("lazy", args.obj.el);
    if (src.length) {
      if (args.obj.el.tagName === "IMG") {
        args.obj.el.src = src;
      } else {
        args.obj.el.style.backgroundImage = `url(${src})`;
      }
      this.setData("lazy", "", args.obj.el);
    }
  }

  update() {
    this.scroll.update();
  }

  destroy() {
    this.scroll.destroy();
  }
}
