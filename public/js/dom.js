function modalRemoveShowData(data, modal) {
  if (!data.success) {
    $("#error-request-remove").show();
    $("#error-request-remove").text(data.message);
    return;
  }

  $("#text-category-remove").text(data.result.name);
  $("#btn-remove-category").val(data.result.id);
  $(modal).show();
}
function modalRemove(data, id) {
  if (!data.success) {
    $("#error-request-remove").show();
    $("#error-request-remove").text(data.message);
    return;
  }

  $("#request-success-remove").show();
  $("#request-success-remove").text("Success, Remove category !");
  $("#table-categories").child("tbody").child(`tr[data-id=${id}]`).remove();
}

$(function () {
  $(".btn-dropdown").on("click", function () {
    $(this).siblings(".dropdown").toggle();
    $(this).toggleClass("active");
  });

  $(".btn-snackbar-close").click(function () {
    $(this).parents(".snackbar").fadeOut(200);
  });
});
