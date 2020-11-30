/**
 * External Dependencies
 */
import "jquery";
import modular from "modujs";
import * as modules from "./modules";
import { html } from "./utils/env";
import globals from "./globals";
import { set100vhVar } from "./utils/index";
import tools from "./utils/tools";
import Device from "./utils/Device";
//import "./utils/lazyload";

require("Modernizr");

const app = new modular({
  modules: modules,
});

document.addEventListener("DOMContentLoaded", () => {
  console.log("LOADED--DOM Content");
});
window.onload = (event) => {
  /*  const $style = document.getElementById('stylesheet');

  if ($style.isLoaded) {
    init();
  } else {
    $style.addEventListener('load', (event) => {
      init();
    });
  }*/
  init();
  //common();
};

function init() {
  app.init(app);
  set100vhVar();
  globals();

  tools.device = new Device();
  tools.doOnWindowResize({ fn: () => (tools.device = new Device()) });

  html.classList.add("is-loaded", "is-ready");
  html.classList.remove("is-loading");
}
