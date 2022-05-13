<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">

<style>
    a.nav-link {

        color: #a5a5a5;

        text-decoration: none;

        background-color: transparent;

    }



    .card-secondary.card-outline-tabs>.card-header a.active {

        border-top: 3px solid #505254;

        color: #505254;

    }
</style>

<div class="content-header">

    <div class="container-fluid" style="margin-top: 8px;">

        <div class="row mb-3">

            <div class="col-lg-3">

                <ol class="breadcrumb">

                    <li class="breadcrumbs-joy"><a style="font-family: 'Source Sans Pro',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'; font-size: 32px;  font-weight: bold;" href="#"><?php echo $title; ?></a></li>

                </ol>

            </div>

            <div class="col-lg-9">

                <!-- <div class="row float-right">

                    <a href="<?php echo base_url('Role/add'); ?>">

                        <button type="button" class="btn btn-default btn-sm">

                            <i class="fa fa-add" aria-hidden="true"></i> Add Role

                        </button>

                    </a>

                </div> -->

            </div>

        </div>

    </div>

</div>



<section class="content">

    <div class="container-fluid">
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

        <!-- <div class="row">
            <div class="col-md-12">
                <div class="card card-secondary card-outline card-outline-tabs"> -->
        <!-- <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Status</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Pembayaran</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Wilayah</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Setting</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-uploads" role="tab" aria-controls="custom-tabs-one-uploads" aria-selected="false">Import</a>
              </li>
            </ul>
          </div> -->
        <!-- <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control form-control-sm" id="name_driver" name="name_driver" placeholder="Name Driver">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-custon-four btn-default btn-sm" id="search-data-by-name-driver">
                                                <i class="fa fa-filter" aria-hidden="true"></i> Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
        <!-- </div> -->
        <!-- /.card -->
        <!-- </div>
        </div> -->
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="row">

                <div class="col-md-12">

                    <div class="card" style="padding:0.5vw">

                        <div class="card-body p-0 h5">
                            <div><h2>SYNCH TO SERVER<button id="btn-sync-server" class="btn btn-link"><i class="fa fa-refresh" aria-hidden="true"></i></button></h2></div>
                            <div>Driver<i id="stop-driver" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-driver" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-driver" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>Truck<i id="stop-truck" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-truck" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-truck" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>Queue<i id="stop-queue" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-queue" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-queue" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>BAST Pengiriman<i id="stop-bast" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-bast" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-bast" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>Zonasi<i id="stop-zonasi" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-zonasi" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-zonasi" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>

                            <div><h2>SYNCH FROM SERVER<button id="btn-sync-from-server" class="btn btn-link"><i class="fa fa-refresh" aria-hidden="true"></i></button></h2></div>
                            <div>Warehouse<i id="stop-from-warehouse" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-from-warehouse" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-from-warehouse" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>Warehouse Stock<i id="stop-from-stock" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-from-stock" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-from-stock" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>User<i id="stop-from-user" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-from-user" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-from-user" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>Arko<i id="stop-from-arko" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-from-arko" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-from-arko" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>Arko Area<i id="stop-from-area" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-from-area" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-from-area" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>Korlap<i id="stop-from-korlap" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-from-korlap" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-from-korlap" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>Driver<i id="stop-from-driver" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-from-driver" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-from-driver" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>Truck<i id="stop-from-truck" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-from-truck" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-from-truck" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>Queue<i id="stop-from-queue" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-from-queue" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-from-queue" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>BAST Pengiriman<i id="stop-from-bast" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-from-bast" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-from-bast" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>
                            <div>Zonasi<i id="stop-from-zonasi" class="fa fa-times" aria-hidden="true" style="color:red;display:none;"></i><i id="load-from-zonasi" class="fas fa-spinner fa-spin" style="display:none;"></i><i id="check-from-zonasi" class="fa fa-check" aria-hidden="true" style="color:green;display:none;"></i></div>

                            <!-- <div class="table-responsive">

                                <table class="table table-striped projects" id="data">

                                    <thead>

                                        <tr>

                                        <tr>

                                            <th data-field="id" class="no">No</th>

                                            <th data-field="module_name" data-editable="true" class="module_name">Role</th>

                                            <th data-field="created_date" data-editable="true" class="created_date">Tanggal Pembuatan</th>

                                            <th data-field="action">Action</th>

                                        </tr>

                                        </tr>

                                    </thead>

                                    <tbody></tbody>

                                </table>

                            </div>

                            <div class="card-tools text-center" id="pagination"></div> -->

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    </div>



    <div id="konfirmasi_hapus" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-close-area modal-close-df">

                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>

                </div>

                <div class="modal-body">

                    <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>

                    <h2>Warning</h2>

                    <div class="modal-body">
                        <b class="message"></b><br>
                    </div>


                </div>

                <div class="modal-footer">

                    <a class="btn btn-danger btn-ok" style="background-color: red;"> Yes</a>

                    <a class="btn btn-primary" data-dismiss="modal"> No</a>

                </div>

            </div>

        </div>

    </div>



    <div id="konfirmasi_cancel" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-close-area modal-close-df">

                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>

                </div>

                <div class="modal-body">

                    <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>

                    <h2>Peringatan</h2>

                    <p>

                        <span class="message" style="font-size: 18px;"></span>

                        <b class="action" style="margin-left: 5px; margin-right: 5px; font-size: 18px; color: red;"></b> order

                        <b class="name" style="margin-left: 5px; margin-right: 5px; font-size: 18px;"></b><span style="font-size: 18px;">?</span>

                </div>

                <div class="modal-footer">

                    <a class="btn btn-danger btn-ok" style="background-color: red;"> Ya</a>

                    <a class="btn btn-primary" data-dismiss="modal"> Tidak</a>

                </div>

            </div>

        </div>

    </div>



    <div id="konfirmasi_success" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-close-area modal-close-df">

                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>

                </div>

                <div class="modal-body">

                    <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>

                    <h2>Peringatan</h2>

                    <p>

                        <span class="message" style="font-size: 18px;"></span>

                        <b class="action" style="margin-left: 5px; margin-right: 5px; font-size: 18px; color: green;"></b>

                        <b class="name" style="margin-right: 5px; font-size: 18px;"></b><span style="font-size: 18px;">?</span>

                </div>

                <div class="modal-footer">

                    <a class="btn btn-danger btn-ok" style="background-color: red;"> Ya</a>

                    <a class="btn btn-primary" data-dismiss="modal"> Tidak</a>

                </div>

            </div>

        </div>

    </div>



