var base_url = $('#base').val();
(function ($) {
  "use strict";

  var linkUrl = "Zonasi/getIndex/";
  var param = "";
  var role = "";
  callIndex();

  function callIndex() {
    $("#overlay").fadeIn();
    loadPagination(0);
  }

  $("#filter-zonasi").on("click", function (e) {
    if ($("#code_manifest").val() != "" || $("#id_filter").val() != "" || $("#id_filter_1").val() != "" || $("#id_filter_2").val() != "") {
      $("#overlay").fadeIn();
      linkUrl = "Zonasi/filterZonasi/";
      param =
        "value=" +
        $("#code_manifest").val() +
        "&param=" +
        $("#id_filter").val() +
        "&param_1=" +
        $("#id_filter_1").val() +
        "&param_2=" +
        $("#id_filter_2").val();

      loadPagination(0);
    }
  });
  $(document).on('click', 'button.showdatarequsition',function(event) {
    var supplier_kode = $(this).data('id');
    $.ajax({
        url: base_url+'Zonasi/getRequsition/',
        type: "POST",
        dataType: "JSON",
        data : {
          supplier_kode : supplier_kode
        },
        success: function(response) {
            setTimeout(function () {
              $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Show Data Requsition'); // Set title to Bootstrap modal title
              ShowRequsition(response, 0)
            }, 500);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            swal(
                'Error',
                'get data from ajax',
                'error'
            )
        }
    });
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
          createTable(response.result, response.row, response.warehouse);
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

  function createTable(result, sno, warehouse) {
    if (result.length > 0) {
      sno = Number(sno);
      $("#data tbody").empty();
      var index;
      for (index in result) {
        sno += 1;
        var id          = result[index].id;
        var provinsi    = result[index].provinsi;
        var kabupaten = result[index].kabupaten;
        var kecamatan = result[index].kecamatan;
        var kelurahan = result[index].kelurahan;
        var priority = result[index].priority;
        var name_warehouse = result[index].name_warehouse;
        var target_kpm = result[index].target_kpm;
        var sisa_kpm = result[index].sisa_kpm;
        var date_plan = result[index].date_plan;
        var qty = result[index].qty;
        var code_faskes = result[index].code_faskes;
        var button_show = '<button class="showdatarequsition btn btn-sm btn-default" type="button" title="Show Data Requisition" data-id=' + code_faskes + ' id="button_delete"><i class="fas fa-list" style="color: blue;"></i></button>';

        
        var date_plan_ = " ";
        if (date_plan != null) {
          date_plan_ = date_plan;
        } else {
          date_plan_ = " ";
        }
        var button_edit =
          '<a href="Zonasi/getEdit/?id=' +
          id +
          '" style="margin-left: 5px;" >' +
          '<button data-toggle="tooltip" title="edit" class="btn btn-default btn-sm">' +
          '<i class="nav-icon fas fa-edit" style="color: blue;"></i>' +
          "</button>" +
          "</a>";

        var button_delete =
          '<a data-toggle="modal" data-target="#konfirmasi_hapus" data-href="Zonasi/delete/?id=' +
          id +
          '" data-message="Are you sure you want to delete " data-name="' +
          kabupaten +
          '" style="margin-left: 5px;" >' +
          '<button data-toggle="tooltip" title="delete" class="btn btn-default btn-sm">' +
          '<i class="fa fa-times" style="color: blue;"></i>' +
          "</button>" +
          "</a>";


        var tr = "<tr data-id='"+id+"'>";
        tr += "<td data-field='id' class='no'>" + sno + "</td>";
        tr += "<td>" + code_faskes + "</td>";
        tr += "<td>" + qty + "</td>";
        tr += "<td>" + provinsi + "</td>";
        tr += "<td>" + kabupaten + "</td>";
        tr += "<td>" + kabupaten + "</td>";
        tr += "<td>" + kelurahan + "</td>";
        tr += "<td style='text-align:center'><span class='span-priority caption' data-id='"+id+"'>"+priority+"</span> <input style='width:40px;' type='text' class='field-priority editor' value='"+priority+"' data-id='"+id+"' /></td>";
        tr += "<td ><span class='span-email caption' data-id='"+id+"'>"+name_warehouse+"</span>"+
        "<input type='text' class='field-email editor' style='width:85px;' value='"+name_warehouse+"' data-id='"+id+"' /></td>";

        tr += "<td>" + date_plan_ + "</td>";
        tr += "<td>" + button_show + button_edit + button_delete + "</td>";
        tr += "</tr>";
        $("#data tbody").append(tr);
      }


        $(document).on("click","td",function(){
          $(this).find("span[class~='caption']").hide();
          $(this).find("input[class~='editor']").fadeIn().focus();
         });


        $(document).on("keydown",".editor",function(e){
          $(this).val($(this).val().toUpperCase());
            if(e.keyCode==13){
            var target=$(e.target);
            var value =target.val();
            var id    =target.attr("data-id");
            var data    ={id:id,value:value};
            if(target.is(".field-priority")){
              data.modul="priority";
            }else if(target.is(".field-email")){
              data.modul="name_warehouse";
              }

        $.ajax({
          cache:false,
          type: "get",
          dataType: "json",
          data:data,
          url:base_url+"Zonasi/updatekolom",
          success: function(response){

            // alert(response.messages_data);
            if (response.messages_data == "BERHASIL UPDATE DUA GUDANG" || response.messages_data == "BERHASIL UPDATE SATU GUDANG" || response.messages_data == "BERHASIL UPDATE PRORITY") {
                // alert(response.messages_data);
                target.hide();
                target.siblings("span[class~='caption']").html(value).fadeIn();
            } else if (response.messages_data == "CODE WAREHOUSE TIDAK DITEMUKAN"){
              // alert(response.messages_data);
              bootbox.alert({
                  title: "Notifikasi",
                  message: "CODE WAREHOUSE YAMG ANDA INPUTKAN SALAH<br><br><br> NOTE : Untuk Gudang Multiple Pastikan Menggunakan Space Untuk Jarak Setiap Code Gudang",
              });
                // target.hide();
                // target.siblings("span[class~='caption']").html(value).fadeIn();
            } else{

              bootbox.alert({
                  title: "Notifikasi",
                  message: "<h1>REFRESH HALAMAN DAN TEKAN CTRL+SHIFT+R(WINDOWS)/COMMAND+SHIFT+R(MAC)<h1>",
              });


            }

          }
        })

        }

        });

    } else {
      $("#data tbody").empty();
      var tr = "<tr>";
      tr +=
        "<td colspan='10' class='text-center'><i class='fa fa-search-minus fa-lg text-secondary' style='margin-top: 15px;'><span class='errorFound'>Data empty</span></i></td>";
      tr += "</tr>";
      $("#data tbody").append(tr);
    }
  }

  function ShowRequsition(result, sno) {
    if (result.length > 0) {
      sno = Number(sno);
      $("#datashow tbody").empty();
      var index;
      for (index in result) {
        sno += 1;
        var requisition_number          = result[index].requisition_number;
        var tr = "<tr>";
        tr += "<td data-field='id' class='no'>" + sno + "</td>";
        tr += "<td>" + requisition_number + "</td>";
        tr += "</tr>";
        $("#datashow tbody").append(tr);
      }
    } else {
      $("#datashow tbody").empty();
      var tr = "<tr>";
      tr +=
        "<td colspan='10' class='text-center'><i class='fa fa-search-minus fa-lg text-secondary' style='margin-top: 15px;'><span class='errorFound'>Data empty</span></i></td>";
      tr += "</tr>";
      $("#datashow tbody").append(tr);
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
