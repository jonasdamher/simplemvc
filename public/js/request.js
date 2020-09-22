"use strict";

class request {
  post(route,  formData ) {
    formData._token='';
    const form = JSON.stringify(formData);
    console.log(form);
    return $.post("/api/" + route, { form: form }, json => {
      return json;
    });
  }

  get(route) {
    const form = JSON.stringify({ _token: "" });
    return $.post("/api/" + route, { form: form }, json => {
      return json;
    });
  }
}
