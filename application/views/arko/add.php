<style type="text/css">
    .text-error {
        font-size: 12px;
        font-style: italic;
        color: red;
        letter-spacing: 0.7px;
        margin-top: 5px;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/kialap/style/order.css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/gijgo.min.js"></script>

<link href="<?php echo base_url(); ?>assets/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    function onlyNumber(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }

    $(document).ready(function() {
        $("#kabupaten").on('change', function() {
            param =
                "kabupaten=" +
                $("#kabupaten").val();
            $.ajax({
                url: '<?php echo base_url('ArkoArea/getKecamatan'); ?>',
                type: "get",
                dataType: "json",
                data: param,
                success: function(response) {
                    $('#kecamatan').empty();
                    $('#kecamatan').append('<option value="0">- select kecamatan -</option>');
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
                url: '<?php echo base_url('ArkoArea/getKelurahan'); ?>',
                type: "get",
                dataType: "json",
                data: param,
                success: function(response) {
                    $('#kelurahan').empty();
                    $('#kelurahan').append('<option value="0">- select kelurahan -</option>');
                    response.forEach(function(row) {
                        $('#kelurahan').append('<option value="' + row.kelurahan + '">' +
                            row.kelurahan +'</option>');
                    });
                }
            });
        });
    })
</script>

<div class="section__content section__content--p30">
	<div class="container-fluid">
	    <div class="row">
      	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<div class="breadcome-list single-page-breadcome shadow">
       			<div class="row">
	           		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		            	<div class="breadcome-heading"></div>
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
	              		<h3 class="card-title">Add Arko</h3>
	            	</div>

    		        <form id="add-module" role="form" action="<?php echo base_url('Arko/add_data') ?>" method="post" enctype="multipart/form-data" class="add-arko" autocomplete="off">
			            <div class="card-body">
                        <p>
                        	<div class="row">
                        		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            		<div class="input-mask-title"><label>Provinsi</label></div>
                          		</div>
                          		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <input type="text" name="provinsi" class="form-control" id="provinsi" value="<?php echo $provinsi;?>" readonly/>
                                  <!-- <select class="form-control" name="provinsi" id="provinsi">
                                          <option value="0">-pilih-</option>
                                          <?php foreach($provinsi as $pro) { ?>
                                            <option><?php echo $pro->provinsi;?></option>
                                          <?php } ?>
                                  </select> -->
                                   <span class="text-error" id="txt_provinsi"></span>
                          		</div>
                        	</div>

    	                  	<p>
                        	<div class="row">
                        		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            		<div class="input-mask-title"><label>Arko Name</label></div>
                          		</div>
                          		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" name="name_arko" id="name_arko" class="form-control" placeholder="Arko Name">
                                    <span class="text-error" id="txt_name_arko"></span>
                          		</div>
                        	</div>
                        	
                        	<p>
                          	<div class="row">
                          		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            		<div class="input-mask-title"><label>NIK</label></div>
                          		</div>
                          		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" name="nik_ktp" id="nik_ktp" class="form-control" placeholder="NIK" onkeypress="return onlyNumber(event)">
                                    <span class="text-error" id="txt_nik_ktp"></span>
                          		</div>
                        	</div>
                        	
                        	<p>
                          	<div class="row">
                          		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            		<div class="input-mask-title"><label>Phone</label></div>
                          		</div>
                          		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" onkeypress="return onlyNumber(event)">
                                    <span class="text-error" id="txt_phone"></span>
                          		</div>
                        	</div>
                        	
                        	<p>
                            <div class="row">
                              	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                	<div class="input-mask-title">
            							<label></label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            	                    <div class="input-mark-inner mg-b-22">
                                        <a href="<?php echo base_url('Arko') ?>" class="btn btn-danger" style="margin-left: 5px;">Back</a>
                                        <button type="button" class="btn bg-blue waves-effect"  id="send_edit">Save</button>
                                        <button type="submit" class="btn bg-blue waves-effect" style="display:none;" id="kirim_edit">Save</button>
                                    </div>
                                </div>
                            </div>
                            
						</div>
              </div>

            </form>

          </div>

          <!-- /.card -->

        </div>

        <!--/.col (left) -->

        <!-- /.card -->

      </div>

      <!--/.col (right) -->

    </div>

    <!-- /.row -->

</div><!-- /.container-fluid -->

</section>


<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>


<!-- <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" /> -->

<script>
  var loadFile = function(event) {

    var output = document.getElementById('output');

    output.src = URL.createObjectURL(event.target.files[0]);

  };
</script>

<script type="text/javascript">
   $(document).ready(function() {
  $("#send_edit").click(function(){
        if ($('#name_arko').val().length < 1) {
          $('#txt_name_arko').text('name arko tidak boleh kosong');
        }else{
          $('#txt_name_arko').text('');
        }
        if ($('#nik_ktp').val().length < 1) {
          $('#txt_nik_ktp').text('nik tidak boleh kosong');
        }else{
          $('#txt_nik_ktp').text('');
        }
        if ($('#phone').val().length < 1) {
          $('#txt_phone').text('no hp tidak boleh kosong');
        }else{
          $('#txt_phone').text('');
        }

        if ($('#provinsi').val().length < 1) {
          $('#txt_provinsi').text('Provinsi belum di pilih');
        }else{
          $('#txt_provinsi').text('');
        }
        
        if($('#name_arko').val().length > 1  && $('#nik_ktp').val().length > 1 && $('#phone').val().length > 1 && $('#provinsi').val().length > 0 ){
          $("#kirim_edit").click();
        }
      });
   })
</script>