</section>





<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/js-data/role/get-index.js" id="date" data-start="<?php echo date('d-m-Y', strtotime($start)); ?>" data-end="<?php echo date('d-m-Y', strtotime($end)); ?>"></script>

<script type="text/javascript">
    var $statusfilter = 0;
    $(document).ready(function() {
        $('.filterbtn').click(function() {
            if ($statusfilter == 0) {
                $('#formfilter').show(999);
                $statusfilter = 1;
            } else {
                $('#formfilter').hide(999);
                $statusfilter = 0;
            }
        });

        $('#konfirmasi_hapus').on('show.bs.modal', function(e) {
            var message = $(e.relatedTarget).data('message');
            $(e.currentTarget).find('.message').text(message);
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });

        $('#btn-sync-server').click(function() {
            toServerLoad();
            syncToDriver();
        });

        $('#btn-sync-from-server').click(function() {
            fromServerLoad();
            syncFromWarehouse();
        });

    });

    function toServerLoad() {
        $('#stop-driver').css('display', 'none');
        $('#stop-truck').css('display', 'none');
        $('#stop-queue').css('display', 'none');
        $('#stop-bast').css('display', 'none');
        $('#stop-zonasi').css('display', 'none');

        $('#load-driver').css('display', 'inline-block');
        $('#load-truck').css('display', 'inline-block');
        $('#load-queue').css('display', 'inline-block');
        $('#load-bast').css('display', 'inline-block');
        $('#load-zonasi').css('display', 'inline-block');

        $('#check-driver').css('display', 'none');
        $('#check-truck').css('display', 'none');
        $('#check-queue').css('display', 'none');
        $('#check-bast').css('display', 'none');
        $('#check-zonasi').css('display', 'none');
    }

    function fromServerLoad() {
        $('#stop-from-warehouse').css('display', 'none');
        $('#stop-from-stock').css('display', 'none');
        $('#stop-from-user').css('display', 'none');
        $('#stop-from-arko').css('display', 'none');
        $('#stop-from-area').css('display', 'none');
        $('#stop-from-korlap').css('display', 'none');
        $('#stop-from-driver').css('display', 'none');
        $('#stop-from-truck').css('display', 'none');
        $('#stop-from-queue').css('display', 'none');
        $('#stop-from-bast').css('display', 'none');
        $('#stop-from-zonasi').css('display', 'none');

        $('#load-from-warehouse').css('display', 'inline-block');
        $('#load-from-stock').css('display', 'inline-block');
        $('#load-from-user').css('display', 'inline-block');
        $('#load-from-arko').css('display', 'inline-block');
        $('#load-from-area').css('display', 'inline-block');
        $('#load-from-korlap').css('display', 'inline-block');
        $('#load-from-driver').css('display', 'inline-block');
        $('#load-from-truck').css('display', 'inline-block');
        $('#load-from-queue').css('display', 'inline-block');
        $('#load-from-bast').css('display', 'inline-block');
        $('#load-from-zonasi').css('display', 'inline-block');

        $('#check-from-warehouse').css('display', 'none');
        $('#check-from-stock').css('display', 'none');
        $('#check-from-user').css('display', 'none');
        $('#check-from-arko').css('display', 'none');
        $('#check-from-area').css('display', 'none');
        $('#check-from-korlap').css('display', 'none');
        $('#check-from-driver').css('display', 'none');
        $('#check-from-truck').css('display', 'none');
        $('#check-from-queue').css('display', 'none');
        $('#check-from-bast').css('display', 'none');
        $('#check-from-zonasi').css('display', 'none');
    }

    function syncToDriver() {
        $.get("<?php echo base_url('Synchronize/SyncToServer?table=0'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-driver').css('display', 'none');
                $('#check-driver').css('display', 'inline');
                syncToTruck();
            }
        });
    }

    function syncToTruck() {
        $.get("<?php echo base_url('Synchronize/SyncToServer?table=1'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-truck').css('display', 'none');
                $('#check-truck').css('display', 'inline');
                syncToQueue();
            }
        });
    }

    function syncToQueue() {
        $.get("<?php echo base_url('Synchronize/SyncToServer?table=2'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-queue').css('display', 'none');
                $('#check-queue').css('display', 'inline');
                syncToBast();
            }
        });
    }

    function syncToBast() {
        $.get("<?php echo base_url('Synchronize/SyncToServer?table=3'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-bast').css('display', 'none');
                $('#check-bast').css('display', 'inline');
                syncToZonasi();
            }
        });
    }

    function syncToZonasi() {
        $.get("<?php echo base_url('Synchronize/SyncToServer?table=4'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-zonasi').css('display', 'none');
                $('#check-zonasi').css('display', 'inline');
                syncToTime();
            }
        });
    }

    function syncToTime() {
        $.get("<?php echo base_url('Synchronize/doneToServer'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {}
        });
    }

    function syncFromWarehouse() {
        $.get("<?php echo base_url('Synchronize/SyncFromServer?table=0'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-from-warehouse').css('display', 'none');
                $('#check-from-warehouse').css('display', 'inline');
                syncFromTcWarehouse();
            }
        });
    }

    function syncFromTcWarehouse() {
        $.get("<?php echo base_url('Synchronize/SyncFromServer?table=1'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-from-stock').css('display', 'none');
                $('#check-from-stock').css('display', 'inline');
                syncFromUser();
            }
        });
    }

    function syncFromUser() {
        $.get("<?php echo base_url('Synchronize/SyncFromServer?table=2'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-from-user').css('display', 'none');
                $('#check-from-user').css('display', 'inline');
                syncFromArko();
            }
        });
    }

    function syncFromArko() {
        $.get("<?php echo base_url('Synchronize/SyncFromServer?table=3'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-from-arko').css('display', 'none');
                $('#check-from-arko').css('display', 'inline');
                syncFromArkoArea();
            }
        });
    }

    function syncFromArkoArea() {
        $.get("<?php echo base_url('Synchronize/SyncFromServer?table=4'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-from-area').css('display', 'none');
                $('#check-from-area').css('display', 'inline');
                syncFromArkoChild();
            }
        });
    }

    function syncFromArkoChild() {
        $.get("<?php echo base_url('Synchronize/SyncFromServer?table=5'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-from-korlap').css('display', 'none');
                $('#check-from-korlap').css('display', 'inline');
                syncFromDriver();
            }
        });
    }

    function syncFromDriver() {
        $.get("<?php echo base_url('Synchronize/SyncFromServer?table=6'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-from-driver').css('display', 'none');
                $('#check-from-driver').css('display', 'inline');
                syncFromTruck();
            }
        });
    }

    function syncFromTruck() {
        $.get("<?php echo base_url('Synchronize/SyncFromServer?table=7'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-from-truck').css('display', 'none');
                $('#check-from-truck').css('display', 'inline');
                syncFromQueue();
            }
        });
    }

    function syncFromQueue() {
        $.get("<?php echo base_url('Synchronize/SyncFromServer?table=8'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-from-queue').css('display', 'none');
                $('#check-from-queue').css('display', 'inline');
                syncFromBast();
            }
        });
    }

    function syncFromBast() {
        $.get("<?php echo base_url('Synchronize/SyncFromServer?table=9'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-from-bast').css('display', 'none');
                $('#check-from-bast').css('display', 'inline');
                syncFromZonasi();
            }
        });
    }

    function syncFromZonasi() {
        $.get("<?php echo base_url('Synchronize/SyncFromServer?table=10'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {
                $('#load-from-zonasi').css('display', 'none');
                $('#check-from-zonasi').css('display', 'inline');
                syncFromTime();
            }
        });
    }

    function syncFromTime() {
        $.get("<?php echo base_url('Synchronize/doneFromServer'); ?>", function(data, textStatus, jqXHR) {
            if (data == "DONE") {}
        });
    }

    setTimeout(function() {
        $("div.alert").remove();
    }, 5000);
</script>