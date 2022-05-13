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

      <div class="col-lg-2">

        <ol class="breadcrumb">

          <li class="breadcrumbs-joy"><a style="font-family: 'Source Sans Pro',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'; font-size: 32px;  font-weight: bold;" href="#"><?php echo $title; ?></a></li>

        </ol>

      </div>

      <div class="col-lg-10">

        <div class="row float-right">

          <a href="<?php echo base_url('Arko/add'); ?>">

            <button type="button" class="btn btn-default btn-sm">

              <i class="fa fa-add" aria-hidden="true"></i> Add Arko

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
      <div class="col-md-12">
        <div class="card card-secondary card-outline card-outline-tabs">
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <div class="col-lg-12">
                  <div class="row">
                    
                    <div class="col-md-3">

                      <div class="form-group">

                        <input type="text" class="form-control form-control-sm" id="code_manifest" name="code_manifest" placeholder="Parameter">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <select class="form-control form-control-sm" name="status" id="id_filter">
                          <option value="">--Filter--</option>
                          <option value="1">Name Arko</option>
                          <option value="2">Provinsi</option>
                          <option value="3">Phone</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">

                      <div class="row float-center">

                        <div class="col-md-4 col-6">

                          <div class="form-group">

                            <button type="submit" class="btn btn-custon-four btn-default btn-sm" id="filter-manifest">

                              <i class="fa fa-filter" aria-hidden="true"></i> Search

                            </button>

                          </div>

                        </div>

                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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

                    <tr>

                      <th data-field="id" class="no">No</th>

                      <th data-field="arko_name" data-editable="true" class="variant">Arko Name</th>

                      <th data-field="kabupaten" data-editable="true" class="variant">NIK</th>
                      
                      <th data-field="kecamatan" data-editable="true" class="variant">Phone</th>
                      <th data-field="kecamatan" data-editable="true" class="variant">Provinsi</th>

                      <th data-field="created_date" data-editable="true" class="variant">Created Date</th>

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

<script src="<?php echo base_url(); ?>assets/js-data/arko/get-index.js" id="date" data-start="<?php echo date('d-m-Y', strtotime($start)); ?>" data-end="<?php echo date('d-m-Y', strtotime($end)); ?>"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
<script type="text/javascript">
  var $statusfilter = 0;
  $(document).ready(function() {
    $('.filterbtn').click(function() {
      if ($statusfilter == 0) {
        $('#formfilter').show(999);
        $statusfilter = 1;
      } else {
        $('#formfilter').hide(999);
        $statusfilter = 0;
      }
    });

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