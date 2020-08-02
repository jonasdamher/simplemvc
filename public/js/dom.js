"use strict";

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

function statusInputSearch() {
  $("#btn-quit-search").toggleClass("d-none");

  if ($("#search").hasClass("d-none")) {
    $("#search")
      .toggleClass("d-none")
      .removeClass("search-hide")
      .toggleClass("search-show");
    return;
  }

  $("#search").removeClass("search-show").toggleClass("search-hide");
  setTimeout(() => {
    $("#search").toggleClass("d-none");
  }, 300);
}

$(function () {
  $(".btn-dropdown").on("click", function () {
    let btn = $(this);
    btn.parent().siblings(".dropdown").toggle();
    btn.toggleClass("active");

    if (btn.hasClass("active")) {
      btn.children("svg").removeClass("fa-caret-down").addClass("fa-caret-up");
    } else {
      btn.children("svg").removeClass("fa-caret-up").addClass("fa-caret-down");
    }
  });

  $("#btn-search").click(function () {
    let btn = $(this);
    if (btn.attr("data-toggle") == "close") {
      statusInputSearch();
    }
    btn.attr("data-toggle", "open");
  });

  $("#btn-quit-search").click(function () {
    $("#btn-search").attr("data-toggle", "close");
    statusInputSearch();
  });

  $(".btn-snackbar-close").click(function () {
    $(this).parents(".snackbar").fadeOut(200);
  });

  $(".btn-close-modal").on("click", function () {
    $(this).parents(".modal").hide();
  });
});
