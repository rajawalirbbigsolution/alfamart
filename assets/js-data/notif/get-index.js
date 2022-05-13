(function ($) {
    "use strict";
  
    $("#label").autocomplete({
      source: "Driver/search",
  
      select: function (event, ui) {
        $('[name="label"]').val(ui.item.label);
      },
    });
  
    var linkUrl = "Notification/getIndex/";
  
    var param = "";
  
    var role = "";
  
    callIndex();
  
    function callIndex() {
      $("#overlay").fadeIn();
  
      loadPagination(0);
    }
  
    $("#search-code-order").on("click", function (e) {
      if ($("#label").val() != "") {
        $("#overlay").fadeIn();
  
        linkUrl = "Product/search_data/";
  
        param = "label=" + $("#label").val();
  
        loadPagination(0);
      }
    });
  
    $("#filter-manifest").on("click", function (e) {
      if ($("#date_schedule").val() != "" && $("#id_filter").val() != "") {
        $("#overlay").fadeIn();
  
        linkUrl = "ReportNon/filterManifest/";
  
        //param = 'payment_status=' + $('#payment_status').val() + '&payment_method=' + $('#payment_method').val();
        param =
          "value=" +
          $("#date_schedule").val();
  
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
          const months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
          var id = result[index].id;
          var kabupaten = result[index].kabupaten;
          var kecamatan = result[index].kecamatan;
          var kelurahan = result[index].kelurahan;
          var code_bast = result[index].code_bast;
          var qty = result[index].qty;
          var damage = result[index].damage;
          var minus = result[index].minus;
          var difference = result[index].difference;
          var image = result[index].image;
          var date_shipping = result[index].date_shipping;
          var name_arko = result[index].name_arko;
            var ket = '';
          if(damage == 0 && minus == 1){
                ket = 'Kurang';
          }else if(damage == 1 && minus == 0){
                ket = 'Rusak';
          }else{
                ket = 'SUDAH KIRIM ULANG';
          }
          
          
          var button_delete =
          '<a data-toggle="modal" data-target="#konfirmasi_hapus" data-href="Notification/kirimUlang/?id=' +
          id +
          '" data-message="Kirim Ulang '+code_bast +' ?" data-name="' +
          code_bast +
          '" style="margin-left: 5px;" >' +
          '<button data-toggle="tooltip" title="delete" class="btn btn-default btn-sm">' +
          'SEND' +
          "</button>" +
          "</a>";
  
          
  
          sno += 1;
           
          var tr = "<tr>";
  
          tr += "<td data-field='id' class='no'>" + sno + "</td>";
  
          tr += "<td>" + date_shipping + "</td>";
          tr += "<td>" + code_bast + "</td>";
          tr += "<td>" + kabupaten + "</td>";
          tr += "<td>" + kecamatan + "</td>";
          tr += "<td>" + kelurahan + "</td>";
          tr += "<td>" + qty + "</td>";
          tr += "<td>" + ket + "</td>";
          tr += "<td>" + difference + "</td>";
          tr += "<td>" + name_arko + "</td>";
          tr += "<td>" + button_delete + "</td>";
         
         
  
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
  