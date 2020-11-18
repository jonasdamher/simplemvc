"use strict";

// import CKEDITOR from '../ckeditor/ckeditor.js';

import Validator from './Validator.js';
// const editor = CKEDITOR.replace("editor");

export default class Articles extends Validator {

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
    this.#image = document.querySelector('#mainImage').files[0]

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
