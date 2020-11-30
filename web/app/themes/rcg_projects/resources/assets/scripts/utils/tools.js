const tools = {
  device: null,
  doOnWindowResizeList: [],
  windowResizeListenerInit: false,

  isMobile() {
    return window.innerWidth <= 749;
  },

  each(list, fn) {
    if (list && fn) {
      for (let i = 0; i < list.length; i++) {
        fn(list[i], i);
      }
    }
  },

  doOnWindowResize(action) {
    if (action && action.fn) {
      this.doOnWindowResizeList.push(action);
      if (!this.windowResizeListenerInitialised) {
        tools.windowResizeListener();
      }
    }
  },

  onWindowResizeActions() {
    tools.each(this.doOnWindowResizeList, (action) => {
      action.fn(action.arg);
    });
  },

  windowResizeListener() {
    let timeoutFn = null;
    window.onresize = (e) => {
      if (timeoutFn != null) {
        window.clearTimeout(timeoutFn);
      }
      timeoutFn = setTimeout(() => {
        tools.onWindowResizeActions();
      }, 100);
    };
    tools.windowResizeListenerInitialised = true;
  },
};

export default tools;
