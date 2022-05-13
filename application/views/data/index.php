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
<style type="text/css">
    .text-error {
        font-size: 12px;
        font-style: italic;
        color: red;
        letter-spacing: 0.7px;
        margin-top: 5px;
    }

    .mandatory {
        font-size: 15px;
        color: red;
    }

    #search-target {
        left: 165px;
    }
</style>

<div class="content-header">

  <div class="container-fluid" style="margin-top: 8px;">

    <div class="row mb-3">

      <div class="col-lg-3">

        <ol class="breadcrumb">

          <li class="breadcrumbs-joy"><a style="font-family: 'Source Sans Pro',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'; font-size: 32px;  font-weight: bold;" href="#"><?php echo $title; ?></a></li>

        </ol>

      </div>

      <div class="col-lg-9">

        <div class="row float-right">

         
<?php if($this->session->userdata('role') == 'SUPER ADMIN'){ ?>
          <button type="button" class="btn btn-primary btn-dws-add" data-toggle="modal" data-target="#add-customer">
            <i class="fas fa-plus"></i> Data
        </button>
<?php } ?>
          

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

    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary card-outline card-outline-tabs">
          <!-- <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Status</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Pembayaran</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Wilayah</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Setting</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-uploads" role="tab" aria-controls="custom-tabs-one-uploads" aria-selected="false">Import</a>
              </li>
            </ul>
          </div> -->
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
        </div>
        <!-- /.card -->
      </div>
    </div>
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

                      <th data-field="module_name" data-editable="true" class="module_name">Nama</th>

                      <th data-field="module_url" data-editable="true" class="name_product">Nama File</th>

                      <th data-field="created_date" data-editable="true" class="created_date">Keterangan</th>
                      <th data-field="created_date" data-editable="true" class="created_date">Status</th>
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

  <div id="add-customer" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 30px">
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
                <div class="modal-body">
                    <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>
                    <div class="row" style="padding: 2% 6% 4% 6%">
                        <div class="col-md-12">
                            <form method="post" action="<?php echo base_url('Data/add_data') ?>" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <h3 style="font-weight: bold; color: #0565af">TAMBAH DATA</h3>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        Nama
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" name="name" id="name" placeholder="Name" >
                                        <span class="text-error" id="txt_name"></span>
                                    </div>
                                </div>



                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        Keterangan
                                    </div>
                                    <div class="col-md-9">
                                    <textarea class="form-control" name="description" id="description" placeholder="description"></textarea>
                                        <span class="text-error" id="txt_description"></span>

                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        File
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="file" name="name_file" id="name_file" placeholder="Email" >
                                        <span class="text-error" id="txt_email"></span>
                                    </div>
                                </div>
                                

                                <div class="row mt-3">
                                    <div class="col-md-9">
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" id="send" class="btn btn-primary" style="background-color: #FF7F00; border: none"> SAVE</button>
                                        <button type="submit" id="kirim" class="btn btn-primary" style="background-color: #FF7F00; display: none"> SAVE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="delete-customer" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 30px">
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo base_url('Data/delete') ?>" enctype="multipart/form-data">
                        <div class="row mb-3 text-center">
                            <h3 class="col-12" style="font-weight: bold;" align="center">HAPUS DATA</h3>
                        </div>
                        <div class="row mb-3 text-center">
                            <h5 class="col-12">Do you want to hapus this data?</h5>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 text-center">
                                <input type="hidden" name="delete_id" id="delete_id" value="">
                                <!-- <button type="button" id="btn-delete-submit" class="btn btn-primary" style="background-color: #ed6e00; border: none"> DELETE</button> -->
                                <button type="submit" id="btn-delete-submit" class="btn btn-primary" style="background-color: #ed6e00; border: none"> DELETE</button>
                                <button type="submit" class="btn btn-primary" style="background-color: #6cbd45; display: none"> SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</section>





<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/js-data/data/get-index.js" id="date" ></script>
<script src="<?php echo base_url(); ?>assets/js-data/data/js-data.js" id="date" ></script>

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