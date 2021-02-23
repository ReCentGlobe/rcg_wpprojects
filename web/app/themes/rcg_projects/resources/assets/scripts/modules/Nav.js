import { module } from "modujs";
import { debugLoad } from "../utils/env";

export default class extends module {
  constructor(m) {
    super(m);
    this.events = {
      click: {
        menu: "toggleMenu",
      },
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
}
