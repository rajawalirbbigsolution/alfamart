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
    
     .select2-results__option{
        font-family: 'Source Sans Pro',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'; 
        font-size: 1rem;
        color: #495057;
    }
    .select2-selection__choice{
        font-family: 'Source Sans Pro',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'; 
        font-size: 1rem;
        color: #495057;   
    }

</style>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/testing/plugins/select2/js/select2.min.js?>"></script>

<script type="text/javascript">

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $("#kabupaten").on('change', function() {
            param =
                "kabupaten=" +
                $("#kabupaten").val();
            $.ajax({
                url: '<?php echo base_url('Zonasi/getKecamatan'); ?>',
                type: "get",
                dataType: "json",
                data: param,
                success: function(response) {
                    $('#kecamatan').empty();
                    $('#kecamatan').append('<option value="0">-select-</option>');
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
                url: '<?php echo base_url('Zonasi/getKelurahan'); ?>',
                type: "get",
                dataType: "json",
                data: param,
                success: function(response) {
                    $('#kelurahan').empty();
                    $('#kelurahan').append('<option value="0">-select-</option>');
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

        if ($('#warehouse').val() < 1) {
          $('#txt_warehouse').text('warehouse tidak boleh kosong');
        }else{
          $('#txt_warehouse').text('');
        }
        if ($('#priority').val() < 1) {
          $('#txt_priority').text('priority tidak boleh kosong');
        }else{
          $('#txt_priority').text('');
        }
        if ($('#date_plan').val() < 1) {
          $('#txt_date_plan').text('Date Plan tidak boleh kosong');
        }else{
          $('#txt_date_plan').text('');
        }
        
        if($('#kabupaten').val().length > 1  && $('#kecamatan').val().length > 1 && $('#kelurahan').val().length > 1 && $('#warehouse').val().length > 1 ){
          $("#kirim_edit").click();
        }
      });

    })
</script>

<div class="section__content section__content--p30">
	<div class="container-fluid">
		<div class="row">
			<!--<br><br> -->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="breadcome-list single-page-breadcome shadow">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="breadcome-heading"> </div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<ul class="breadcome-menu"> </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- left column -->
				<div class="col-md-12">
					<!-- general form elements -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Edit Zonasi</h3>
						</div>
						<form id="add-product" action="<?php echo base_url('Zonasi/Update') ?>" method="post" enctype="multipart/form-data" class="add-department" autocomplete="off">
							<div class="card-body">
								<p>
								<div style="padding-bottom:10px">
	                                <div class="row clearfix">
	                                         <input type="hidden" name="id" class="form-control" value="<?php echo $data->id ?>" readonly>
	                                    <div class="col-sm-3">
	                                        <label>Kabupaten </label>
	                                        <input type="text" class="form-control" value="<?php echo $data->kabupaten ?>" readonly>
	                                   
	                                    </div>
	                                    <div class="col-sm-3">
	                                        <label> Kecamatan </label>
	                                        <input type="text" class="form-control" value="<?php echo $data->kecamatan ?>" readonly>
	                                   
	                                    </div>
	                                    <div class="col-sm-3">
	                                        <label> Kelurahan </label>
	                                        <input type="text" class="form-control" value="<?php echo $data->kelurahan ?>" readonly>
	                                    </div>
	                                    <div class="col-sm-3">
                                        <label>Warehouse</label>
                                         <select name="warehouse[]" class="js-example-basic-multiple form-control" multiple="multiple" id="warehouse">
                                            	<?php foreach($list_warehouse as $warehouse):?>
                                            		<?php foreach($list_selectwarehouse as $wa):?>
                                            		<option value="<?= $warehouse->code_warehouse?>" <?php if ($wa == $warehouse->code_warehouse) : ?> selected <?php endif; ?>
                                            		<?php endforeach; ?>>
                                            			<?= $warehouse->name_warehouse?> </option>
                                            	<?php endforeach; ?>
                                        </select>
                                        <span class="text-error" id="txt_warehouse"></span>
                                    	</div>
	                                    <div class="col-sm-3">
	                                        <label> Priority </label>
	                                        <input type="text" class="form-control" name="priority" value="<?php echo $data->priority?>" Required>
	                                    </div>
                                        <div class="col-sm-3">
                                            <label> Date Plan</label>
                                            <?php if (empty($data->date_plan)): ?>
                                                <input type="date" name="date_plan" id="date_plan" class="form-control" value="">    
                                            <?php else: ?>
                                            <?php $date = $data->date_plan; $newDate = date("Y-m-d", strtotime($date)); ?>
                                                <input type="date" name="date_plan" id="date_plan" class="form-control" value="<?php echo $newDate;?>">    
                                            <?php endif ?>
                                           
                                            <span class="text-error" id="txt_date_plan"></span>
                                        </div>    
	                                </div>
	                                <p>
	                                <div class="row clearfix">
                                        <div class="col-sm-2">
                                            <a href="<?php echo base_url('Zonasi') ?>" class="btn btn-danger" style="margin-left: 5px;">Back</a>
                                            
                                            <button type="submit" class="btn bg-blue waves-effect"  id="send_edit">Update</button>
                                        </div>
                                    </div>

                            	</div>

							</div>
						</form>
					</div> <!-- /.card -->
					<!-- /.card -->
				</div>
				<!--/.col (left) -->
				<!-- /.card -->
			</div>
			<!--/.col (right) -->
		</div> <!-- /.row -->
</div><!-- /.container-fluid -->
</section>