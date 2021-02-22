const APP_NAME = "RCG_PROJECT";

const html = document.documentElement;
const body = document.body;
const isDebug = !!html.getAttribute("data-debug");
const debugLoad = (msg, callback) => {
  //if app not in debug mode, exit immediately
  if (!isDebug || !console) {
    return;
  }

  //console.log the message
  if (msg && typeof msg === "string") {
    console.log(
      `%c⌛ ${msg}`,
      "font-size:10px;font-weight: bold;color:#000; background-color:#bdd684; padding:5px;border-radius:4px;"
    );
  }

  //execute the callback if one was passed-in
  if (callback && callback instanceof Function) {
    callback();
  }
};

export { html, body, isDebug, debugLoad };
