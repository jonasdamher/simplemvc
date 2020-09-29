"use strict";

const editor = CKEDITOR.replace("editor");

class Article extends validator {
  #title = "";
  #description = "";
  #main = "";
  #category = 0;
  #image = null;
  #tags = [];

  setData() {
    this.#title = $("#title").val().trim();
    this.#description = $("#description").val().trim();
    this.#main = editor.getData();
    this.#category = parseInt($("#idCategory").val().trim() | 0);
    this.#image = $("#mainImage")[0].files[0];

    let tags = [];
    $("#tags-list")
      .find("div.badge")
      .each(function () {
        tags.push($(this).text().trim());
      });
    this.#tags = tags;
  }

  #getData() {
    return {
      title: this.#title,
      description: this.#description,
      main: this.#main,
      category: this.#category,
      tags: this.#tags,
      image: this.#image
    };
  }

  #validateCreate() {
    if (this.empty(this.#title)) {
      this.validate.isValid = false;
      this.validate.messages.push("required title.");
    }

    if (this.empty(this.#description)) {
      this.validate.isValid = false;
      this.validate.messages.push("required description.");
    }

    if (this.empty(this.#main)) {
      this.validate.isValid = false;
      this.validate.messages.push("required main.");
    }

    if (
      this.equalLength(this.#category, 0) ||
      this.compare(this.#category, 0) ||
      !Number.isInteger(this.#category)
    ) {
      this.validate.isValid = false;
      this.validate.messages.push("required category seleted.");
    }

    if (this.maxLength(this.#tags, 10)) {
      this.validate.isValid = false;
      this.validate.messages.push("tags max 10.");
    }

    return this.validate;
  }

  create() {
    const validate = this.#validateCreate();

    if (!validate.isValid) {
      return;
    }

    this.post("articles/create", 
    this.#getData()).then((json) => {
      console.log(json);
    });
  }
}

$(function () {
  $("#btn-create-article").click(function () {
    const article = new Article();
    article.setData();
    article.create();
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
