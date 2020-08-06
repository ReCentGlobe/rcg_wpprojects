const APP_NAME = "RCG_PROJECT";

const html = document.documentElement;
const body = document.body;
const isDebug = !!html.getAttribute("data-debug");

export { APP_NAME, html, body, isDebug };
