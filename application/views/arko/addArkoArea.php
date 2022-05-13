<style type="text/css">
    .text-error {
        font-size: 12px;
        font-style: italic;
        color: red;
        letter-spacing: 0.7px;
        margin-top: 5px;
    }
</style>

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
	              		<h3 class="card-title">Add Arko Area</h3>
	            	</div>

    		        <form id="add-module" role="form" action="<?php echo base_url('ArkoArea/add_data_from_arko') ?>" method="post" enctype="multipart/form-data" class="add-arko" autocomplete="off">
			            <div class="card-body">

	                  	<p>
                    	<div class="row">
                    		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        	<div class="input-mask-title"><label>Arko Name</label></div>
                      	</div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                          <div class="input-mask-title"><label>Kabupaten</label></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                          <div class="input-mask-title"><label>Kecamatan</label></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                          <div class="input-mask-title"><label>Kelurahan</label></div>
                        </div>
                    	</div>
                      <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                          <input type="text" name="name_arko" id="name_arko" value="<?php echo $data->name_arko; ?>" class="form-control" placeholder="Arko Name" readonly>
                          <input type="hidden" name="arko_id" id="arko_id" value="<?php echo encodedata($data->id); ?>">
                          <span class="text-error" id="txt_name_arko"></span>
                        </div>
                        
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                          <div class="input-mark-inner mg-b-22">
                            <select class="form-control" name="kabupaten" id="kabupaten">
                              <option value="0">- select kabupaten -</option>
                              <?php foreach ($kabupaten as $value) { ?>
                              <option value="<?php echo $value->kabupaten; ?>"><?php echo $value->kabupaten; ?></option>
                              <?php } ?>
                            </select>
                            <span class="text-error" id="txt_kabupaten"></span>
                          </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                          <div class="input-mark-inner mg-b-22">
                            <select class="form-control" name="kecamatan" id="kecamatan">
                              <option value="0">- select kecamatan -</option>
                            </select>
                            <span class="text-error" id="txt_kecamatan"></span>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                          <div class="input-mark-inner mg-b-22">
                            <select class="form-control" name="kelurahan" id="kelurahan">
                              <option value="0">- select kelurahan -</option>
                            </select>
                            <span class="text-error" id="txt_kelurahan"></span>
                          </div>
                        </div>
                      </div>

                        <p>
                       <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
        	                    <div class="input-mark-inner mg-b-22">
                                <a href="<?php echo base_url('Arko') ?>" class="btn btn-danger" >Back</a>
                                <button type="button" class="btn bg-blue waves-effect"  id="send_edit">Save</button>
                                <button type="submit" class="btn bg-blue waves-effect" style="display:none;" id="kirim_edit">Save</button>
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
                      <th data-field="kabupaten" data-editable="true" class="variant">Kabupaten</th>
                      <th data-field="kecamatan" data-editable="true" class="variant">Kecamatan</th>
                      <th data-field="kelurahan" data-editable="true" class="variant">Kelurahan</th>
                      <th data-field="action" data-editable="true" class="variant">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php for($a=0; $a < sizeof($arkoAreaList); $a++){?>
                      		<tr>
                      			<td><?php echo $a+1; ?></td>
                      			<td><?php echo $name_arko?></td>
                      			<td><?php echo $arkoAreaList[$a]->kabupaten;?></td>
                      			<td><?php echo $arkoAreaList[$a]->kecamatan;?></td>
                      			<td><?php echo $arkoAreaList[$a]->kelurahan;?></td>
                            <td>
                              <button title="Delete Area Arko" data-target="#konfirmasi_Delete<?php echo $arkoAreaList[$a]->id; ?>" data-toggle="modal" title="delete" class="btn btn-default btn-sm">
                                <i class="fa fa-times" style="color: blue;"></i></button>
                              </td>
                      		</tr>
                    <?php }?>
                  </tbody>
                </table>
            </div>
        </div>
   </div>

</div><!-- /.container-fluid -->

</section>
<?php foreach ($arkoAreaList as $dt) :  ?>
<div class="modal fade" id="konfirmasi_Delete<?php echo $dt->id ?>">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
              <h4 class="modal-title">Delete Arko Area</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="<?php echo base_url().'Arko/deleteArkoArea'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-12">
                    <center><p>Are You Sure Delete Arko Area <b><?php echo $dt->kabupaten ?> - <?php echo $dt->kecamatan ?> - <?php echo $dt->kelurahan ?></b> ?</p></center>
                    <input type="hidden" name="id" class="form-control" id="inputUserName" placeholder="Arko Name" value="<?php echo encodedata($dt->id) ?>" readonly required>
                    <input type="hidden" name="idk" class="form-control" id="inputUserName" placeholder="Arko Name" value="<?php echo encodedata($id) ?>" readonly required>
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

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
          $("div.alert").remove();
        }, 5000);
        $("#kabupaten").on('change', function() {
            param =
                "kabupaten=" +
                $("#kabupaten").val();
            $.ajax({
                url: '<?php echo base_url('Arko/getKecamatan'); ?>',
                type: "get",
                dataType: "json",
                data: param,
                success: function(response) {
                    $('#kecamatan').empty();
                    $('#kecamatan').append('<option value="0">-select kecamatan-</option>');
                    response.forEach(function(row) {
                        $('#kecamatan').append('<option value="' + row.kecamatan + '">' +
                            row.kecamatan + '</option>');
                    });
                }
            });
        });
        
        $("#kecamatan").on('change', function() {
            param =
                "kabupaten=" +
                $("#kabupaten").val() +
                "&kecamatan=" +
                $("#kecamatan").val();
            $.ajax({
                url: '<?php echo base_url('Arko/getKelurahan'); ?>',
                type: "get",
                dataType: "json",
                data: param,
                success: function(response) {
                    $('#kelurahan').empty();
                    $('#kelurahan').append('<option value="0">-select kelurahan-</option>');
                    response.forEach(function(row) {
                        $('#kelurahan').append('<option value="' + row.kelurahan + '">' +
                            row.kelurahan +'</option>');
                    });
                }
            });
        });

        $("#send_edit").click(function(){
        if ($('#kabupaten').val() < 1) {
          $('#txt_kabupaten').text('Kabupaten tidak boleh kosong');
        }else{
          $('#txt_kabupaten').text('');
        }
        if ($('#kecamatan').val() < 1) {
          $('#txt_kecamatan').text('Kecamatan tidak boleh kosong');
        }else{
          $('#txt_kecamatan').text('');
        }
        if ($('#kelurahan').val() < 1) {
          $('#txt_kelurahan').text('Kelurahan tidak boleh kosong');
        }else{
          $('#txt_kelurahan').text('');
        }
        
        if($('#kabupaten').val().length > 1  && $('#kecamatan').val().length > 1 && $('#kelurahan').val().length > 1 ){
          $("#kirim_edit").click();
        }
      });
    })
</script>
