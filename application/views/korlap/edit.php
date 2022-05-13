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
							<h3 class="card-title">Edit Korlap</h3>
						</div>
						<form id="add-product" action="<?php echo base_url('Korlap/update') ?>" method="post" enctype="multipart/form-data" class="add-department" autocomplete="off">
							<div class="card-body">
								<p>
									
									<p>
										<div class="row">
											<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
												<div class="input-mask-title"> <label>NIK</label> </div>
											</div>
											<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
												<div class="input-mark-inner mg-b-22"> <input name="nik_ktp" type="text" class="form-control" placeholder="NIK" value="<?php echo $data[0]->nik_ktp; ?>"> <small class="form-text text-muted"><?php echo form_error('nik_ktp');  ?></small> </div>
												<div class="input-mark-inner mg-b-22"> <input name="area_korlap" type="hidden" class="form-control" placeholder="Area Koordinator" value="0"> <small class="form-text text-muted"><?php echo form_error('area_korlap');  ?></small> </div>
										
											</div>
										</div>
										<p>
											<div class="row">
												<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
													<div class="input-mask-title"> <label>Korlap Name</label> </div>
												</div>
												<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
													<div class="input-mark-inner mg-b-22"> <input name="name_korlap" type="text" class="form-control" placeholder="Korlap Name" value="<?php echo $data[0]->name_arko; ?>" maxlength="120"> <small class="form-text text-muted"><?php echo form_error('name_korlap');  ?></small> </div>
												</div>
											</div>
											<p>
												<div class="row">
													<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
														<div class="input-mask-title"> <label>Phone</label> </div>
													</div>
													<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
														<div class="input-mark-inner mg-b-22"> <input name="phone" type="text" class="form-control" placeholder="Phone" value="<?php echo $data[0]->phone; ?>"> </div>
													</div>
												</div>
												<p>
													<div class="row">
														<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
															<div class="input-mark-inner mg-b-22"><input type="hidden" class="form-control" name="id" value="<?php echo $data[0]->id; ?>" /> </div>
														</div>
													</div>
													<p>
														<p>
															<p><br>
																<div class="row">
																	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
																		<div class="input-mask-title"> <label></label> </div>
																	</div>
																	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
																		<div class="input-mark-inner mg-b-22"> <a href="<?php echo base_url('Truck') ?>" class="btn btn-danger" style="margin-left: 5px;">Cancel</a> <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button> </div>
																	</div>
																</div>
																<p>
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
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/gijgo.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/gijgo.min.css" rel="stylesheet" type="text/css" /><!-- <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" /> -->
<script>
	var loadFile = function(event) {
		var output = document.getElementById('output');
		output.src = URL.createObjectURL(event.target.files[0]);
	};
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#price_product').autoNumeric('init', {
			decimalCharacterAlternative: '&',
			aSep: '.',
			aDec: ',',
			aForm: true,
			vMax: '999999999',
			vMin: '-999999999'
		});
		$('#cogs').autoNumeric('init', {
			decimalCharacterAlternative: '&',
			aSep: '.',
			aDec: ',',
			aForm: true,
			vMax: '999999999',
			vMin: '-999999999'
		});
		$('#weight').autoNumeric('init', {
			decimalCharacterAlternative: '&',
			aSep: '.',
			aDec: ',',
			aForm: true,
			vMax: '9999',
			vMin: '-9999'
		});
		$('#stock').autoNumeric('init', {
			decimalCharacterAlternative: '&',
			aSep: '.',
			aDec: ',',
			aForm: true,
			vMax: '9999',
			vMin: '-9999'
		});
		$('#grosir').autoNumeric('init', {
			decimalCharacterAlternative: '&',
			aSep: '.',
			aDec: ',',
			aForm: true,
			vMax: '999999999',
			vMin: '-999999999'
		});
	});
</script>