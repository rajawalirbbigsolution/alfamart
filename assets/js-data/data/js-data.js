$(document).ready(function () {
    $("#konfirmasi_hapus").on("show.bs.modal", function (e) {
      $(e.currentTarget).find("p").text($(e.relatedTarget).data("message"));
      $(e.currentTarget).find("b").text($(e.relatedTarget).data("name"));
      $(this).find(".btn-ok").attr("href", $(e.relatedTarget).data("href"));
    });
  });
  
  $(function () {
    $("#name").keypress(function (e) {
      var startPos = e.currentTarget.selectionStart;
      if (e.which === 32 && startPos == 0) {
        e.preventDefault();
      } else if ($("#name").val().length > 0) {
        $("#name").val(
          $("#name")
            .val()
            .replace(/\s{2,}/g, " ")
        );
      }
    });
  
    $(document).on("paste", "#name", function (e) {
      e.preventDefault();
      var withoutSpaces = e.originalEvent.clipboardData.getData("Text");
      return false;
    });

    $("#description").keypress(function (e) {
        var startPos = e.currentTarget.selectionStart;
        if (e.which === 32 && startPos == 0) {
          e.preventDefault();
        } else if ($("#description").val().length > 0) {
          $("#description").val(
            $("#description")
              .val()
              .replace(/\s{2,}/g, " ")
          );
        }
      });
    
      $(document).on("paste", "#description", function (e) {
        e.preventDefault();
        var withoutSpaces = e.originalEvent.clipboardData.getData("Text");
        return false;
      });
  
    
  
    $("#send").click(function () {
      if ($("#name").val().length < 1) {
        $("#txt_name").text("Name is empty");
      } else {
        $("#txt_name").text("");
      }

      if ($("#description").val().length < 1) {
        $("#txt_description").text("description is empty");
      } else {
        $("#txt_description").text("");
      }
  
     
  
      if (
        $("#name").val().length > 0 &&
        $("#description").val().length > 0 
      ) {
        $("#kirim").click();
      }
    });
  
    $("#delete-customer").on("show.bs.modal", function (e) {
        var id = $(e.relatedTarget).data("id_del");
    
        $(e.currentTarget).find("#delete_id").val(id);
    
        // var newOption = $('<option value="'+mitraid+'">'+mitraname+'</option>');
        // $('#mitraid_text').append(newOption);
      });
  
  
  
    
  
    
  });
  