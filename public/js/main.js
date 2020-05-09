$(function () {
  $(".btn-dropdown").on("click", function () {
    $(this).siblings(".dropdown").toggle();
    $(this).toggleClass("active");
  });

  function ajax(action, formData = null) {
    return $.ajax({
      method: formData == null ? "POST" : "GET",
      url: "//localhost/simplymvcphp/Ajax/" + action,
      data: {
        formData
      }
    });
  }

  function showModalData(action, typeModal) {
    var modal = 'modal'+typeModal;
    ajax(action).done(res => {
      modal(JSON.parse(res))
    }); 
  }

  function modalShowDelete(data){
    console.log(data)
  }

  $(".btn-modal-delete").on("click", function () {
    const id = $(this).parent().parent().data("id");

    showModalData("getCategory/" + id, "ShowDelete");
    $("#modal-delete").toggle();
  });

  $(".btn-close-modal").on("click", function () {
    $(this).parent().parent().parent().parent().toggle();
  });
});
