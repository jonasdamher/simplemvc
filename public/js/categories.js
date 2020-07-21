$(function () {
  // OPEN MODAL - NEW
  $(".btn-modal-new").on("click", function () {
    $("#modal-new").show();
  });

  // OPEN MODAL - REMOVE
  $(".btn-modal-remove").on("click", function () {
    const id = $(this).parent().parent().data("id");

    get("getCategory/" + id).done(function (json) {
      modalRemoveShowData(JSON.parse(json), "#modal-remove");
    });
  });
  // REMOVE CATEGORY
  $("#btn-remove-category").click(function () {
    const id = $(this).val();

    get("deleteCategory/" + id).done(function (json) {
      var data = JSON.parse(json);
      modalRemove(data, id);
    });
  });
});
