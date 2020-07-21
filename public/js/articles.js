$(function () {
  $("#btn-create-article").on("click", function () {
    $;
    post("articles/create").done(function (json) {
      const data = JSON.parse(json);
      console.log(data);
    });
  });
});
