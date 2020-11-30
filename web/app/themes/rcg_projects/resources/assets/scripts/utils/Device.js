import tools from "./tools";
import { html } from "./env";

class Device {
  constructor(cursor) {
    this._width = null;
    this._height = null;
    this._touch = false;
    this._small = 749;
    this._medium = 1024;
    this.isSafari = false;
    this.cursorObj = cursor;
    this.init();
  }

  init() {
    this.checkTouch();
    this.getHeightAndWidth();
    this.isSafari = this.detectSafari();

    if (this.detectEdge() || this.detectIE()) {
      //document.body.classList.add('originalcursor');
    }
  }

  getHeightAndWidth() {
    this._width = window.innerWidth;
    this._height = window.innerHeight;
  }

  checkTouch() {
    if (window.innerWidth <= this._small) {
      this._touch = true;
      html.classList.add("has-touch");
    } else {
      const self = this;
      window.addEventListener(
        "touchstart",
        function onFirstTouch() {
          html.classList.add("has-touch");
          self._touch = true;
          tools.cursor = null;
          window.removeEventListener("touchstart", onFirstTouch, {
            passive: true,
          });
        },
        { passive: true }
      );
    }
  }

  getHeight() {
    return this._height;
  }

  getWidth() {
    return this._width;
  }

  isTouch() {
    return this._touch;
  }

  isSmall() {
    return this._small >= this._width;
  }

  isMedium() {
    return !this.isSmall() && this._medium >= this._width;
  }

  isLarge() {
    return this._medium < this._width;
  }

  detectSafari() {
    return (
      navigator.userAgent.indexOf("Safari") !== -1 &&
      navigator.userAgent.indexOf("Chrome") === -1
    );
  }

  detectIE() {
    const ua = window.navigator.userAgent;

    const msie = ua.indexOf("MSIE ");
    if (msie > 0) {
      // IE 10 or older => return version number
      return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)), 10);
    }

    const trident = ua.indexOf("Trident/");
    if (trident > 0) {
      // IE 11 => return version number
      const rv = ua.indexOf("rv:");
      return parseInt(ua.substring(rv + 3, ua.indexOf(".", rv)), 10);
    }

    const edge = ua.indexOf("Edge/");
    if (edge > 0) {
      // Edge (IE 12+) => return version number
      return parseInt(ua.substring(edge + 5, ua.indexOf(".", edge)), 10);
    }

    // other browser
    return false;
  }

  detectEdge() {
    const ua = window.navigator.userAgent;

    const edge = ua.indexOf("Edge/");
    if (edge > 0) {
      return parseInt(ua.substring(edge + 5, ua.indexOf(".", edge)), 10);
    }

    // other browser
    return false;
  }
}

export default Device;
