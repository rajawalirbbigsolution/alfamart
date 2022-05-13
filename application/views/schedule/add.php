<link rel="stylesheet" href="<?php echo base_url(); ?>assets/kialap/style/order.css">

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

                <h3 class="card-title">Add Schedule</h3>

              </div>

				<form id="add-product" role="form" action="<?php echo base_url('Schedule/add_data') ?>" method="post" enctype="multipart/form-data" class="add-department" autocomplete="off">

					<div class="card-body">
                        <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label>Kabupaten</label>
                                    <select class="form-control" name="kabupaten">
                                        <option value="0">-select-</option>
                                        <?php foreach ($kabupaten as $keb) { ?>
                                            <option ><?php echo $keb->kabupaten;?></option>
                                        <?php } ?>                           
                                    </select>
                                    <small class="form-text text-muted"><?php echo form_error('kabupaten');  ?></small>
                                </div>
                                <div class="col-sm-4">
                                     <label>Kecamatan</label>
                                     <select class="form-control" name="kecamatan">
                                        <option value="0">-select-</option>
                                        <?php foreach ($kecamatan as $kec) { ?>
                                            <option ><?php echo $kec->kecamatan;?></option>
                                        <?php } ?>                           
                                    </select>
                                    <small class="form-text text-muted"><?php echo form_error('kecamatan');  ?></small>
                                </div>
                                <div class="col-sm-4">
                                    <label>Kelurahan</label>
                                    <select class="form-control" name="kelurahan">
                                        <option value="0">-select-</option>
                                        <?php foreach ($kelurahan as $kel) { ?>
                                            <option ><?php echo $kel->kelurahan;?></option>
                                        <?php } ?>                           
                                    </select>
                                    <small class="form-text text-muted"><?php echo form_error('kelurahan');  ?></small>
                                </div>
                            </div>
                             <div class="row clearfix">
                                <div class="col-sm-4">
                                     <label>RW</label>
                                     <input type="text" name="no_rw" class="form-control" placeholder="Rw">

                                    <small class="form-text text-muted"><?php echo form_error('no_rw');  ?></small>

                                </div>
                               <div class="col-sm-4">
                                    <label>RT</label>
                                    <input type="text" name="no_rt" class="form-control" placeholder="RT">

                                    <small class="form-text text-muted"><?php echo form_error('no_rt');  ?></small>
                                </div>
                                
                                <div class="col-sm-4">
                                     <label>QTY</label>
                                     <input type="text" name="qty" class="form-control" placeholder="Qty">

                                    <small class="form-text text-muted"><?php echo form_error('qty');  ?></small>

                                </div>
                            </div>

                            <div class="row clearfix">
                                
                                <div class="col-sm-6">
                                    <label>Korlap</label>
                                   <select class="form-control" name="name_korlap">
                                        <option value="0">-select-</option>
                                        <?php foreach ($korlap as $kor) { ?>
                                            <option value="<?php echo $kor->id;?>" ><?php echo $kor->name_korlap;?></option>
                                        <?php } ?>                           
                                    </select>
                                    <small class="form-text text-muted"><?php echo form_error('name_korlap');  ?></small>
                                </div>
                                <div class="col-sm-6">
                                    <label>Date</label>
                                    <input name="date_schedule" type="date" class="form-control" >
                                    <small class="form-text text-muted"><?php echo form_error('date_schedule');  ?></small>
                                </div>
                            </div>

                            


                            
                            
                            <p>
                             <div class="row clearfix">
                                <div class="col-sm-2">
                                    <a href="<?php echo base_url('Driver') ?>" class="btn btn-danger" style="margin-left: 5px;">Back</a>

                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
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

    $(document).ready(function(){

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