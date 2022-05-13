<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lightbox.min.css">
<script>
  function onlyNumber(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
  setTimeout(function() {
    $("div.alert").remove();
  }, 5000);
</script>

<div class="section__content section__content--p30">

  <div class="container-fluid">

    <div class="row">

      <!--<br><br> -->

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="breadcome-list single-page-breadcome shadow">

          <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

              <div class="breadcome-heading">



              </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

              <ul class="breadcome-menu">



              </ul>

            </div>

          </div>

        </div>

      </div>

    </div>



  </div>

  <!-- Main content -->

  <section class="content">
    <div class="container-fluid">
      	<div class="row">
            <!-- left column -->
        	<div class="col-md-12">
                <!-- general form elements -->
          		<div class="card card-primary">
            		<div class="card-header">
	              		<h3 class="card-title">Add Korlap</h3>
	            	</div>

    		        <form id="add-module" role="form" action="<?php echo base_url('Arko/add_data_korlap') ?>" method="post" enctype="multipart/form-data" class="add-arko" autocomplete="off" required>
			            <div class="card-body">
	                  	<p>
                    	<div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                          <div class="input-mask-title"><label>Arko Name</label></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                          <div class="input-mask-title"><label>Korlap Name</label></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                          <div class="input-mask-title"><label>NIK</label></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                          <div class="input-mask-title"><label>Phone</label></div>
                        </div>
                    	</div>
                      <div class="row">
                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <input type="text" name="name_arko" id="name_arko" value="<?php echo $data->name_arko; ?>" class="form-control" placeholder="Arko Name" readonly>
                            <input type="hidden" name="arko_id" id="arko_id" value="<?php echo $data->id; ?>">
                          </div>
                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <input type="text" name="name_child" id="name_child" class="form-control" placeholder="Korlap Name" required>
                          </div>
                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <input type="text" name="nik_ktp" id="nik_ktp" class="form-control" placeholder="NIK" onkeypress="return onlyNumber(event)" required>
                          </div>
                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                             <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" onkeypress="return onlyNumber(event)" required>
                          </div>
                        </div>
                        <p>
                        <div class="row">
                          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <div class="input-mark-inner mg-b-22">
                              <a href="<?php echo base_url('Arko') ?>" class="btn btn-danger">Back</a>
                              <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <p>

              </div>

            </form>

          </div>

          <!-- /.card -->

          <!-- /.card -->

        </div>

        <!--/.col (left) -->



        <!-- /.card -->

      </div>

      <!--/.col (right) -->

    </div>

    <!-- /.row -->
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
            <!-- general form elements -->
      		<div class="card card-primary">
  				<table class="table table-striped projects" id="data">
                  <thead>
                    <tr>
                      <th data-field="id" class="no">No</th>
                      <th data-field="arko_name" data-editable="true" class="variant">Arko Name</th>
                      <th data-field="kabupaten" data-editable="true" class="variant">Korlap Name</th>
                      <th data-field="kecamatan" data-editable="true" class="variant">NIK</th>
                      <th data-field="kelurahan" data-editable="true" class="variant">Phone</th>
                      <th data-field="kelurahan" data-editable="true" class="variant">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php for($a=0; $a < sizeof($korlapList); $a++){?>
                      		<tr>
                      			<td><?php echo $a+1; ?></td>
                      			<td><?php echo $data->name_arko; ?></td>
                      			<td><?php echo $korlapList[$a]->name_child;?></td>
                      			<td><?php echo $korlapList[$a]->nik_ktp;?></td>
                      			<td><?php echo $korlapList[$a]->phone;?></td>
                            <td>
                              <button title="Edit Korlap" class="btn btn-default btn-sm" data-toggle="modal" data-target="#konfirmasi_edit<?php echo $korlapList[$a]->id ?>"><i class="nav-icon fas fa-edit" style="color: blue;"></i></button>
                              <button title="Delete Korlap" data-target="#konfirmasi_Delete<?php echo $korlapList[$a]->id ?>" data-toggle="modal" title="delete" class="btn btn-default btn-sm">
                                <i class="fa fa-times" style="color: blue;"></i></button></td>
                      		</tr>
                    <?php }?>
                  </tbody>
                </table>
            </div>
        </div>
   </div>

</div><!-- /.container-fluid -->

</section>

<?php foreach ($korlapList as $dt) :  ?>
<div class="modal fade" id="konfirmasi_edit<?php echo $dt->id ?>">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h4 class="modal-title">Edit KORLAP</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'Arko/editKorlap'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-12">
                    <label class="col-sm-4 control-label">Arko Name</label>
                    <input type="text" name="arko_name" class="form-control" id="inputUserName" placeholder="Arko Name" value="<?php echo $data->name_arko ?>" readonly required>
                    <input type="hidden" name="idk" class="form-control" id="inputUserName" placeholder="Arko Name" value="<?php echo encodedata($data->id) ?>" readonly required>
                    <input type="hidden" name="id" class="form-control" id="inputUserName" placeholder="Arko Name" value="<?php echo encodedata($dt->id) ?>" readonly required>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-12">
                    <label class="col-4">Korlap Name</label>
                    <input type="text" name="korlap" class="form-control" placeholder="Nama Korlap" value="<?php echo $dt->name_child ?>" required>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-12">
                    <label class="col-6">NIK</label>
                    <input type="text" name="nik_ktp" class="form-control" value="<?php echo $dt->nik_ktp ?>" placeholder="NIK" onkeypress="return onlyNumber(event)">
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-12">
                    <label class="col-6">Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Nomor Hp" value="<?php echo $dt->phone ?>" onkeypress="return onlyNumber(event)">
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
              </div>

            </form>
          </div>
        </div>
      </div>
<?php endforeach;?>

<?php foreach ($korlapList as $dt) :  ?>
<div class="modal fade" id="konfirmasi_Delete<?php echo $dt->id ?>">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h4 class="modal-title">Delete KORLAP</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'Arko/deleteKorlap'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-12">
                    <center><p>Are You Sure Delete Korlap <b><?php echo ($dt->name_child) ?></b>?</p></center>
                    <input type="hidden" name="id" class="form-control" id="inputUserName" placeholder="Arko Name" value="<?php echo encodedata($dt->id) ?>" readonly required>
                    <input type="hidden" name="idk" class="form-control" id="inputUserName" placeholder="Arko Name" value="<?php echo encodedata($data->id) ?>" readonly required>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger btn-flat" id="simpan">Delete</button>
              </div>

            </form>
          </div>
        </div>
      </div>
<?php endforeach;?>

<script src="<?php echo base_url(); ?>assets/js/lightbox-plus-jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script> -->
