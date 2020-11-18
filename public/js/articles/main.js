"use strict";

import * as dom from '../modules/Dom.js';
import Articles from '../modules/Articles.js';

$(function () {
  $("#btn-create-article").click(function () {
    const articles = new Articles();
    articles.setData();
    articles.create();
  });

  function addTag(tagName) {
    let badge = `<div class="badge badge-secondary"><span>${tagName.trim()}</span><button type="button" class="btn" title="Remove tag"><i class="fa fa-times fa-sm"></i></button></div>`;
    $("#tags-list").append(badge);
  }

  $("#tags").keypress(function (e) {
    if (e.keyCode != 13) {
      return;
    }

    let valueField = $(this).val().trim();

    if (valueField == "") {
      return;
    }

    if (valueField.search(",") != -1) {
      let multipleTag = valueField.split(",");

      multipleTag.forEach(tagName => {
        if (tagName != "") {
          addTag(tagName);
        }
      });
    } else {
      addTag(valueField);
    }

    $(this).val("");
  });

  $("#tags-list").on("click", "button.btn", function () {
    let tag = $(this);

    tag.parent().fadeOut(200, function () {
      tag.parent().remove();
    });
  });

  $("#description").on("keypress", function () {
    let input = $(this);

    let count = input.siblings(".count-input-text").children("span.count");

    count.text(input.val().length);

    if (input.val().length > input.attr("maxlength")) {
      if (count.hasClass("text-danger")) {
        count.addClass("text-danger");
      } else {
        count.removeClass("text-danger");
      }
    }
  });

  $("#mainImage").change(function () {
    let image = $("#mainImage")[0].files[0];

    console.log(image);
  });
});
