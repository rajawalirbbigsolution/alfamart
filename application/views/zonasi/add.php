<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/kialap/style/order.css"> -->
<!--  <link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" /> -->
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
        font-size: 15px;
        color: #495057;
    }
    .select2-selection__choice{
        font-family: 'Source Sans Pro',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'; 
        font-size: 15px;
        color: #495057;   
    }
</style>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/testing/plugins/select2/js/select2.min.js?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->


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
        
        if($('#kabupaten').val().length > 1  && $('#kecamatan').val().length > 1 && $('#kelurahan').val().length > 1 && $('#warehouse').val().length > 0 && $('#priority').val() > 0 && $('#date_plan').val().length > 0 ){
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

                            <h3 class="card-title">Add Zonasi</h3>

                        </div>

                        <div class="card-body">
                            <form id="add-product" role="form" action="<?php echo base_url('Zonasi/add_data') ?>" method="post" enctype="multipart/form-data" class="add-department" autocomplete="off">
                                
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <label>Kabupaten</label>
                                         <select name="kabupaten" class="form-control" id="kabupaten">
                                            <option value="">-select-</option>
                                            <?php foreach ($list_kabupaten as $kabupaten) { ?>
                                                <option value="<?php echo $kabupaten->kabupaten ?>"><?php echo $kabupaten->kabupaten ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-error" id="txt_kabupaten"></span>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Kecamatan</label>
                                        <select name="kecamatan" class="form-control" id="kecamatan">
                                            <option value="">-select-</option>
                                        </select>
                                        <span class="text-error" id="txt_kecamatan"></span>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Kelurahan</label>
                                         <select name="kelurahan" id="kelurahan" class="form-control">
                                            <option value="">-select-</option>
                                        </select>
                                        <span class="text-error" id="txt_kelurahan"></span>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Warehouse</label>
                                         <select name="warehouse[]" class="js-example-basic-multiple form-control" multiple="multiple" id="warehouse">
                                            <?php foreach ($list_warehouse as $warehouse) { ?>
                                                <option  value="<?php echo $warehouse->code_warehouse ?>"><?php echo $warehouse->name_warehouse ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-error" id="txt_warehouse"></span>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Priority</label>
                                        <input  name="priority" id="priority" class="form-control">
                                        <span class="text-error" id="txt_priority"></span>
                                    </div>

                                    <div class="col-sm-3">
                                        <label>Date Plan</label>
                                        <input type="date" name="date_plan" id="date_plan" class="form-control">
                                        <span class="text-error" id="txt_date_plan"></span>
                                    </div>
                                </div>
                                
                                <p>
                                    <div class="row clearfix">
                                        <div class="col-sm-2">
                                            <a href="<?php echo base_url('Zonasi') ?>" class="btn btn-danger" style="margin-left: 5px;">Back</a>
                                            
                                            <button type="button" class="btn bg-blue waves-effect"  id="send_edit">Save</button>
                                            <button type="submit" class="btn bg-blue waves-effect" style="display:none;" id="kirim_edit">Save</button>
                                        </div>
                                    </div>
                                    <p>
                            </form>


                        </div>

                    </div>
                </div>
            </div>
        </div>
</div><!-- /.container-fluid -->

</section>

