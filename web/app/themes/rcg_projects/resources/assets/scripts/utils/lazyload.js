//import "picturefill";
import lazySizes from "lazysizes";
import "lazysizes/plugins/aspectratio/ls.aspectratio.js";
import "lazysizes/plugins/parent-fit/ls.parent-fit";
import "lazysizes/plugins/respimg/ls.respimg";

lazySizes.cfg.lazyClass = "js-lazyload";
lazySizes.cfg.preloadClass = "js-lazypreload";
lazySizes.cfg.loadingClass = "is-loading";
lazySizes.cfg.loadedClass = "is-loaded";
lazySizes.cfg.autoArtDirect = true;
