"use strict";

const editor = CKEDITOR.replace("editor");

class Article {
  #title = "";
  #description = "";
  #main = "";
  #category = 0;
  #tags = [];

  setData() {
    this.#title = $("#title").val().trim();
    this.#description = $("#description").val().trim();
    this.#main = editor.getData();
    this.#category = parseInt($("#idCategory").val().trim() | 0);

    let tags = [];
    $("#tags-list")
      .find("span")
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
      tags: this.#tags
    };
  }

  #validate() {
    let validate = {
      isValid: true,
      messages: []
    };

    if (this.#title.length == 0) {
      validate.isValid = false;
      validate.messages.push("required title");
    }

    if (this.#description.length == 0) {
      validate.isValid = false;
      validate.messages.push("required description");
    }

    if (this.#main.length == 0) {
      validate.isValid = false;
      validate.messages.push("required main");
    }

    if (
      this.#category.length == 0 ||
      this.#category == 0 ||
      !Number.isInteger(this.#category)
    ) {
      validate.isValid = false;
      validate.messages.push("required category seleted");
    }

    if (this.#tags.length >= 10) {
      validate.isValid = false;
      validate.messages.push("tags max 10");
    }

    return validate;
  }

  request() {
    const validate = this.#validate();
    console.log(validate);
    if (!validate.isValid) {
      return;
    }

    // post("articles/create", this.#getData()).done(function (json) {
    //   const data = JSON.parse(json);
    //   console.log(data);
    // });
  }
}

$(function () {
  $("#btn-create-article").click(function () {
    const article = new Article();
    article.setData();
    article.request();
  });

  $("#tags").keypress(function (e) {
    if (e.keyCode != 13) {
      return;
    }
    let valueField = $(this).val().trim();

    let badge = `<div class="badge badge-secondary"><span>${valueField}</span><button type="button" class="btn" title="Remove tag"><i class="fa fa-times fa-sm"></i></button></div>`;
    $("#tags-list").append(badge);
    $(this).val("");
  });

  $("#tags-list").on("click", "button.btn", function () {
    $(this).parent().remove();
  });
});
