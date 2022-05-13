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

	.select2-results__option {
		font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
		font-size: 15px;
		color: #495057;
	}

	.select2-selection__choice {
		font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
		font-size: 15px;
		color: #495057;
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
							<h3 class="card-title">Edit Expedition</h3>
						</div>
						<form id="add-product" action="<?php echo base_url('Expedition/update') ?>" method="post" enctype="multipart/form-data" class="add-department" autocomplete="off">
							<div class="card-body">
								<div class="row">
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<div class="input-mark-inner mg-b-22"><input type="hidden" class="form-control" name="id" value="<?php echo $data[0]->id; ?>" /> </div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<div class="input-mask-title"> <label>Name Expedition</label> </div>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<div class="input-mark-inner mg-b-22"> <input name="name_expedition" type="text" class="form-control" placeholder="Name Expedition" value="<?php echo $data[0]->expedition; ?>" maxlength="120"> <small class="form-text text-muted"><?php echo form_error('name_expedition');  ?></small> </div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
									<div class="input-mask-title"> <label>Provinsi</label> </div>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<div class="input-mark-inner mg-b-22">
											<select name="provinsi_name[]" class="js-example-basic-multiple form-control" multiple="multiple" id="provinsi_name">
                                            	<?php foreach($list_provinsi as $provinsi):?>
                                            		<?php foreach($list_selectprovisni as $pr):?>
                                            		<option value="<?= $provinsi->provinsi?>" 
                                                        <?php if ($pr == $provinsi->provinsi) : ?> selected <?php endif; ?>
                                            		<?php endforeach; ?>>
                                            			<?= $provinsi->provinsi?> </option>
                                            	<?php endforeach; ?>
                                    		</select>
											 <span class="text-error" id="txt_provinsi"></span>
										</div>
									</div>
								</div>
								
								<br>
								<div class="row">
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										<div class="input-mask-title"> <label></label> </div>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
										<div class="input-mark-inner mg-b-22"> 
											<a href="<?php echo base_url('Expedition') ?>" class="btn btn-danger" style="margin-left: 5px;">Cancel</a>
											 <button type="button" class="btn bg-blue waves-effect"  id="send_edit">Update
											 </button>
											<button type="submit" style="display: none;" id="kirim_edit" class="btn btn-primary waves-effect waves-light">
												Update
											</button>
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
	</section>
</div>	
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/testing/plugins/select2/js/select2.min.js?>"></script>

<script>
	var loadFile = function(event) {
		var output = document.getElementById('output');
		output.src = URL.createObjectURL(event.target.files[0]);
	};
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2();
		 $("#send_edit").click(function(){
	        if ($('#provinsi_name').val() < 1) {
	          $('#txt_provinsi').text('Provinsi tidak boleh kosong');
	        }else{
	          $('#txt_provinsi').text('');
	        }
	        
	        if($('#provinsi_name').val().length > 0){
	          $("#kirim_edit").click();
	        }
        });
	});
</script>