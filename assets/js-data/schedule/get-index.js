(function ($) {
  "use strict";

  var linkUrl = "Schedule/getIndex/";
  var param = "";
  var role = "";
  callIndex();

  function callIndex() {
    $("#overlay").fadeIn();
    loadPagination(0);
  }

  $("#search-data-by-police-number").on("click", function (e) {
    if ($("#police_number").val() != "") {
      $("#overlay").fadeIn();
      linkUrl = "Truck/search_data/";
      param = "police_number=" + $("#police_number").val();
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
        var korlap_id = result[index].korlap_id;
        var date_schedule = result[index].date_schedule;
        var kabupaten = result[index].kabupaten;
        var kecamatan = result[index].kecamatan;
        var kelurahan = result[index].kelurahan;
        var no_rw = result[index].no_rw;
        var no_rt = result[index].no_rt;
        var status = result[index].status;
        var qty = result[index].qty;
        var updated_date = result[index].updated_date;
        var created_date = result[index].created_date;
        var name_korlap = result[index].name_korlap;
        var phone = result[index].phone;
        var nik_ktp = result[index].nik_ktp;
        var remarks = result[index].remarks;
        var button_edit =
          '<a href="Truck/edit/?id=' +
          id +
          '" style="margin-left: 5px;" >' +
          '<button data-toggle="tooltip" title="delete" class="btn btn-default btn-sm">' +
          '<i class="nav-icon fas fa-edit" style="color: blue;"></i>' +
          "</button>" +
          "</a>";

        var button_delete =
          '<a data-toggle="modal" data-target="#konfirmasi_hapus" data-href="Truck/deleteTruck/?id=' +
          id +
          '" data-message="Are you sure you want to delete " data-name="' +
          name_korlap +
          '" style="margin-left: 5px;" >' +
          '<button data-toggle="tooltip" title="delete" class="btn btn-default btn-sm">' +
          '<i class="fa fa-times" style="color: blue;"></i>' +
          "</button>" +
          "</a>";

        sno += 1;

        var tr = "<tr>";
        tr += "<td data-field='id' class='no'>" + sno + "</td>";
        tr += "<td>" + name_korlap + "</td>";
        tr += "<td>" + kabupaten + "</td>";
        tr += "<td>" + kecamatan + "</td>";
        tr += "<td>" + kelurahan + "</td>";
        tr += "<td>" + no_rw + "</td>";
        tr += "<td>" + no_rt + "</td>";
        tr += "<td>" + date_schedule + "</td>";
        tr += "<td>" + remarks + "</td>";
        tr += "<td>" + button_edit + "</td>";
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

  $("#pagination").on("click", "a", function (e) {
    $("#overlay").fadeIn();

    e.preventDefault();

    var pageno = $(this).attr("data-ci-pagination-page");

    loadPagination(pageno);
  });
})(jQuery);
