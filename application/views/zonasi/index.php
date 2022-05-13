<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
<style type="text/css">
  .txtedit {
    display: none;
    width: 98%;
  }
</style>
<style type="text/css">
  .table_zonasi td {
    padding: 0rem;

  }

  .editor {
    display: none;
  }

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

<div class="content-header">
  <div class="container-fluid" style="margin-top: 0px;">
    <div class="row mb-2">
      <div class="col-lg-4">
        <ol class="breadcrumb">
          <li class="breadcrumbs-joy"><a style="font-family: 'Source Sans Pro',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'; font-size: 32px;  font-weight: bold;" href="#"><?php echo $title; ?></a></li>
        </ol>
      </div>
      <div class="col-lg-8">
        <div class="row float-right">
          <a href="<?php echo base_url('Zonasi/addZonasi') ?>">
            <button type="button" class="btn btn-default btn-sm">
              <i class="fa fa-add" aria-hidden="true"></i> Add Zonasi
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary card-outline card-outline-tabs">
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <div class="col-lg-12">
                  <div class="row">

                    <div class="col-md-2">
                      <input type="text" class="form-control form-control-sm" id="code_manifest" name="code_manifest" placeholder="Parameter">
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <select class="form-control form-control-sm" name="status" id="id_filter">
                          <option value="">--Filter Lokasi--</option>
                          <?php if ($this->session->userdata('role') == "SUPER ADMIN") : ?>
                            <option value="1">Provinsi</option>
                          <?php endif ?>
                          <option value="2">Kabupaten</option>
                          <option value="3">Kecamatan</option>
                          <option value="4">Kelurahan</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <select class="form-control form-control-sm" name="status" id="id_filter_1">
                          <option value="">--Filter Gudang--</option>
                          <?php foreach ($warehouse as $row) : ?>
                            <option value="<?php echo $row->code_warehouse ?>"> <?php echo $row->code_warehouse ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="date" name="date_plan" class="form-control form-control-sm" id="id_filter_2">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <button type="submit" class="btn btn-custon-four btn-default btn-sm" id="filter-zonasi">
                        <i class="fa fa-filter" aria-hidden="true"></i> Search
                      </button>
                    </div>
                  </div>
                  <div class="row">
                    <a target="_blank" href="<?php echo base_url('Zonasi/downloadTemplateZonasi') ?>" class="btn btn-custon-four btn-default btn-sm">
                      <i class="fa fa-download" aria-hidden="true"></i> Template Import Excel
                    </a> &emsp;
                    <!-- <button data-toggle="modal" data-target="#modalimport" class="btn btn-custon-four btn-default btn-sm">
                      <i class="fa fa-upload" aria-hidden="true"></i> Import Zonasi
                    </button> -->
                    <a target="_blank" href="<?php echo base_url('Zonasi/importZonasi') ?>" class="btn btn-custon-four btn-default btn-sm">
                      <i class="fa fa-upload" aria-hidden="true"></i> Import Zonasi
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
    <?php echo $this->session->flashdata('notice'); ?>
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped projects table_zonasi" id="data">
                    <thead>
                      <tr>
                        <th data-field="id" class="no">No</th>
                        <th data-field="name" data-editable="true" class="kodefaskes">Dinkes</th>
                        <th data-field="name" data-editable="true" class="qty">Qty</th>
                        <th data-field="name" data-editable="true" class="provinsi">Provinsi</th>
                        <th data-field="name" data-editable="true" class="kabupaten">Kabupaten</th>
                        <th data-field="name" data-editable="true" class="kecamatan">Kecamatan</th>
                        <th data-field="name" data-editable="true" class="kelurahan">Kelurahan</th>
                        <th style="text-align:center" data-field="name" data-editable="true" class="priority">Priority*</th>
                        <th data-field="name" data-editable="true" class="warehouse">Warehouse*</th>
                        <th data-field="name" data-editable="true" class="warehouse">Date Plan</th>
                        <th data-field="action">Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
                <div class="card-tools text-center" id="pagination"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="modalimport" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-close-area modal-close-df">
            <a class="close" data-dismiss="modal" href="#" style="margin: 1rem 1rem 0 0;"><i class="fa fa-times"></i></a>
          </div>
          <div class="modal-body">
            <form method="POST" action="<?php echo base_url() ?>zonasi/upload" enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleInputEmail1">Import Master Zonasi</label>
                <input accept=".xlsx" type="file" name="file" class="form-control">
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Import</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <div id="konfirmasi_hapus" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-close-area modal-close-df">
            <a class="close" data-dismiss="modal" href="#" style="margin: 1rem 1rem 0 0;"><i class="fa fa-times"></i></a>
          </div>
          <div class="modal-body">
            <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>
            <h2>Warning</h2>
            <p style="font-size: 18px;">
              <span id="modal-message"></span><b id="modal-name"></b><span>?</span>
            </p>
          </div>
          <div class="modal-footer">
            <a class="btn btn-danger btn-ok" style="background-color: red; cursor:pointer;" id="hapus_data">Submit</a>
            <a class="btn btn-primary" style=" cursor:pointer;" data-dismiss="modal">Cancel</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_form" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">
              Upload Hasil PCR
            </h3>
          </div>
          <div class="modal-body form">
            <div class="table-responsive">
              <table class="table table-striped projects table_zonasi" id="datashow">
                <thead>
                  <tr>
                    <th data-field="id" class="no">No</th>
                    <th data-field="name" data-editable="true" class="kodefaskes">Nomor Requisition</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</section>
<input type="hidden" id="base" value="<?php echo base_url(); ?>">

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/testing/plugins/select2/js/select2.min.js?>"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootbox/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js-data/zonasi/get-index.js" id="date" data-start="<?php echo date('d-m-Y', strtotime($start)); ?>" data-end="<?php echo date('d-m-Y', strtotime($end)); ?>"></script>

<script type="text/javascript">
  var base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript">
  setTimeout(function() {
    $("div.alert").remove();
  }, 5000);
</script>