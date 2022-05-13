<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

<style>
  a.nav-link {

    color: #a5a5a5;

    text-decoration: none;

    background-color: transparent;

  }



  .card-secondary.card-outline-tabs>.card-header a.active {

    border-top: 3px solid #505254;

    color: #505254;

  }
</style>

<div class="content-header">

  <div class="container-fluid" style="margin-top: 8px;">

    <div class="row mb-3">

      <div class="col-lg-4">

        <ol class="breadcrumb">

          <li class="breadcrumbs-joy"><a style="font-family: 'Source Sans Pro',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'; font-size: 32px;  font-weight: bold;" href="#"><?php echo $title; ?></a></li>

        </ol>

      </div>

      <div class="col-lg-8">

        <div class="row float-right">

          <a href="<?php echo base_url('ModuleLink/add'); ?>">

            <button type="button" class="btn btn-default btn-sm">

              <i class="fa fa-add" aria-hidden="true"></i> Add Module Link

            </button>

          </a>

        </div>

      </div>

    </div>

  </div>

</div>



<section class="content">

  <div class="container-fluid">





    <div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <?php echo $this->session->flashdata('notice'); ?>

        <?php echo $this->session->flashdata('successMessageInsert'); ?>

        <?php echo $this->session->flashdata('errorMessageInsert'); ?>

        <?php echo $this->session->flashdata('successMessageUpdate'); ?>

        <?php echo $this->session->flashdata('errorMessageUpdate'); ?>

        <?php echo $this->session->flashdata('errorMessageDataNotfound'); ?>

        <?php if ($this->session->flashdata('errorMessageDataNotfoundArray')) {

          $errorMessageDataNotfound = $this->session->flashdata('errorMessageDataNotfoundArray');

          echo '<div class="alert alert-danger alert-mg-b alert-success-style4 alert-st-bg3">

                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">

                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>

                                </button>

                                <i class="fa fa-times edu-danger-error admin-check-pro admin-check-pro-clr3" aria-hidden="true"></i>';

          for ($i = 0; $i < count($errorMessageDataNotfound); $i++) {

            echo '<p><strong>Danger! </strong> nama product <span style="color: red;">' . $errorMessageDataNotfound[$i]['name_product'] . '</span> dan variant <span style="color: red;">' . $errorMessageDataNotfound[$i]['variant'] . '</span> tidak ditemukan di Master Product.</p>';
          }

          echo '</div>';
        } ?>

        <div class="product-status-wrap shadow">
        </div>

      </div>

    </div>

    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary card-outline card-outline-tabs">
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-md-3">
                      <input type="text" class="form-control form-control-sm" id="name_driver" name="name_driver" placeholder="Name Driver">
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-custon-four btn-default btn-sm" id="search-data-by-name-driver">
                        <i class="fa fa-filter" aria-hidden="true"></i> Search
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
    <!-- /.card -->
    <!-- </div>
    </div> -->
  </div>

  <div class="row">

    <div class="col-md-12">

      <div class="row">

        <div class="col-md-12">

          <div class="card">

            <div class="card-body p-0">

              <div class="table-responsive">

                <table class="table table-striped projects" id="data">

                  <thead>

                    <tr>

                    <tr>

                      <th data-field="id" class="no">No</th>

                      <th data-field="role" data-editable="true" class="role">Role</th>

                      <th data-field="module" data-editable="true" class="module">Modul</th>

                      <th data-field="action">Action</th>

                    </tr>

                    </tr>

                  </thead>

                  <tbody></tbody>

                </table>

              </div>

              <div class="card-tools text-center" id="pagination"></div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>



  </div>



  <div id="konfirmasi_hapus" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">

    <div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-close-area modal-close-df">

          <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>

        </div>

        <div class="modal-body">

          <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>

          <h2>Warning</h2>

          <div class="modal-body">
            <b class="message"></b><br>
          </div>


        </div>

        <div class="modal-footer">

          <a class="btn btn-danger btn-ok" style="background-color: red;"> Yes</a>

          <a class="btn btn-primary" data-dismiss="modal"> No</a>

        </div>

      </div>

    </div>

  </div>



  <div id="konfirmasi_cancel" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">

    <div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-close-area modal-close-df">

          <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>

        </div>

        <div class="modal-body">

          <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>

          <h2>Peringatan</h2>

          <p>

            <span class="message" style="font-size: 18px;"></span>

            <b class="action" style="margin-left: 5px; margin-right: 5px; font-size: 18px; color: red;"></b> order

            <b class="name" style="margin-left: 5px; margin-right: 5px; font-size: 18px;"></b><span style="font-size: 18px;">?</span>

        </div>

        <div class="modal-footer">

          <a class="btn btn-danger btn-ok" style="background-color: red;"> Ya</a>

          <a class="btn btn-primary" data-dismiss="modal"> Tidak</a>

        </div>

      </div>

    </div>

  </div>



  <div id="konfirmasi_success" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">

    <div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-close-area modal-close-df">

          <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>

        </div>

        <div class="modal-body">

          <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>

          <h2>Peringatan</h2>

          <p>

            <span class="message" style="font-size: 18px;"></span>

            <b class="action" style="margin-left: 5px; margin-right: 5px; font-size: 18px; color: green;"></b>

            <b class="name" style="margin-right: 5px; font-size: 18px;"></b><span style="font-size: 18px;">?</span>

        </div>

        <div class="modal-footer">

          <a class="btn btn-danger btn-ok" style="background-color: red;"> Ya</a>

          <a class="btn btn-primary" data-dismiss="modal"> Tidak</a>

        </div>

      </div>

    </div>

  </div>



</section>





<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
<script type="text/javascript">
  var $statusfilter = 0;
  $(document).ready(function() {
    $("#overlay").fadeIn();
    var linkUrl = "<?php echo base_url() ?>ModuleLink/getIndex";
    var param = "";
    $.ajax({
      url: linkUrl,
      type: "get",
      dataType: "json",
      data: param,
      success: function(response) {
        linkUrl = response.url;
        param = response.params;
        role = response.role;
        $("#overlay").fadeOut().delay(400);
        setTimeout(function() {
          createTable(response);
        }, 500);
      },

      error: function(jqXHR, exception) {
        $("#overlay").fadeOut().delay(400);

        setTimeout(function() {
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

    function createTable(result) {
      if (result.length > 0) {
        var sno = 0;
        $("#data tbody").empty();
        var index;
        for (index in result) {
          var roleId = result[index].id;
          var role = result[index].role;
          var module_list = result[index].module;
          var module_string = "";
          for (module_index in module_list) {
            if (module_list[module_index].is_parent == 1) {
              module_string += module_list[module_index].module_name + "<br>";
            } else {
              module_string += "&emsp;" + module_list[module_index].module_name + "<br>";
            }
          }
          var button_edit =
            '<a href="ModuleLink/edit/?roleId=' +
            roleId +
            '" style="margin-left: 5px;" >' +
            '<button data-toggle="tooltip" title="edit" class="btn btn-default btn-sm">' +
            '<i class="nav-icon fas fa-edit" style="color: blue;"></i>' +
            "</button>" +
            "</a>";
          sno += 1;
          var tr = "<tr>";
          tr += "<td data-field='id' class='no'>" + sno + "</td>";
          tr += "<td>" + role + "</td>";
          tr += "<td>" + module_string + "</td>";
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

    $('#konfirmasi_hapus').on('show.bs.modal', function(e) {
      var message = $(e.relatedTarget).data('message');
      $(e.currentTarget).find('.message').text(message);
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

  });

  setTimeout(function() {
    $("div.alert").remove();
  }, 5000);
</script>