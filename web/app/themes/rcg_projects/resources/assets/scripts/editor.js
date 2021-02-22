import "@wordpress/edit-post";
import domReady from "@wordpress/dom-ready";
import {
  unregisterBlockStyle,
  registerBlockStyle,
  registerBlockVariation,
} from "@wordpress/blocks";
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

  /*  registerBlockStyle("core/columns", {
    name: "rcg-columns-secondary",
    label: "RCG Columns Secondary",
  });*/

  registerBlockVariation("core/columns", [
    {
      name: "rcg-block-secondary",
      title: "RCG Video Columns Secondary",
      attributes: {
        className: "rcg-columns-secondary",
      },
      icon: "portfolio",
      scope: ["inserter"],
      innerBlocks: [
        [
          "core/column",
          {},
          [
            [
              "core/group",
              {},
              [
                ["core/heading", { level: 5, placeholder: "Title" }],
                ["core/heading", { level: 6, placeholder: "Subtitle" }],
                ["core/paragraph", { placeholder: "CV" }],
              ],
            ],
          ],
        ],
        ["core/column", {}, [["core-embed/youtube"]]],
      ],
    },
    {
      name: "rcg-block-primary",
      title: "RCG Video Columns Primary",
      attributes: {
        className: "rcg-columns-primary",
      },
      icon: "portfolio",
      scope: ["inserter"],
      innerBlocks: [
        [
          "core/column",
          {},
          [
            [
              "core/group",
              {},
              [
                ["core/heading", { level: 5, placeholder: "Title" }],
                ["core/heading", { level: 6, placeholder: "Subtitle" }],
                ["core/paragraph", { placeholder: "CV" }],
              ],
            ],
          ],
        ],
        ["core/column", {}, [["core-embed/youtube"]]],
      ],
    },
    {
      name: "rcg-block-outline",
      title: "RCG Video Columns Outline",
      attributes: {
        className: "rcg-columns-outline",
      },
      icon: "portfolio",
      scope: ["inserter"],
      innerBlocks: [
        [
          "core/column",
          {},
          [
            [
              "core/group",
              {},
              [
                ["core/heading", { level: 5, placeholder: "Title" }],
                ["core/heading", { level: 6, placeholder: "Subtitle" }],
                ["core/paragraph", { placeholder: "CV" }],
              ],
            ],
          ],
        ],
        ["core/column", {}, [["core-embed/youtube"]]],
      ],
    },
  ]);

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
