import { module } from "modujs";
import Datepicker from "vuejs-datepicker";
import Vue from "vue";
import { format, toDate } from "date-fns";
import { debugLoad } from "../utils/env";

export default class extends module {
  constructor(m) {
    super(m);
  }

  init() {
    //console.log(this.modules);
    //console.log(this.call("update", "", "Scroll"));
    //this.call("update", false, "Scroll", "main");
    //const args = window.app.scroll.state;
    //this.modules.Scroll.main.update();
    const scrollUpdate = () => {
      this.call("update", false, "Scroll");
    };

    new Vue({
      el: "#event-list",
      data: {
        year: "",
        search: "",
        selectedDate: "",
        disabledDates: {
          from: new Date(Date.now()),
        },
      },
      components: {
        Datepicker,
      },
      watch: {
        year: function (val) {
          this.ajaxEvent();
        },
      },
      methods: {
        getDate(date) {
          let newdate = format(toDate(date), "yyyy-MM");
          this.year = newdate;
        },
        getSearchValue() {
          var searchValue = $("#input").val(); //Get search form text input value
          return searchValue;
        },
        getSelectedEventCategories() {
          var categories = []; //Setup empty array

          $(".js-category-filter li input:checked").each(function () {
            var val = $(this).val();
            categories.push(val); //Push value onto array
          });
          return categories;
        },
        ajaxEvent(page_num) {
          $.ajax({
            type: "GET",
            url: rcgproject.ajax_url,
            data: {
              action: "get_events",
              nonce: rcgproject.ajax_nonce,
              paged: page_num,
              search: this.search,
              categories: this.getSelectedEventCategories(),
              year: this.year,
            },
            beforeSend: function () {
              console.log("loading");
              $(".js-loading").fadeIn(300);
            },
            success: function (response) {
              console.log("finished loading");
              $(".js-loading").fadeOut(300);
              $(".js-event-list__content").html(response);
              scrollUpdate();
            },
            error: function (errorThrown) {
              console.log(errorThrown);
              $(".js-loading").fadeOut(300);
              $(".js-event-list__content").html(
                "<p>There has been an error</p>"
              );
            },
          });
        },
        clearAll() {
          this.year = "";
          this.selectedDate = "";
          this.search = "";

          const categories = document.querySelectorAll(
            ".js-ajax-filter input[type='checkbox']"
          );
          for (let i = 0; i < categories.length; i++) {
            categories[i].checked = false;
          }
          this.ajaxEvent();
        },
      },
      mounted() {
        this.ajaxEvent();
        let _this = this;

        const categories = document.querySelectorAll(
          ".js-ajax-filter input[type='checkbox']"
        );
        for (let i = 0; i < categories.length; i++) {
          categories[i].addEventListener("change", function () {
            _this.ajaxEvent(); //Load Posts
          });
        }

        let input = document.querySelector(".js-ajax-filter #input");
        let timeout = null;
        input.addEventListener("keyup", function (e) {
          // Clear the timeout if it has already been set.
          // This will prevent the previous task from executing
          // if it has been less than <MILLISECONDS>
          clearTimeout(timeout);
          if (e.keyCode == 27) {
            $(this).val(""); //If 'escape' was pressed, clear value
          }
          // Make a new timeout set to go off in 1000ms (1 second)
          timeout = setTimeout(function () {
            _this.ajaxEvent(); //Load Posts
          }, 500);
        });

        $(".js-event-list__content").on("click", ".c-pagination a", function (
          e
        ) {
          e.preventDefault();
          let paged = /[\?&]paged=(\d+)/.test(this.href) && RegExp.$1;
          _this.ajaxEvent(paged);
        });
      },
    });

    const enableFilter = document.querySelector(".js-enable-filter");
    const ajaxFilter = document.querySelector(".js-ajax-filter");
    const ajaxWrapper = document.querySelector(".js-filter-wrapper");
    enableFilter.addEventListener("click", (e) => {
      e.preventDefault();
      ajaxFilter.classList.toggle("is-visible");
      ajaxWrapper.classList.toggle("is-active");
      scrollUpdate();
    });

    debugLoad("LOADED--Events");
  }
}
