/**
 * Utilities
 */

const disableScrollEvent = () => window.scrollTo(0, 0);
const disableScroll = () => window.addEventListener(`scroll`, disableScrollEvent);
const enableScroll = () => window.removeEventListener(`scroll`, disableScrollEvent);
const set100vhVar = () => {
  // This fixes the 100vh iOS bug/feature.
  // If less than most tablets, set var to window height.
  let value = '';
  if (window.screen.width <= 1024) {
    value = `${window.innerHeight}px`;
  }
  document.documentElement.style.setProperty('--real-100vh', value);
};

export { disableScroll, enableScroll, set100vhVar };
