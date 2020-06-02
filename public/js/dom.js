$(function () {
  $(".btn-dropdown").on("click", function () {
    $(this).siblings(".dropdown").toggle();
    $(this).toggleClass("active");
  });

  $(".btn-snackbar-close").click(function () {
    $(this).parents(".snackbar").fadeOut(200);
  });
});
