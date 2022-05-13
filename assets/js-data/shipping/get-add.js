$(document).ready(function () {
  var now = new Date();
  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);
  var today = now.getFullYear() + "-" + month + "-" + day;
  $("#date_shipping").val(today);
  $("#name_wh option:contains(Gudang Non JAKBAR)").attr("selected", "selected");
  $("#kabupaten").change(function (e) {
    $.ajax({
      url: "./get_kecamatan",
      type: "post",
      dataType: "json",
      data: { kabupaten: $("#kabupaten").val() },
      success: function (response) {
        var emptyOption = new Option("-select-", 0);
        $("#kecamatan").empty().append(emptyOption);
        response.forEach(function (kecamatan) {
          var option = new Option(kecamatan);
          $("#kecamatan").append(option);
        });
      },
    });
  });
  $("#kecamatan").change(function (e) {
    $.ajax({
      url: "./get_kelurahan",
      type: "post",
      dataType: "json",
      data: {
        kabupaten: $("#kabupaten").val(),
        kecamatan: $("#kecamatan").val(),
      },
      success: function (response) {
        var emptyOption = new Option("-select-", 0);
        $("#kelurahan").empty().append(emptyOption);
        response.forEach(function (kelurahan) {
          var option = new Option(
            kelurahan.kelurahan + " (Sisa KPM:" + kelurahan.remaining + ")"
          );
          $("#kelurahan").append(option);
        });
      },
    });
  });
  $("#name_truck").change(function (e) {
    var nameTruck = $("#name_truck option:selected").html();
    var qty = nameTruck.substring(
      nameTruck.indexOf("(") + 12,
      nameTruck.indexOf(")")
    );
    $("#qty").val(qty);
  });
});
