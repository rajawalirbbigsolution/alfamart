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
</style>
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

                            <h3 class="card-title">Add Manifest</h3>

                        </div>

                        <form id="add-shipping" role="form" action="<?php echo base_url('Shipping/add_data_non_mtg') ?>" method="post" enctype="multipart/form-data" class="add-department" autocomplete="off">

                            <div class="card-body">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label>Kabupaten</label>
                                        <select class="form-control" name="kabupaten" id="kabupaten">
                                            <option value="0">-select-</option>
                                            <?php foreach ($kabupaten as $keb) { ?>
                                                <option><?php echo $keb->kabupaten; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-error" id="txt_kabupaten"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Kecamatan</label>
                                        <select class="form-control" name="kecamatan" id="kecamatan">
                                            <option value="0">-select-</option>
                                        </select>
                                        <span class="text-error" id="txt_kecamatan"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Kelurahan</label>
                                        <select class="form-control" name="kelurahan" id="kelurahan">
                                            <option value="0">-select-</option>
                                        </select>
                                        <span class="text-error" id="txt_kelurahan"></span>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label>Tanggal</label>
                                        <input name="date_shipping" id="date_shipping" type="text" class="form-control" readonly>
                                        <span class="text-error" id="txt_date_shipping"></span>
                                    </div>
                                    <div class="col-sm-4">
                                         <label>Name Driver</label>
                                        <p>
                                     <select class="form-control" name="name_driver" id="name_driver"  >
                                                <option ></option>
                                            </select>
                                        <!-- <label>Name Driver</label>
                                        <select class="form-control" name="name_driver" id="name_driver">
                                            <option value="0">-select-</option>
                                            <?php foreach ($driver as $key) { ?>
                                                <option value="<?php echo $key->id; ?>"><?php echo $key->name_driver; ?> (<?php echo $key->phone; ?>)</option>
                                            <?php } ?>
                                        </select> -->

                                        <span class="text-error" id="txt_name_driver"></span>
                                    </div>
                                    <div class="col-sm-4">
                                         <label>Name Warehouse</label>
                                             <select class="form-control" name="name_wh" id="name_wh" >
                                                <option ></option>
                                            </select>
                                        <!-- <label>Name Warehouse</label>
                                        <select class="form-control" name="name_wh" id="name_wh">
                                            <option value="0">-select-</option>
                                            <?php foreach ($wharehouse as $wh) { ?>
                                                <option value="<?php echo $wh->id; ?>"><?php echo $wh->name_warehouse; ?></option>
                                            <?php } ?>
                                        </select> -->
                                        <span class="text-error" id="txt_name_wh"></span>
                                    </div>
                                </div>


                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label>Name Expedisi</label>
                                        <select class="form-control" name="name_ex" id="name_ex">
                                            <option value="0">-select-</option>
                                            <?php foreach ($expedisi as $ex) { ?>
                                                <option value="<?php echo $ex->id; ?>"><?php echo $ex->name_expedisi; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-error" id="txt_name_ex"></span>
                                    </div>
                                    <div class="col-sm-4">
                                         <label>Name Truck</label>
                                        <p>
                                     <select class="form-control name_truck" name="name_truck" id="name_truck">
                                                <option></option>
                                            </select>
                                        <!-- <label>Name Truck</label>
                                        <select class="form-control" name="name_truck" id="name_truck">
                                            <option value="0">-select-</option>
                                            <?php foreach ($truck as $tk) { ?>
                                                <option value="<?php echo $tk->id; ?>"><?php echo $tk->no_police; ?> (kapasitas: <?php echo $tk->capacity; ?>)</option>
                                            <?php } ?>
                                        </select> -->
                                        <span class="text-error" id="txt_name_truck"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Kapasitas</label>
                                        <input type="text" name="qty" id="qty" class="form-control" placeholder="Kapasitas">
                                        <span class="text-error" id="txt_qty"></span>
                                    </div>
                                </div>
                                <p>
                                    <div class="row clearfix">
                                        <div class="col-sm-2">
                                            <a href="<?php echo base_url('Shipping') ?>" class="btn btn-danger" style="margin-left: 5px;">Back</a>

                                           <button type="button" class="btn bg-blue waves-effect" id="send">Save</button>
                                            <button type="submit" class="btn bg-blue waves-effect" style="display:none;" id="kirim">Save</button>
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

<script src="<?php echo base_url(); ?>assets/js-data/shipping/get-add.js" id="date" data-start="<?php echo date('d-m-Y', strtotime($start)); ?>" data-end="<?php echo date('d-m-Y', strtotime($end)); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
     $(function(){
        $("#date_shipping").datepicker({
              format: 'yyyy-mm-dd',
              startDate: new Date(),
              minDate:0,
              autoclose: true,
              todayHighlight: false,
          });
          
          
    });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.name_truck').select2({
                placeholder: 'pilih truck',
                minimumInputLength: 1,
                allowClear: true,
                ajax:{
                    url: "<?php echo base_url(); ?>/Shipping/searchTruck",
                    dataType: "json",
                    delay: 250,
                    data: function(params){

                        return{
                            booksClue: params.term
                        };
                    },
                    processResults: function(data){
                        var results = [];

                        $.each(data, function(index, item){
                            results.push({
                                id: item.id,
                                text: item.no_police+'( Kapasitas: '+item.capacity+')'
                            });
                        });
                        return{
                            results: results
                        };
                    }
                }
            });
        });
    </script>

     <script type="text/javascript">
        $(document).ready(function(){
            $('#name_driver').select2({
                placeholder: 'Pili Driver',
                minimumInputLength: 1,
                allowClear: true,
                ajax:{
                    url: "<?php echo base_url(); ?>/Shipping/searchDriver",
                    dataType: "json",
                    delay: 250,
                    data: function(params){

                        return{
                            booksClue: params.term
                        };
                    },
                    processResults: function(data){
                        var results = [];

                        $.each(data, function(index, item){
                            results.push({
                                id: item.id,
                                text: item.name_driver+'('+item.phone+')'
                            });
                        });
                        return{
                            results: results
                        };
                    }
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#name_wh').select2({
                placeholder: 'Pilih Warehouse',
                minimumInputLength: 1,
                allowClear: true,
                ajax:{
                    url: "<?php echo base_url(); ?>/Shipping/searchWarehouse",
                    dataType: "json",
                    delay: 250,
                    data: function(params){

                        return{
                            booksClue: params.term
                        };
                    },
                    processResults: function(data){
                        var results = [];

                        $.each(data, function(index, item){
                            results.push({
                                id: item.id,
                                text: item.name_warehouse
                            });
                        });
                        return{
                            results: results
                        };
                    }
                }
            });
        });
    </script>

<!-- <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" /> -->

<script>
    var loadFile = function(event) {

        var output = document.getElementById('output');

        output.src = URL.createObjectURL(event.target.files[0]);

    };
</script>



<script type="text/javascript">
    $(document).ready(function() {

        $("#add-shipping").submit(function(e) {
            if ($('#kabupaten').val() == '0' ||
                $('#kecamatan').val() == '0' ||
                $('#kelurahan').val() == '0' ||
                $('#name_driver').val() == '0' ||
                $('#name_truck').val() == '0' ||
                $('#name_ex').val() == '0') {
                return false;
            } else {
                $('#save').prop('disabled', true);
            }
        });

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

    $("#send").click(function() {
            
        if ($('#date_shipping').val() == '') {
            $('#txt_date_shipping').text('Tanggal tidak boleh kosong');
        } else {
            $('#txt_date_shipping').text('');
        }

        

        if ($('#kabupaten').val() < 1) {
            $('#txt_kabupaten').text('Kabupaten belum di pilih');
        } else {
            $('#txt_kabupaten').text('');
        }

        if ($('#kecamatan').val() < 1) {
            $('#txt_kecamatan').text('kecamatan belum di pilih');
        } else {
            $('#txt_kecamatan').text('');
        }

        if ($('#kelurahan').val() < 1) {
            $('#txt_kelurahan').text('kelurahan belum di pilih');
        } else {
            $('#txt_kelurahan').text('');
        }

      

        if ($('#name_wh').val() < 1) {
            $('#txt_name_wh').text('Warehouse belum di pilih');
        } else {
            $('#txt_name_wh').text('');
        }

        if ($('#name_ex').val() < 1) {
            $('#txt_name_ex').text('Expedisi belum di pilih');
        } else {
            $('#txt_name_ex').text('');
        }

        if ($('#name_truck').val() < 1) {
            $('#txt_name_truck').text('Truck belum di pilih');
        } else {
            $('#txt_name_truck').text('');
        }

        if ($('#name_driver').val() < 1) {
            $('#txt_name_driver').text('Driver belum di pilih');
        } else {
            $('#txt_name_driver').text('');
        }

        if ($('#qty').val().length < 1) {
            $('#txt_qty').text('qty tidak boleh kosong');
        } else {
            $('#txt_qty').text('');
        }

        if ($('#date_shipping').val().length > 0 &&
            
            $('#kabupaten').val() != 0 &&
            $('#kelurahan').val() != 0 &&
            $('#kecamatan').val() != 0 &&
            $('#name_wh').val() != 0 &&
            $('#name_ex').val() != 0 &&
            $('#name_truck').val() != 0 &&
            $('#name_driver').val() != 0 &&
            $('#qty').val().length > 0
        ) {
            $("#kirim").click();
        }else{
            alert('a');
        }
    });
</script>