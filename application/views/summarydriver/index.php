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

    <div class="row mb-2">

      <div class="col-lg-6">

        <ol class="breadcrumb">

          <li class="breadcrumbs-joy"><a style="font-family: 'Source Sans Pro',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'; font-size: 32px;  font-weight: bold;" href="#"><?php echo $title; ?></a></li>

        </ol>

      </div>

      <div class="col-lg-6">

        <div class="row float-right">



        </div>

      </div>

    </div>

  </div>

</div>



<section class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary card-outline card-outline-tabs">
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <form id="add-product" role="form" action="" method="post" enctype="multipart/form-data" class="add-department" autocomplete="off">
                  <div class="col-lg-12">
                    <div class="row">

                      <div class="col-md-2">
                        <input type="date" class="form-control form-control-sm" id="dateshipping" name="dateshipping" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d') ?>">
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <select class="form-control form-control-sm" name="warehouse" id="warehouse">
                            <option value="0">Pilih Warehouse</option>
                            <?php foreach ($list_warehouse as $warehouse) { ?>
                              <option value="<?php echo $warehouse->id ?>"><?php echo $warehouse->name_warehouse ?>(<?php echo $warehouse->code_warehouse ?>)</option>
                            <?php } ?>
                          </select>
                          <span class="text-error" id="txt_warehouse"></span>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <button type="button" class="btn btn-custon-four btn-default btn-sm" id="btn-pdf-summary">
                          <i class="fa fa-filter" aria-hidden="true"></i>Download
                        </button>
                        <button style="display: none;" formtarget="_blank" type="submit" class="btn btn-custon-four btn-default btn-sm" id="btn-pdf-summary-send">
                          <i class="fa fa-filter" aria-hidden="true"></i> Download
                        </button>
                      </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
  </div>
  <?php echo $this->session->flashdata('notice'); ?>

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
                      <th data-field="id" class="no">No</th>
                      <th data-field="bast_no" data-editable="true" class="kabupaten">
                        <center> Bast Driver</center>
                      </th>
                      <th data-field="provinsi" data-editable="true" class="provinsi">
                        <center> Provinsi</center>
                      </th>
                      <th data-field="kabupaten" data-editable="true" class="kabupaten">
                        <center> Kabupaten</center>
                      </th>
                      <th data-field="kecamatan" data-editable="true" class="kecamatan">
                        <center>Kecamatan</center>
                      </th>
                      <th data-field="kelurahan" data-editable="true" class="kelurahan">
                        <center>Kelurahan</center>
                      </th>
                      <th data-field="antrian" data-editable="true" class="antrian">
                        <center>Antrian</center>
                      </th>
                      <th data-field="qty" data-editable="true" class="qty">
                        <center>Qty</center>
                      </th>
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


</section>





<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/js-data/summary-bast-driver/get-index.js" id="date" data-start="<?php echo date('d-m-Y', strtotime($start)); ?>" data-end="<?php echo date('d-m-Y', strtotime($end)); ?>"></script>

<script>
  var base_url = "<?php echo base_url() ?>";
</script>
<script>
  $(document).ready(function() {

    $(function() {
      $('#loader').fadeOut();
    });

    $("#btn-pdf-summary").click(function() {

      if ($('#warehouse').val() < 1) {
        $('#txt_warehouse').text('Pilih warehouse');
      } else {
        $('#txt_warehouse').text('');
      }


      if ($('#warehouse').val() > 0) {
        document.getElementById("add-product").action = base_url + 'SummaryDriver/GetPdf/';
        $("#btn-pdf-summary-send").click();
      }
    });
    setTimeout(function() {
      $("div.alert").remove();
    }, 5000);
  })
</script>