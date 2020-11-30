import "@wordpress/edit-post";
import domReady from "@wordpress/dom-ready";
import { unregisterBlockStyle, registerBlockStyle } from "@wordpress/blocks";
import { addFilter } from "@wordpress/hooks";

domReady(() => {
  unregisterBlockStyle("core/button", "outline");

  registerBlockStyle("core/button", {
    name: "outline",
    label: "Outline",
  });

  registerBlockStyle("core/table", {
    name: "rcg-people",
    label: "RCG People Table",
  });

  registerBlockStyle("core/video", {
    name: "rcg-video",
    label: "RCG Videoteaser",
  });

  registerBlockStyle("core/media-text", {
    name: "rcg-block-primary",
    label: "RCG Block Primary",
  });

  registerBlockStyle("core/media-text", {
    name: "rcg-block-secondary",
    label: "RCG Block Secondary",
  });

  const setExtraPropsToBlockType = (props, blockType, attributes) => {
    const notDefined =
      typeof props.className === "undefined" || !props.className;

    if (blockType.name === "core/video") {
      return Object.assign(props, {
        className: notDefined
          ? `js-lazyload`
          : `js-lazyload ${props.className}`,
      });
    }

    if (blockType.name === "core/list") {
      return Object.assign(props, {
        className: notDefined
          ? `post__list-${props.tagName}`
          : `post__list-${props.tagName} ${props.className}`,
        value: attributes.values.replace(
          /<li>/g,
          `<li class="post__list-item is-item-${props.tagName}">`
        ),
      });
    }

    if (blockType.name === "core/paragraph") {
      return Object.assign(props, {
        className: notDefined
          ? "post__paragraph"
          : `post__paragraph ${props.className}`,
      });
    }

    return props;
  };
  addFilter(
    "blocks.getSaveContent.extraProps",
    "rcg/block-filters",
    setExtraPropsToBlockType
  );
});
