import { module as modularJS } from "modujs";
import * as am4core from "@amcharts/amcharts4/core";
import * as am4maps from "@amcharts/amcharts4/maps";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";
import am4geodata_worldLow from "@amcharts/amcharts4-geodata/worldLow";
import * as markerimage_disabled from "../../svg/projektpunkt_inaktiv.svg";
import tippy from "tippy.js";
import { hideAll } from "tippy.js";
import axios from "redaxios";
import { debugLoad, html } from "../utils/env";
import Swiper from "swiper";

export default class extends modularJS {
  constructor(m) {
    super(m);
  }

  init() {
    debugLoad("LOADED--AMCharts");
    /**
     * Initialize Maps
     */
    am4core.useTheme(am4themes_animated);
    am4core.options.autoSetClassName = true;
    am4core.options.classNamePrefix = "RCG";
    let container = am4core.create("projectmap", am4core.Container);
    container.width = am4core.percent(100);
    container.height = am4core.percent(100);
    container.wheelable = false;

    /**
     * Create a chart instance
     * @type {am4maps.MapChart}
     */
    let chart = new am4maps.MapChart();
    chart.parent = container;
    chart.responsive.enabled = true;
    chart.geodata = am4geodata_worldLow;
    chart.projection = new am4maps.projections.Eckert6();
    chart.homeZoomLevel = 1;
    chart.maxZoomLevel = 1;
    chart.homeGeoPoint = {
      latitude: 22,
      longitude: 11,
    };

    /**
     * Create map polygon series
     * @type {MapPolygonSeries}
     */
    const polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
    polygonSeries.name = "worldSeries";
    polygonSeries.useGeodata = true;
    polygonSeries.calculateVisualCenter = true;
    polygonSeries.legendSettings.visible = true;
    polygonSeries.exclude = ["AQ"];
    polygonSeries.hiddenInLegend = true;

    // Configure series
    let polygonTemplate = polygonSeries.mapPolygons.template;
    let primaryColor = getComputedStyle(html).getPropertyValue(
      "--primary-color"
    );
    let secondaryColor = getComputedStyle(html).getPropertyValue(
      "--secondary-color"
    );
    //polygonTemplate.tooltipText = '{name}';
    polygonTemplate.fill = am4core.color(primaryColor.trim());
    polygonTemplate.stroke = am4core.color(primaryColor.trim());
    polygonTemplate.propertyFields.id = "id";

    // Create hover state and set alternative fill color
    let hover = polygonTemplate.states.create("hover");
    hover.properties.fill = am4core.color(secondaryColor.trim());

    polygonTemplate.events.on("over", function (ev) {
      // get object info
      $(".js-countrytitle").text(ev.target.dataItem.dataContext.name);
    });
    polygonTemplate.events.on("out", function (ev) {
      // get object info
      $(".js-countrytitle").text("");
    });

    /**
     * Load Data from API
     * @type {DataSource}
     */
    // Load data when map polygons are ready
    chart.events.on("ready", loadStores);

    // Loads store data
    function loadStores() {
      let groupData = new am4core.DataSource();
      groupData.url = "/100worldhistories/wp-json/rcg/videos";
      groupData.events.on("parseended", function (ev) {
        setupStores(ev.target.data);
      });
      groupData.load();
    }

    /**
     * create IDs
     * @type {number}
     */
    var markerID = 0;
    function getNextMarkerID() {
      return "ID" + markerID++;
    }

    /**
     * Create a series
     */
    // Creates a series
    function createSeries(projectItem, catID, catName) {
      let series = chart.series.push(new am4maps.MapImageSeries());
      series.data = projectItem;
      series.dataFields.count = "count";
      series.id = catID;
      series.name = catName;
      series.hidden = true;
      series.adapter.add("hidden", function (hidden, target) {
        if (target && target.id == "All") {
          return false;
        } else {
          return hidden;
        }
      });

      let template = series.mapImages.template;
      template.verticalCenter = "middle";
      template.horizontalCenter = "middle";
      template.propertyFields.latitude = "lat";
      template.propertyFields.longitude = "long";
      template.tooltipText = "{country}";
      template.nonScaling = true;

      template.setStateOnChildren = true;
      template.states.create("hover");

      let circle = template.createChild(am4core.Image);
      circle.id = getNextMarkerID();
      circle.setClassName();
      circle.href =
        "/100worldhistories/app/themes/rcg_projects/dist" +
        markerimage_disabled;
      //circle.path = 'M0,10a10,10 0 1,0 20,0a10,10 0 1,0 -20,0';
      circle.fill = am4core.color("rgba(255, 255, 255, 0.35)");
      circle.cursorOverStyle = am4core.MouseCursorStyle.pointer;
      circle.verticalCenter = "middle";
      circle.horizontalCenter = "middle";
      circle.height = 20;
      circle.width = 20;
      circle.clickable = true;

      let circleHover = circle.states.create("hover");
      circleHover.properties.scale = 1.4;
      circleHover.properties.fill = am4core.color("rgba(255, 255, 255, 0.6)");

      let label = template.createChild(am4core.Label);
      label.text = "{count}";
      label.fill = am4core.color("#000");
      label.verticalCenter = "none";
      label.horizontalCenter = "middle";
      label.fontFamily = "Shape";
      label.fontSize = "26px";
      label.fontWeight = "bold";
      label.dy = -35;
      label.dx = 20;
      label.fillOpacity = 0;
      label.adapter.add("text", function (text, target) {
        if (target.dataItem && target.dataItem.count <= 1) {
          return "";
        } else {
          return text;
        }
      });

      let labelHover = label.states.create("hover");
      labelHover.properties.fillOpacity = 1;

      series.mapImages.template.events.on("over", function (ev) {
        // get object info
        $(".js-countrytitle").text(ev.target.dataItem.dataContext.name);
      });
      series.mapImages.template.events.on("out", function (ev) {
        // get object info
        $(".js-countrytitle").text("");
      });

      series.mapImages.template.events.on("ready", function (ev) {
        let popupTarget = "#" + ev.target.dom.id;
        //console.log(ev.target.dom.id);
      });

      // Set up popup
      series.mapImages.template.events.on("hit", function (ev) {
        // Determine what we've clicked on
        let data = ev.target.dataItem.dataContext;
        let restData = {};
        hideAll();
        chart.closeAllPopups();

        // No id? Individual store - nothing to drill down to further
        if (!data.target) {
          return;
        }
        if (data.category == "All") {
          data.category = "";
        }
        //console.log(data);

        let popupTarget = document.querySelector("#" + ev.target.dom.id);
        tippy(popupTarget, {
          hideOnClick: false,
          arrow: false,
          interactive: true,
          theme: "light",
          trigger: "manual",
          placement: "bottom-start",
          offset: [30, 10],
          moveTransition: "transform 0.2s ease-out",
          appendTo: () => document.body,
          allowHTML: true,
          maxWidth: 250,
          onShow(instance) {
            axios
              .get("/100worldhistories/wp-json/rcg/country/" + data.countryCode)
              .then(function (response) {
                // handle success
                function createSlider(sliderData) {
                  let slide = "";
                  for (let i = 0; i < sliderData.length; i++) {
                    slide += `<div class="o-popup__slide swiper-slide">
                            <div class="o-popup__media">
                              <img src="https://i.ytimg.com/vi/${sliderData[i].ytid}/maxresdefault.jpg" class="">
                            </div>
                            <div class="o-popup__content">
                              <a href="${sliderData[i].ytsrc}" target="_blank">
                                 <h4 class="o-popup__title">${sliderData[i].title}</h4>
                                <h6 class="o-popup__category">${sliderData[i].affiliation}</h6>
                              </a>
                            </div>
                            </div>`;
                  }

                  return slide;
                }

                instance.setContent(`<div class="swiper-container"><div class="swiper-wrapper">${createSlider(
                  response.data
                )}</div><div class="o-popup__footer"> <div class="o-popup__prev swiper-button-prev"></div>
                <div class="o-popup__pagination"></div>
                <div class="o-popup__next swiper-button-next"></div></div></div>`);

                const mySwiper = new Swiper(".swiper-container", {
                  // Optional parameters
                  direction: "horizontal",
                  loop: false,
                  slidesPerView: 1,
                  autoHeight: false,
                  watchOverflow: true,
                  pagination: {
                    el: ".o-popup__pagination",
                    type: "fraction",
                  },
                  // Navigation arrows
                  navigation: {
                    nextEl: ".o-popup__next",
                    prevEl: ".o-popup__prev",
                  },
                });
                if (mySwiper.slides < 2) {
                  $("o-popup__pagination").addClass("hidden");
                }
                //console.log(response.data);
              })
              .catch(function (error) {
                // Fallback if the network request failed
                instance.setContent(`Request failed. ${error}`);
                //console.log(error);
              });
          },
          content: "<strong></strong>",
        });
        popupTarget._tippy.show();
      });

      return series;
    }

    /**
     * Setup Data
     */
    let categorySeries = {};
    function setupStores(data) {
      // Init country series
      categorySeries = {
        markerData: [],
      };
      //console.log(data);
      // Process data
      am4core.array.each(data, function (cat) {
        // Get Category data
        let projectCategory = {
          name: cat.name,
          id: cat.id,
          countries: cat.countries,
          counts: cat.counts,
          series: [],
        };
        for (var countryInner in projectCategory.counts) {
          let countryPolygon = polygonSeries.getPolygonById(countryInner);
          if (countryPolygon) {
            // Add state data
            let element = {
              target: countryInner,
              name: countryPolygon.dataItem.dataContext.name,
              count: projectCategory.counts[countryInner],
              lat: countryPolygon.visualLatitude,
              long: countryPolygon.visualLongitude,
              countryCode: countryInner,
              category: cat.id,
              markerData: [],
            };
            projectCategory.series.push(element);
          } else {
            // State not found
            return;
          }
        }

        //console.log(projectCategory);
        categorySeries.markerData.push(projectCategory);
      });
      //console.log(categorySeries);

      am4core.array.each(categorySeries.markerData, function (seriesItem) {
        createSeries(seriesItem.series, seriesItem.id, seriesItem.name);
        //console.log(chart.series);
      });
    }

    chart.events.on("mappositionchanged", function (ev) {
      hideAll();
    });
    chart.events.on("hit", function (ev) {
      hideAll();
    });
  }
}
