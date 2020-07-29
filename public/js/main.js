function post(route, formData) {
  const form = JSON.stringify({ form: formData });

  return $.post("/simplymvcphp/api/" + route, form, json => {
    return json;
  });
}

function get(route) {
  return $.get("/simplymvcphp/api/" + route, json => {
    return json;
  });
}
