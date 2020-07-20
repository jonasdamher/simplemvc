$(function () {
  function post(method, formData) {
    let form = JSON.stringify({ form: formData });
    $.post("//localhost/simplymvcphp/Ajax/" + method, form, json => {
      const data = JSON.parse(json);
      console.log(data);
    });
  }

  function get(method) {
    return $.get("//localhost/simplymvcphp/Ajax/" + method, json => {
      return json;
    });
  }

  // REMOVE CATEGORY
  $("#btn-remove-category").click(function () {
    const id = $(this).val();

    get("deleteCategory/" + id).done(function (json) {
      var data = JSON.parse(json);
      modalRemove(data, id);
    });
  });

  // OPEN MODAL - NEW
  $(".btn-modal-new").on("click", function () {
    $("#modal-new").show();
  });

  // MODAL REMOVE

  // OPEN MODAL - REMOVE
  $(".btn-modal-remove").on("click", function () {
    const id = $(this).parent().parent().data("id");

    get("getCategory/" + id).done(function (json) {
      modalRemoveShowData(JSON.parse(json), "#modal-remove");
    });
  });

  $(".btn-close-modal").on("click", function () {
    $(this).parents(".modal").hide();
  });
});
