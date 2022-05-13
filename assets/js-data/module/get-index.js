(function ($) {
  "use strict";

  $("#label").autocomplete({
    source: "Driver/search",

    select: function (event, ui) {
      $('[name="label"]').val(ui.item.label);
    },
  });

  var linkUrl = "Module/getIndex/";

  var param = "";

  var role = "";

  callIndex();

  function callIndex() {
    $("#overlay").fadeIn();

    loadPagination(0);
  }

  $("#search-data-by-name-driver").on("click", function (e) {
    if ($("#name_driver").val() != "") {
      $("#overlay").fadeIn();
      linkUrl = "Module/search_data/";
      param = "name_driver=" + $("#name_driver").val();
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

        var module_name = result[index].module_name;

        var module_url = result[index].module_url;

        var created_date = result[index].created_date;

        var updated_date = result[index].updated_date;

        var button_edit =
          '<a href="Module/edit/?id=' +
          id +
          '" style="margin-left: 5px;" >' +
          '<button data-toggle="tooltip" title="edit" class="btn btn-default btn-sm">' +
          '<i class="nav-icon fas fa-edit" style="color: blue;"></i>' +
          "</button>" +
          "</a>";

        sno += 1;

        var tr = "<tr>";

        tr += "<td data-field='id' class='no'>" + sno + "</td>";

        tr += "<td>" + module_name + "</td>";

        tr += "<td>" + module_url + "</td>";

        tr += "<td>" + created_date + "</td>";

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
})(jQuery);
