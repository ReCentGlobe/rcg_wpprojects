import { module } from "modujs";

export default class extends module {
  constructor(m) {
    super(m);
    this.events = {
      click: {
        menu: "toggleMenu",
      },
    };
  }

  init() {}

  toggleMenu(e) {
    console.log("yeah");
    e.currentTarget.classList.toggle("is-active");
    this.el
      .querySelector(".js-header-navigation")
      .classList.toggle("is-active");
  }
}
