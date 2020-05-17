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

  function modalRemove(data,id) {
    if (!data.success) {
      $("#error-request-remove").show();
      $("#error-request-remove").text(data.message);
      return;
    }

    $("#request-success-remove").show();
    $("#request-success-remove").text("Success, Remove category !");
    $('#table-categories').child('tbody').child(`tr[data-id=${id}]`).remove();
  }

  // REMOVE CATEGORY
  $("#btn-remove-category").click(function () {
    const id = $(this).val();

    get("deleteCategory/" + id).done(function (json) {
      var data = JSON.parse(json);
      modalRemove(data,id);
    });
  });

  // OPEN MODAL - NEW
  $(".btn-modal-new").on("click", function () {
    $("#modal-new").show();
  });

  // MODAL REMOVE

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
