(function ($) {
  "use strict";

  var linkUrl = "Users/getIndex/";
  var param = "";
  var role = "";
  callIndex();

  function callIndex() {
    $("#overlay").fadeIn();
    loadPagination(0);
  }

  $("#filter-users").on("click", function (e) {
    if ($("#parameter").val() != "" && $("#id_filter").val() != "") {
      $("#overlay").fadeIn();

      linkUrl = "Users/filterUsers/";
      param =
        "value=" + $("#parameter").val() + "&param=" + $("#id_filter").val();

      loadPagination(0);
    }
  });

  function loadPagination(pagno) {
    $.ajax({
      url: linkUrl + pagno,
      type: "get",
      dataType: "json",
      data: param,
      success: function (response) {
        linkUrl = response.url;
        param = response.params;
        role = response.role;
        $("#overlay").fadeOut().delay(400);
        setTimeout(function () {
          $("#pagination").html(response.pagination);
          createTable(response.result, response.row);
        }, 500);
      },

      error: function (jqXHR, exception) {
        $("#overlay").fadeOut().delay(400);

        setTimeout(function () {
          $("#data tbody").empty();

          var tr = "";

          if (jqXHR.status === 0) {
            tr = "<tr>";

            tr +=
              "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Not connect, Verify Network.</span></i></td>";

            tr += "</tr>";
          } else if (jqXHR.status == 404) {
            tr = "<tr>";

            tr +=
              "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Requested page not found. [404]</span></i></td>";

            tr += "</tr>";
          } else if (jqXHR.status == 500) {
            tr = "<tr>";

            tr +=
              "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Internal Server Error [500].</span></i></td>";

            tr += "</tr>";
          } else if (exception === "parsererror") {
            tr = "<tr>";

            tr +=
              "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Requested JSON parse failed.</span></i></td>";

            tr += "</tr>";
          } else if (exception === "timeout") {
            tr = "<tr>";

            tr +=
              "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Time out error.</span></i></td>";

            tr += "</tr>";
          } else if (exception === "abort") {
            tr = "<tr>";

            tr +=
              "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Ajax request aborted.</span></i></td>";

            tr += "</tr>";
          } else {
            tr = "<tr>";

            tr +=
              "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Uncaught Error. " +
              jqXHR.responseText +
              "</span></i></td>";

            tr += "</tr>";
          }

          $("#data tbody").append(tr);
        }, 500);
      },
    });
  }

  function createTable(result, sno) {
    if (result.length > 0) {
      sno = Number(sno);
      $("#data tbody").empty();
      var index;
      for (index in result) {
        var id = result[index].id;
        var name = result[index].name;
        var role = result[index].role;
        var provinsi = result[index].provinsi;
        var password = result[index].password;
        var status = result[index].status;

        var button_edit =
          '<a href="Users/getEdit/?id=' +
          id +
          '" style="margin-left: 5px;" >' +
          '<button data-toggle="tooltip" title="Edit Role" class="btn btn-default btn-sm">' +
          '<i class="nav-icon fas fa-edit" style="color: blue;"></i>Edit Role' +
          "</button>" +
          "</a>";

        var button_edit_changePassword =
          '<a href="Users/changePassword/?id=' +
          id +
          '" style="margin-left: 5px;" >' +
          '<button data-toggle="tooltip" title="Edit Password" class="btn btn-default btn-sm">' +
          '<i class="nav-icon fas fa-edit" style="color: blue;"></i>Change Password' +
          "</button>" +
          "</a>";

        var status_aktif =
          '<a data-toggle="modal" data-target="#konfirmasi_hapus" data-href="Users/changeStatusNonAktif/?id=' +
          id +
          '" data-message="Are you sure you want to change Status Non Aktif " data-name="' +
          name +
          '" style="margin-left: 5px;" >' +
          '<button data-toggle="tooltip" title="Change Status" class="btn btn-default btn-sm">' +
          '<i class="fa fa-toggle-on" style="color: blue;"></i>' +
          "</button>" +
          "</a>";

        var status_aktif_non =
          '<a data-toggle="modal" data-target="#konfirmasi_hapus_aktif" data-href_aktif="Users/changeStatusAktif/?id=' +
          id +
          '" data-message_aktif="Are you sure you want to change status Aktif  " data-name_aktif="' +
          name +
          '" style="margin-left: 5px;" >' +
          '<button data-toggle="tooltip" title="Change Status" class="btn btn-default btn-sm">' +
          '<i class="fa fa-toggle-off" style="color: blue;"></i>' +
          "</button>" +
          "</a>";

        var ket_status = "";

        if (status == 1) {
          ket_status = "Aktif";
        } else {
          ket_status = "Non Aktif";
        }

        var status_button = "";

        if (status == 1) {
          status_button = status_aktif;
        } else {
          status_button = status_aktif_non;
        }

        sno += 1;

        var tr = "<tr>";
        tr += "<td data-field='id' class='no'>" + sno + "</td>";
        tr += "<td>" + name + "</td>";
        tr += "<td>" + role + "</td>";
        tr += "<td>" + provinsi + "</td>";
        tr += "<td>" + ket_status + "</td>";
        tr +=
          "<td>" +
          button_edit +
          button_edit_changePassword +
          status_button +
          "</td>";
        tr += "</tr>";
        $("#data tbody").append(tr);
      }
    } else {
      $("#data tbody").empty();
      var tr = "<tr>";
      tr +=
        "<td colspan='10' class='text-center'><i class='fa fa-search-minus fa-lg text-secondary' style='margin-top: 15px;'><span class='errorFound'>Data empty</span></i></td>";
      tr += "</tr>";
      $("#data tbody").append(tr);
    }
  }

  $("#konfirmasi_hapus").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var message = button.data("message");
    var name = button.data("name");
    var href = button.data("href");
    var modal = $(this);
    modal.find("#modal-message").text(message);
    modal.find("#modal-name").text(name);
    $("#hapus_data").attr("href", href);
  });

  $("#konfirmasi_hapus_aktif").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var message = button.data("message_aktif");
    var name = button.data("name_aktif");
    var href = button.data("href_aktif");
    var modal = $(this);
    modal.find("#modal-message_aktif").text(message);
    modal.find("#modal-name_aktif").text(name);
    $("#hapus_data_aktif").attr("href", href);
  });

  $("#pagination").on("click", "a", function (e) {
    $("#overlay").fadeIn();

    e.preventDefault();

    var pageno = $(this).attr("data-ci-pagination-page");

    loadPagination(pageno);
  });
})(jQuery);
