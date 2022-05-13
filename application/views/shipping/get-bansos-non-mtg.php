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

  /* table,th,td,tr{
    border:1px solid #000;
  } */
</style>

<div class="content-header">

  <div class="container-fluid" style="margin-top: 8px;">

    <div class="row mb-2">

      <div class="col-lg-2">

        <ol class="breadcrumb">

          <li class="breadcrumb-item"><a href="#">Dashboard/Data Bansos</a></li>

        </ol>

      </div>

      <div class="col-lg-10">

        <div class="row float-right">

          <a href="<?php echo base_url('Shipping/add'); ?>">

            <button type="button" class="btn btn-default btn-sm">

              <i class="fa fa-add" aria-hidden="true"></i> Add Manifest

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

    <div class="row">

      <div class="col-md-12">

        <div class="row">

          <div class="col-md-12">

            <div class="card">

              <div class="card-body p-0">

                <div class="table-responsive">
                  <div class="card-body">
                    <h3> List : </h3>
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-sm-4">
                          <p> BAST number : <?php echo $dt_object->code_shipping; ?> </p>
                          <p> kabupaten : <?php echo $dt_object->kabupaten; ?> </p>
                          <p> kecamatan : <?php echo $dt_object->kecamatan; ?> </p>
                          <p> kelurahan : <?php echo $dt_object->kelurahan; ?> </p>
                          <p> kapasitas : <?php echo $dt_object->qty; ?> </p>
                        </div>
                        <!-- <div class="col-sm-4">
                          <table class="table table-striped projects">
                            <tr>
                              <th>BAST BANSOS</th>
                              <th>RW</th>
                              <th>RT</th>
                              <th>QUANTITY</th>
                            </tr>
                            <?php foreach ($dt_detail as $detail) { ?>
                              <tr>
                                <td><?php echo $detail['detail_number']; ?></td>
                                <td><?php echo $detail['no_rw']; ?></td>
                                <td><?php echo $detail['no_rt']; ?></td>
                                <td><?php echo $detail['total']; ?></td>
                              </tr>
                            <?php } ?>
                          </table>
                        </div> -->
                        <div class="col-sm-4">
                          <a href="<?php echo base_url() ?>Shipping/pdf?id=<?php echo $id; ?>" target="_blank">
                            <button type="button" class="btn btn-default btn-sm">
                              <i class="fa fa-add" aria-hidden="true"></i> Download
                            </button>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-tools text-center" id="pagination"></div>
                </div>



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

<!-- <script src="<?php echo base_url(); ?>assets/js-data/shipping/get-index.js" id="date" data-start="<?php echo date('d-m-Y', strtotime($start)); ?>" data-end="<?php echo date('d-m-Y', strtotime($end)); ?>"></script> -->

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

  $('#PrimaryModalhdbgclEdit').on('show.bs.modal', function(e) {
    var nik_ktp = $(e.relatedTarget).data('nik_ktp');


    $(e.currentTarget).find('#show_nik').text(nik_ktp);
    $(e.currentTarget).find('#input_nik').val(nik_ktp);
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#blah')
          .attr('src', e.target.result)
          .width(400)
          .height(400);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#send_edit").click(function() {
    if ($("#id_image").val() < 1) {
      $("#txt_username").text("Image is empty");
    } else {
      $("#txt_username").text("");
    }



    if (
      $("#id_image").val().length > 0) {
      $("#kirim_edit").click();
    }
  });
</script>
<script>
  // Get the modal
  var modal = document.getElementById('myModal');

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementById('myImg');
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  img.onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
</script>