import svg4everybody from "svg4everybody";
import lazySizes from "lazysizes";
import "lazysizes/plugins/parent-fit/ls.parent-fit";
import "lazysizes/plugins/blur-up/ls.blur-up";
import { debugLoad } from "./utils/env";

/**
 * LazySizes
 */
lazySizes.cfg.lazyClass = "js-lazyload";
lazySizes.cfg.preloadClass = "js-lazypreload";
lazySizes.cfg.loadingClass = "is-loading";
lazySizes.cfg.loadedClass = "has-image-loaded";
lazySizes.cfg.autoArtDirect = true;

export default function () {
  /**
   * SVG4Everybody
   */
  svg4everybody();
  debugLoad("LOADED--SVG4Everybody");

  /**
   * WebfontLoader
   */
  /*  WebFont.load({
    custom: {
      families: ['My Font'],
    },
  });
  console.log('LOADED--WebfontLoader');*/

  /**
   * LazySizes
   */
  debugLoad("LOADED--LazySizes");
}
