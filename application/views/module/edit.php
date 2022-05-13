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

              <h3 class="card-title">Edit Module</h3>

            </div>

            <form id="add-product" role="form" action="<?php echo base_url('Module/update') ?>" method="post" enctype="multipart/form-data" class="add-department" autocomplete="off">

              <div class="card-body">
                <p>



                  <div class="row">

                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                      <div class="input-mask-title">

                        <label>Nama Modul</label>

                      </div>

                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

                      <div class="input-mark-inner mg-b-22">

                        <input type="text" class="form-control" name="module_name" placeholder="Nama Modul" value="<?php echo $data->module_name; ?>">
                        <input type="hidden" name="id" value="<?php echo $data->id; ?>">

                        <small class="form-text text-muted"><?php echo form_error('module_name');  ?></small>

                      </div>

                    </div>

                  </div>

                  <p>
                    <div class="row">

                      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                        <div class="input-mask-title">

                          <label>Url Modul</label>

                        </div>

                      </div>

                      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

                        <div class="input-mark-inner mg-b-22">

                          <input name="module_url" type="text" class="form-control" value="<?php echo $data->module_url; ?>" placeholder="Url Module">

                          <small class="form-text text-muted"><?php echo form_error('module_url');  ?></small>

                        </div>

                      </div>

                    </div>
                    <br>

                    <div class="row">

                      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                        <div class="input-mask-title">

                          <label></label>

                        </div>

                      </div>

                      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

                        <div class="input-mark-inner mg-b-22">

                          <a href="<?php echo base_url('Module') ?>" class="btn btn-danger" style="margin-left: 5px;">Back</a>

                          <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>

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