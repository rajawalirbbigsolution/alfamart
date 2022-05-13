(function ($) {
  "use strict";

  $("#label").autocomplete({
    source: "Driver/search",

    select: function (event, ui) {
      $('[name="label"]').val(ui.item.label);
    },
  });

  var linkUrl = "Shipping/getIndex/";

  var param = "";

  var role = "";

  callIndex();

  function callIndex() {
    $("#overlay").fadeIn();

    loadPagination(0);
  }

  $("#filter-manifest").on("click", function (e) {
    $("#overlay").fadeIn();

    linkUrl = "Shipping/search_data/";
    param =
      "code_manifest=" +
      $("#code_manifest").val() +
      "&no_poliss=" +
      $("#no_poliss").val() +
      "&name_driver=" +
      $("#name_driver").val() +
      "&kabupaten=" +
      $("#kabupaten").val() +
      "&kelurahan=" +
      $("#kelurahan").val() +
      "&name_ex=" +
      $("#name_ex").val();
    loadPagination(0);
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
          $("#total").text("Total:" + response.total);

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

        var code_shipping = result[index].code_shipping;

        var shipping_date = result[index].shipping_date;

        var kelurahan = result[index].kelurahan;

        var kecamatan = result[index].kecamatan;

        var kabupaten = result[index].kabupaten;
        var name_driver = result[index].name_driver;
        var no_police = result[index].no_police;
        var capacity = result[index].capacity;
        var code_warehouse = result[index].code_warehouse;
        var name_warehouse = result[index].name_warehouse;
        var name_expedisi = result[index].name_expedisi;

        var created_date = result[index].created_date;

        var button_edit =
          '<a href="Shipping/getDataBansosNonMtg/?id=' +
          id +
          '" style="margin-left: 5px;" >' +
          '<button data-toggle="tooltip" title="view List" class="btn btn-default btn-sm">' +
          '<i class="nav-icon fas fa-edit" style="color: blue;"></i>' +
          "</button>" +
          "</a>";

        var button_delete =
          '<a data-toggle="modal" data-target="#konfirmasi_hapus" data-href="Driver/deleteDriver/?id=' +
          id +
          '" data-message="Are you sure want to delete driver ' +
          name_driver +
          '?"  data-name="' +
          name_driver +
          '" style="margin-left: 5px;" >' +
          '<button data-toggle="tooltip" title="delete" class="btn btn-default btn-sm">' +
          '<i class="fa fa-times" style="color: blue;"></i>' +
          "</button>" +
          "</a>";

        sno += 1;

        var tr = "<tr>";

        tr += "<td data-field='id' class='no'>" + sno + "</td>";

        tr += "<td>" + code_shipping + "</td>";

        tr += "<td>" + name_driver + "</td>";
        tr += "<td>" + name_warehouse + "</td>";
        tr += "<td>" + name_expedisi + "</td>";
        tr += "<td>" + kabupaten + "</td>";
        tr += "<td>" + kecamatan + "</td>";
        tr += "<td>" + kelurahan + "</td>";
        tr += "<td>" + shipping_date + "</td>";
        tr += "<td>" + button_edit + "</td>";
        tr += "</tr>";

        $("#data tbody").append(tr);
      }
    } else {
      $("#data tbody").empty();

      var tr = "<tr>";

      tr +=
        "<td colspan='10' class='text-center'><i class='fa fa-search-minus fa-lg text-secondary' style='margin-top: 15px;'><span class='errorFound'>Data kosong</span></i></td>";

      tr += "</tr>";

      $("#data tbody").append(tr);
    }
  }

  $("#pagination").on("click", "a", function (e) {
    $("#overlay").fadeIn();

    e.preventDefault();

    var pageno = $(this).attr("data-ci-pagination-page");

    loadPagination(pageno);
  });

  function rupiah(angka) {
    var reverse = angka.toString().split("").reverse().join(""),
      ribuan = reverse.match(/\d{1,3}/g);

    ribuan = ribuan.join(".").split("").reverse().join("");

    return ribuan;
  }
})(jQuery);
