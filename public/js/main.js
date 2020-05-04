$(function () {
  $(".btn-dropdown").on("click", function () {
    $(this).siblings(".dropdown").toggle();
    $(this).toggleClass('active');
  });
});
