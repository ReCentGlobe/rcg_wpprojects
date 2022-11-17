import { module as modularJS } from "modujs";
import { debugLoad } from "../utils/env";

export default class extends modularJS {
  constructor(m) {
    super(m);
    this.events = {
      click: {
        menu: "toggleMenu",
      },
      mouseover: {
        openChild: "openChildMenu"
      },
      mouseleave: {
        closeChild: "closeChildMenu"
      }
    };
  }

  init() {
    debugLoad("LOADED--Nav");
  }

  toggleMenu(e) {
    e.currentTarget.classList.toggle("is-active");
    this.el
      .querySelector(".js-header-navigation")
      .classList.toggle("is-active");
  }

  openChildMenu(e) {
    //console.log(e);
    e.target.nextElementSibling.classList.add("is-active");

  }
  closeChildMenu(e) {
    e.currentTarget.classList.remove("is-active");
  }
}
