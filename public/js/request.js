"use strict";

class request {
  post(route, formData) {
    const form = JSON.stringify(formData);
    console.log(form);
    return $.post("/api/" + route, { form: form }, json => {
      return json;
    });
  }

  get(route) {
    return $.get("/api/" + route, json => {
      return json;
    });
  }
}
