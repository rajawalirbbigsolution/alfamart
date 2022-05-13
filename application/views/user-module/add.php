<link rel="stylesheet" href="<?php echo base_url(); ?>assets/kialap/style/order.css">

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
	              		<h3 class="card-title">Add User Module</h3>
	            	</div>

    		        <form id="add-module" role="form" action="<?php echo base_url('UserModule/add_data') ?>" method="post" enctype="multipart/form-data" class="add-module" autocomplete="off">
			            <div class="card-body">

	                  	<p>
                    	<div class="row">
                      		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        		<div class="input-mask-title"><label>Role ID</label></div>
                      		</div>
                      		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        		<div class="input-mark-inner mg-b-22">
                        			<select class="form-control" name="role_id" id="role_form">
                                  		<option value="0">- select roleID -</option>
                                  		<?php foreach ($roleID as $key => $value) { ?>
                                   			<option value="<?php echo $value->id; ?>"><?php echo $value->role_name; ?></option>
                                  		<?php } ?>
                                	</select>
                          			<small class="form-text text-muted"><?php echo form_error('role_form');  ?></small>
                        		</div>
                      		</div>
                    	</div>
                    	
                    	<p>
                      	<div class="row">
                        	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                          		<div class="input-mask-title"><label>Module</label></div>
                        	</div>
                        	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                          		<div class="input-mark-inner mg-b-22" style="border:1px #cccccc solid;">
                          			<table class="table table-striped projects" id="data">

                  						<thead>
                          				<tr>
                          					<th>*</th>
                          					<th>Module Name</th>
                          					<th>Module URL</th>
                          				</tr>
                          				</thead>
                          				<?php foreach ($module as $key => $value) { ?>
                          				<tr>
                          					<td width="2%"><input type="checkbox" name="module_chk[]" value="<?php echo $value->id; ?>"></td>
                          					<td><?php echo $value->module_name; ?></td>
                          					<td><?php echo $value->module_url; ?></td>
                          				</tr>
                          				<?php } ?>
                          			</table>
                            		<small class="form-text text-muted"><?php echo form_error('module_name');  ?></small>
                          		</div>
                        	</div>
                      	</div>

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        	<div class="input-mark-inner mg-b-22">
                        <a href="<?php echo base_url('UserModule') ?>" class="btn btn-danger" style="margin-left: 5px;">Back</a>
	                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
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

</div><!-- /.container-fluid -->

</section>



<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/gijgo.min.js"></script>

<link href="<?php echo base_url(); ?>assets/css/gijgo.min.css" rel="stylesheet" type="text/css" />



<!-- <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" /> -->

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