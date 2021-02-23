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
      smooth: true,
      getDirection: true,
    });

    this.scroll.on("call", (func, way, obj, id) => {
      // Using modularJS
      this.call(func[0], { way, obj }, func[1], func[2]);
    });

    this.scroll.on("scroll", (args) => {
      window.app.scroll.state = args;
      console.log(args.direction);
      if (args.scroll.y <= 60) {
        html.classList.remove("is-not-top");
        html.classList.add("is-top");
      }
      if (args.scroll.y > 60 && args.direction === "down") {
        html.classList.remove("is-top");
        html.classList.add("is-not-top");
        html.classList.remove("is-scroll-up");
      } else if (args.scroll.y > 60 && args.direction === "up") {
        html.classList.remove("is-top");
        html.classList.add("is-not-top");
        html.classList.add("is-scroll-up");
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
