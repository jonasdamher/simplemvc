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

function checkDataSearch(e) {
  if ($("#search").val().trim() == "") {
    e.preventDefault();
  }
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

  $("#search").keypress(function (e) {
    if (e.which == 13) {
      checkDataSearch(e);
    }
  });

  $("#btn-search").click(function (e) {
    let btn = $(this);
    checkDataSearch(e);
    if (btn.attr("type") == "button") {
      $('.logo').addClass('d-none-md');
      $('#btn-main-menu').addClass('d-none-md');
      e.preventDefault();
    }

    if (btn.attr("data-toggle") == "close") {
      statusInputSearch();
    }

    btn.attr("data-toggle", "open");
    btn.attr("type", "submit");
  });

  $("#btn-quit-search").click(function () {
    $('.logo').removeClass('d-none-md');
    $('#btn-main-menu').removeClass('d-none-md');
    
    let btnSearch = $("#btn-search");
    btnSearch.attr("data-toggle", "close");
    btnSearch.attr("type", "button");
    statusInputSearch();
  });

  $(".btn-snackbar-close").click(function () {
    $(this).parents(".snackbar").fadeOut(200);
  });

  $(".btn-close-modal").on("click", function () {
    $(this).parents(".modal").hide();
  });

  $('#btn-main-menu').on('click', function () {
    $('#main-menu').toggleClass('open-menu');

    if ($('#main-menu').hasClass('open-menu')) {
      setTimeout(() => {
        $('#main-menu').css('left', '0px');
      }, 300);
    }
  });

});
