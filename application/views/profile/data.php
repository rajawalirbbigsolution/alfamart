
    <div class="content-header" >
      <div class="container-fluid" style="margin-top: 7px;">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <?php echo $this->session->flashdata('notice'); ?>   
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active setting" href="#setting" data-toggle="tab">Setting</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">

                  <div class="active tab-pane" id="setting">
                    <form class="form-horizontal" id="quickForm" method="post" action="<?php echo base_url('Profile/update_profile') ?>">
                      <div class="row">
                        <div class="col-md-2">
                          <label for="inputName" class="col-form-label">Name</label>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Name" readonly="readonly" value="<?php echo $profile[0]->name ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label for="inputName" class="col-form-label">Role</label>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Email" readonly="readonly" value="<?php echo $profile[0]->role ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label for="inputName" class="col-form-label">Provinsi</label>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="Phone" readonly="readonly" value="<?php echo $profile[0]->province ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label for="inputName" class="col-form-label">Kota/Kabupaten</label>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <input type="text" class="form-control form-control-sm" readonly="readonly" value="<?php echo $profile[0]->city ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label for="inputName" class="col-form-label">Kecamatan</label>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <input type="text" class="form-control form-control-sm" readonly="readonly" value="<?php echo $profile[0]->district ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label for="inputName" class="col-form-label">Password</label>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label for="inputName" class="col-form-label">Re Password</label>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <input type="password" class="form-control form-control-sm" id="repassword" name="repassword" placeholder="RePassword"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger btn-sm">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>

                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <div class="modal fade" id="modal_setor_saldo" data-backdrop="static" data-keyboard="false">
        <form id="form-setor" method="post" action="">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Setor Saldo</h4>
              </div>
              <div class="modal-body">
                  <div class="text-center" style="margin-top: 40px; margin-bottom: 40px;" id="loading_dialog_saldo">
                    <div class="spinner-border" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </div>
                  <label class="col-md-12 title-header-setor-saldo text-center"></label>
                  <div class="row" id="layout_input" style="display: none;">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="saldo">Saldo</label>
                            <input type="text" name="saldo" class="form-control" id="saldo" readonly="readonly">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="setor">Setor</label>
                            <input type="text" name="setor" class="form-control" id="setor" placeholder="Setor" maxlength="10" readonly="readonly">
                        </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer footer-dialog-setor-saldo">
                <button type="button" class="btn btn-default btn-batal" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-ok">Kirim</button>
              </div>
          </div>
        </div>
        </form>
      </div>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">
  $(function () {

      var saldo = $('.saldo').text();
      $('.saldo').text(formatRupiah(saldo));      

      var offset_request_topup = 0;
      var limit_request_topup = 5;
      var linkurl_request_topup = "<?php echo site_url('Profile/load_data_topup');?>";

      loadDataRequestTopUp(1); 

      function loadDataRequestTopUp(action){
        $('#load_more_button_request_topup').html('Loading  . . . . . .');
        $.ajax({
          url: linkurl_request_topup,
          data : { limit : limit_request_topup, offset : offset_request_topup },
          type : "POST",
          dataType : "json",
          success : function(response) {
            rows = getCountRowRequestTopUp();
              if (response.data.length > 0) {
                  var html = '';
                  for (var i = 0; i < response.data.length; i++) {
                    rows += 1;
                    html = html + '<tr>';
                    html = html + '<td>' + rows + '</td>';
                    html = html + '<td><span class="text-black text-bold">'+ response.data[i]['req_id'] +'</span></td>';
                    html = html + '<td><span class="text-success">' + formatRupiah(response.data[i]['nominal']) + '</span></td>';
                    html = html + '<td>' + response.data[i]['bank'] + '</td>';
                    html = html + '<td>' + response.data[i]['no_rekening'] + '</td>';
                    html = html + '<td>' + response.data[i]['atas_nama'] + '</td>';
                    html = html + '</tr>';
                  };
                  $('#all_data_request_topup tbody').append(html);
                  $('#load_more_button_request_topup').html('Load More');
                  if (response.data.length == limit_request_topup) {
                      offset_request_topup = offset_request_topup + limit_request_topup;
                  }else{
                      offset_request_topup = offset_request_topup + response.data.length;
                  }
              }else{
                if (action == 1) {
                    $('#load_more_button_request_topup').html('Data is empty');
                }else{
                    if(getCountRowRequestTopUp() > 0){
                    	$('#load_more_button_request_topup').html('you at last data');
                    }else{
                    	$('#load_more_button_request_topup').html('Data is empty');
                    }
                }
              }
          },
          error: function (jqXHR, exception) {
            $('#load_more_button_request_topup').html(jqXHR.responseText);
          }
        });
      }

      function getCountRowRequestTopUp(){
        return $('#all_data_request_topup tbody tr').length;
      }

      $('#load_more_button_request_topup').on('click', function(e){
          loadDataRequestTopUp(2);
      });

      //////////////////////// Top Up Filter //////////////////////////////////////

      var offset_request_topup_filter = 0;
      var limit_request_topup_filter = 5;
      var linkurl_request_topup_filter = "<?php echo site_url('Profile/filter_data_topup');?>"; 

      $("#label_request_topup").autocomplete({
        source: function(request, response) {
          $.getJSON("searchTopUp", {term: $('#label_request_topup').val(), kolom_request_topup: $('#kolom_request_topup').val() }, 
                    response);
        },
          select: function (event, ui) {
              $('[name="label_request_topup"]').val(ui.item.label);
          }
      });

      $('#kolom_request_topup').on('change', function() {
          if (this.value == "created_date" || this.value == "approve_date") {
            $('#label_request_topup').hide();
            $('#label_date_request_topup').show();
            $('#label_date_request_topup').daterangepicker({
              opens: 'left',
              locale: {
                format: 'DD-MM-YYYY',
                separator: ' s/d ',
              }
            });
          }else{
            $('#label_request_topup').show();
            $('#label_date_request_topup').hide();
          }
      });

      $('#submit_filter_request_topup').on('click', function(e){
        $('#submit_filter_request_topup').prop('disabled', true);
        offset_request_topup_filter = 0;
        $('#load_more_button_request_topup').hide();
        $('#load_more_button_request_topup_filter').show();
        $('#all_data_request_topup tbody').empty();
        loadDataRequestTopUpFilter(1);
      });

      function loadDataRequestTopUpFilter(action){
        $('#load_more_button_request_topup').html('Loading  . . . . . .');
        var values = "";
        if ($('#kolom_request_topup').val() == 'created_date' || $('#kolom_request_topup').val() == 'approve_date') {
            values = $('#label_date_request_topup').val();
        }else{
            values = $('#label_request_topup').val();
        }

        $.ajax({
          url: linkurl_request_topup_filter,
          data : { column : $('#kolom_request_topup').val(), value : values, limit : limit_request_topup_filter, offset : offset_request_topup_filter },
          type : "POST",
          dataType : "json",
          success : function(response) {
            rows = getCountRowRequestTopUpFilter();
              if (response.data.length > 0) {
                  var html = '';
                  for (var i = 0; i < response.data.length; i++) {
                    rows += 1;
                    html = html + '<tr>';
                    html = html + '<td>' + rows + '</td>';
                    html = html + '<td><span class="text-black text-bold">'+ response.data[i]['req_id'] +'</span></td>';
                    html = html + '<td><span class="text-success">' + formatRupiah(response.data[i]['nominal']) + '</span></td>';
                    html = html + '<td>' + response.data[i]['no_rekening'] + '</td>';
                    html = html + '<td>' + response.data[i]['bank'] + '</td>';
                    html = html + '<td>' + response.data[i]['atas_nama'] + '</td>';
                    html = html + '</tr>';
                  };
                  $('#all_data_request_topup tbody').append(html);
                  $('#load_more_button_request_topup_filter').html('Load More');
                  if (response.data.length == limit_request_topup_filter) {
                      offset_request_topup_filter = offset_request_topup_filter + limit_request_topup_filter;
                  }else{
                      offset_request_topup_filter = offset_request_topup_filter + response.data.length;
                  }
              }else{
                if (action == 1) {
                    $('#load_more_button_request_topup_filter').html('Data is empty');
                }else{
                    if(getCountRowRequestTopUpFilter() > 0){
                    	$('#load_more_button_request_topup_filter').html('you at last data');
                    }else{
                    	$('#load_more_button_request_topup_filter').html('Data is empty');
                    }
                }
              }
              $('#submit_filter_request_topup').prop('disabled', false);
          },
          error: function (jqXHR, exception) {
            $('#load_more_button_request_topup_filter').html(jqXHR.responseText);
            $('#submit_filter_request_topup').prop('disabled', false);
          }
        });
      }

      function getCountRowRequestTopUpFilter(){
        return $('#all_data_request_topup tbody tr').length;
      }

      $('#load_more_button_request_topup_filter').on('click', function(e){
          loadDataRequestTopUpFilter(2);
      });

      ///////////////////////////////////////////////////////////////////////////////////////////////////

      var offset_balancing_saldo = 0;
      var limit_balancing_saldo = 4;
      var linkurl_balancing_saldo = "<?php echo site_url('Profile/load_data_history_balancing');?>";

      $('#kolom_history_balancing').on('change', function() {
            if (this.value == "created_date") {
              $('#div_lain_label_date_balancing_saldo').hide();
              $('#div_label_date_balancing_saldo').show();
              $('#label_date_balancing_saldo').daterangepicker({
                opens: 'left',
                locale: {
                  format: 'DD-MM-YYYY',
                  separator: ' s/d ',
                }
              });
            }else{
              $('#div_lain_label_date_balancing_saldo').show();
              $('#div_label_date_balancing_saldo').hide();
            }
      });

      loadDataBalancingSaldo(1); 

      function loadDataBalancingSaldo(action){
        $('#load_more_button_balancing_saldo').html('Loading  . . . . . .');
        $.ajax({
          url: linkurl_balancing_saldo,
          data : { limit : limit_balancing_saldo, offset : offset_balancing_saldo },
          type : "POST",
          dataType : "json",
          success : function(response) {
            rows = getCountRowBalancingSaldo();
              if (response.data.length > 0) {

                  var html = '';
                  for (var i = 0; i < response.data.length; i++) {
                    var buttonDetail = ""; 
                    if (response.data[i]['status'] == 1) {
                        buttonDetail = '<td class="project-actions text-right">'+
                                          '<a href="<?php echo base_url(); ?>RequestTopUp/view?id='+response.data[i]['relation_id']+'" class="btn btn-default btn-sm" style="margin-right: 5px;">'+
                                              '<i class="fas fa-share"></i>'+
                                          '</a>'+
                                      '</td>';
                    }else if (response.data[i]['status'] == 3){
                        buttonDetail = '<td class="project-actions text-right">'+
                                          '<a href="<?php echo base_url(); ?>Trnsaction/view?id='+response.data[i]['relation_id']+'" class="btn btn-default btn-sm" style="margin-right: 5px;">'+
                                              '<i class="fas fa-share"></i>'+
                                          '</a>'+
                                      '</td>';
                    }else{
                      buttonDetail = '<td class="project-actions text-right"></td>';
                    }

                    rows += 1;
                    html = html + '<tr>';
                    html = html + '<td>' + rows + '</td>';
          html = html + '<td><span class="text-black text-bold">'+ response.data[i]['status_name'] +'</span></td>';
                    html = html + '<td><span class="text-success">' + formatRupiah(response.data[i]['balancing_before']) + '</span></td>';
                    html = html + '<td><span class="text-success">' + formatRupiah(response.data[i]['balancing_after']) + '</span></td>';
                    html = html + '<td>' + response.data[i]['created_name'] + '</td>';
                    html = html + '<td>' + response.data[i]['created_date'] + '</td>';
                    html = html + buttonDetail + '</td>';
                    html = html + '</tr>';
                  };
                  $('#all_data_balancing_saldo tbody').append(html);
                  $('#load_more_button_balancing_saldo').html('Load More');
                  if (response.data.length == limit_balancing_saldo) {
                      offset_balancing_saldo = offset_balancing_saldo + limit_balancing_saldo;
                  }else{
                      offset_balancing_saldo = offset_balancing_saldo + response.data.length;
                  }
              }else{
                if (action == 1) {
                    $('#load_more_button_balancing_saldo').html('Data is empty');
                }else{
                    if(getCountRowBalancingSaldo() > 0){
                    	$('#load_more_button_balancing_saldo').html('you at last data');
                    }else{
                    	$('#load_more_button_balancing_saldo').html('Data is empty');
                    }
                }
              }
          },
          error: function (jqXHR, exception) {
            $('#load_more_button_balancing_saldo').html(jqXHR.responseText);
          }
        });
      }

      function getCountRowBalancingSaldo(){
        return $('#all_data_balancing_saldo tbody tr').length;
      }

      $('#load_more_button_balancing_saldo').on('click', function(e){
          loadDataBalancingSaldo(2);
      });

      ////////////////// filter balancing saldo /////////////////////////////////////////////////////////

      var offset_balancing_saldo_filter = 0;
      var limit_balancing_saldo_filter = 4;
      var linkurl_balancing_saldo_filter = "<?php echo site_url('Profile/load_data_history_balancing_filter');?>";

      $('#submit_filter_balancing_saldo').on('click', function(e){
        $('#submit_filter_balancing_saldo').prop('disabled', true);
        offset_balancing_saldo_filter = 0;
        $('#load_more_button_balancing_saldo').hide();
        $('#load_more_button_balancing_saldo_filter').show();
        $('#all_data_balancing_saldo tbody').empty();
        loadDataBalancingSaldoFilter(1);
      });

      function loadDataBalancingSaldoFilter(action){
        $('#load_more_button_balancing_saldo_filter').html('Loading  . . . . . .');
        $.ajax({
          url: linkurl_balancing_saldo_filter,
          data : { limit : limit_balancing_saldo_filter, offset : offset_balancing_saldo_filter, column : $('#kolom_history_balancing').val(), value : $('#label_date_balancing_saldo').val() },
          type : "POST",
          dataType : "json",
          success : function(response) {
            rows = getCountRowBalancingSaldoFilter();
              if (response.data.length > 0) {

                  var html = '';
                  for (var i = 0; i < response.data.length; i++) {
                    var buttonDetail = ""; 
                    if (response.data[i]['status'] == 1) {
                        buttonDetail = '<td class="project-actions text-right">'+
                                          '<a href="<?php echo base_url(); ?>RequestTopUp/view?id='+response.data[i]['relation_id']+'" class="btn btn-default btn-sm" style="margin-right: 5px;">'+
                                              '<i class="fas fa-share"></i>'+
                                          '</a>'+
                                      '</td>';
                    }else if (response.data[i]['status'] == 3){
                        buttonDetail = '<td class="project-actions text-right">'+
                                          '<a href="<?php echo base_url(); ?>Trnsaction/view?id='+response.data[i]['relation_id']+'" class="btn btn-default btn-sm" style="margin-right: 5px;">'+
                                              '<i class="fas fa-share"></i>'+
                                          '</a>'+
                                      '</td>';
                    }else{
                      buttonDetail = '<td class="project-actions text-right"></td>';
                    }

                    rows += 1;
                    html = html + '<tr>';
                    html = html + '<td>' + rows + '</td>';
                    html = html + '<td><span class="text-black text-bold">'+ response.data[i]['status_name'] +'</span></td>';
                    html = html + '<td><span class="text-success">' + formatRupiah(response.data[i]['balancing_before']) + '</span></td>';
                    html = html + '<td><span class="text-success">' + formatRupiah(response.data[i]['balancing_after']) + '</span></td>';
                    html = html + '<td>' + response.data[i]['created_name'] + '</td>';
                    html = html + '<td>' + response.data[i]['created_date'] + '</td>';
                    html = html + buttonDetail + '</td>';
                    html = html + '</tr>';
                  };
                  $('#all_data_balancing_saldo tbody').append(html);
                  $('#load_more_button_balancing_saldo_filter').html('Load More');
                  if (response.data.length == limit_balancing_saldo) {
                      offset_balancing_saldo_filter = offset_balancing_saldo_filter + limit_balancing_saldo_filter;
                  }else{
                      offset_balancing_saldo_filter = offset_balancing_saldo_filter + response.data.length;
                  }
              }else{
                if (action == 1) {
                    $('#load_more_button_balancing_saldo_filter').html('Data is empty');
                }else{
                    if(getCountRowBalancingSaldoFilter() > 0){
                    	$('#load_more_button_balancing_saldo_filter').html('you at last data');
                    }else{
                    	$('#load_more_button_balancing_saldo_filter').html('Data is empty');
                    }
                }
              }
              $('#submit_filter_balancing_saldo').prop('disabled', false);
          },
          error: function (jqXHR, exception) {
            $('#load_more_button_balancing_saldo_filter').html(jqXHR.responseText);
            $('#submit_filter_balancing_saldo').prop('disabled', false);
          }
        });
      }

      function getCountRowBalancingSaldoFilter(){
        return $('#all_data_balancing_saldo tbody tr').length;
      }

      $('#load_more_button_balancing_saldo_filter').on('click', function(e){
          loadDataBalancingSaldoFilter(2);
      });

      ///////////////////////////////////////////////////////////////////////////////////////////////////

      var offset_setor_saldo = 0;
      var limit_setor_saldo = 4;
      var linkurl_setor_saldo = "<?php echo site_url('Profile/load_data_deposit_balance');?>";

      $("#label_setor_saldo").autocomplete({
        source: function(request, response) {
          $.getJSON("searchDepositBalance", {term: $('#label_setor_saldo').val(), kolom_setor_saldo: $('#kolom_setor_saldo').val() }, 
                    response);
        },
          select: function (event, ui) {
              $('[name="label_setor_saldo"]').val(ui.item.label);
          }
      });

      $('#kolom_setor_saldo').on('change', function() {
            if (this.value == "created_date" || this.value == "approve_date") {
              $('#div_lain_label_setor_saldo').hide();
              $('#div_label_date_setor_saldo').show();
              $('#label_date_setor_saldo').daterangepicker({
                opens: 'left',
                locale: {
                  format: 'DD-MM-YYYY',
                  separator: ' s/d ',
                }
              });
            }else{
              $('#div_lain_label_setor_saldo').show();
              $('#div_label_date_setor_saldo').hide();
            }
      });

      loadDataSetorSaldo(1); 

      function loadDataSetorSaldo(action){
        $('#load_more_button_setor_saldo').html('Loading  . . . . . .');
        $.ajax({
          url: linkurl_setor_saldo,
          data : { limit : limit_setor_saldo, offset : offset_setor_saldo },
          type : "POST",
          dataType : "json",
          success : function(response) {
            rows = getCountRowSetorSaldo();
              if (response.data.length > 0) {
                  var html = '';
                  for (var i = 0; i < response.data.length; i++) {
                    var flag = "";
                    if (response.data[i]['flag'] == 0) {
                        flag = '<span class="badge badge-secondary text-white" title="Menunggu"><i class="fa fa-times fa-lg" style="margin-top: 2px;"></i></span>';
                    }else if (response.data[i]['flag'] == 1) {
                        flag = '<span class="badge badge-success text-white" title="Approve"><i class="fa fa-check"></i></span>';
                    }else{
                        flag = '<span class="badge badge-danger text-white" title="Reject"><i class="fa fa-times fa-lg" style="margin-top: 2px; "></i></span>';
                    }

                    var approve_date = "";
                    if (response.data[i]['approve_date'] == null || response.data[i]['approve_date'] == '0000-00-00 00:00:00') {
                        approve_date = "";
                    }else{
                        approve_date = response.data[i]['approve_date'];
                    }
                    rows += 1;
                    html = html + '<tr>';
                    html = html + '<td>' + rows + '</td>';
                    html = html + '<td>' + formatRupiah(response.data[i]['nominal']) + '</td>';
                    html = html + '<td>' + response.data[i]['created_date'] + '</td>';
                    html = html + '<td>' + flag + '</td>';
                    html = html + '<td>' + approve_date + '</td>';
                    html = html + '</tr>';
                  };
                  $('#all_data_setor_saldo tbody').append(html);
                  $('#load_more_button_setor_saldo').html('Load More');
                  if (response.data.length == limit_setor_saldo) {
                      offset_setor_saldo = offset_setor_saldo + limit_setor_saldo;
                  }else{
                      offset_setor_saldo = offset_setor_saldo + response.data.length;
                  }
              }else{
                if (action == 1) {
                    $('#load_more_button_setor_saldo').html('Data is empty');
                }else{
                    if(getCountRowSetorSaldo() > 0){
                    	$('#load_more_button_setor_saldo').html('you at last data');
                    }else{
                    	$('#load_more_button_setor_saldo').html('Data is empty');
                    }
                }
              }
          },
          error: function (jqXHR, exception) {
            $('#load_more_button_setor_saldo').html(jqXHR.responseText);
          }
        });
      }

      function getCountRowSetorSaldo(){
        return $('#all_data_setor_saldo tbody tr').length;
      }

      $('#load_more_button_setor_saldo').on('click', function(e){
          loadDataSetorSaldo(2);
      });

      ////////////////////////////////////fILTER SETOR SALDO//////////////////////////////////////////

      var offset_setor_saldo_filter = 0;
      var limit_setor_saldo_filter = 4;
      var linkurl_setor_saldo_filter = "<?php echo site_url('Profile/filter_load_data_deposit_balance');?>";

      $('#submit_filter_setor_saldo').on('click', function(e){
        $('#submit_filter_setor_saldo').prop('disabled', true);
        offset_setor_saldo_filter = 0;
        $('#load_more_button_setor_saldo').hide();
        $('#load_more_button_setor_saldo_filter').show();
        $('#all_data_setor_saldo tbody').empty();
        loadDataSetorSaldoFilter(1);
      });

      function loadDataSetorSaldoFilter(action){
        $('#load_more_button_setor_saldo').html('Loading  . . . . . .');
        var values = "";
        if ($('#kolom_setor_saldo').val() == 'created_date' || $('#kolom_setor_saldo').val() == 'approve_date') {
            values = $('#label_date_setor_saldo').val();
        }else{
            values = $('#label_setor_saldo').val();
        }

        $.ajax({
          url: linkurl_setor_saldo_filter,
          data : { column : $('#kolom_setor_saldo').val(), value : values, limit : limit_setor_saldo_filter, offset : offset_setor_saldo_filter },
          type : "POST",
          dataType : "json",
          success : function(response) {
            rows = getCountRowSetorSaldoFilter();
              if (response.data.length > 0) {
                  $('#submit_filter_setor_saldo').prop('disabled', false);
                  var html = '';
                  for (var i = 0; i < response.data.length; i++) {
                    var flag = "";
                    if (response.data[i]['flag'] == 0) {
                        flag = '<span class="badge badge-secondary text-white" title="Menunggu"><i class="fa fa-times fa-lg" style="margin-top: 2px;"></i></span>';
                    }else if (response.data[i]['flag'] == 1) {
                        flag = '<span class="badge badge-success text-white" title="Approve"><i class="fa fa-check"></i></span>';
                    }else{
                        flag = '<span class="badge badge-danger text-white" title="Reject"><i class="fa fa-times fa-lg" style="margin-top: 2px; "></i></span>';
                    }

                    var approve_date = "";
                    if (response.data[i]['approve_date'] == null || response.data[i]['approve_date'] == '0000-00-00 00:00:00') {
                        approve_date = "";
                    }else{
                        approve_date = response.data[i]['approve_date'];
                    }
                    rows += 1;
                    html = html + '<tr>';
                    html = html + '<td>' + rows + '</td>';
                    html = html + '<td>' + formatRupiah(response.data[i]['nominal']) + '</td>';
                    html = html + '<td>' + response.data[i]['created_date'] + '</td>';
                    html = html + '<td>' + flag + '</td>';
                    html = html + '<td>' + approve_date + '</td>';
                    html = html + '</tr>';
                  };
                  $('#all_data_setor_saldo tbody').append(html);
                  $('#load_more_button_setor_saldo_filter').html('Load More');
                  if (response.data.length == limit_setor_saldo_filter) {
                      offset_setor_saldo_filter = offset_setor_saldo_filter + limit_setor_saldo_filter;
                  }else{
                      offset_setor_saldo_filter = offset_setor_saldo_filter + response.data.length;
                  }
              }else{
                if (action == 1) {
                    $('#load_more_button_setor_saldo_filter').html('Data is empty');
                }else{
                    if(getCountRowSetorSaldoFilter() > 0){
                    	$('#load_more_button_setor_saldo_filter').html('you at last data');
                    }else{
                    	$('#load_more_button_setor_saldo_filter').html('Data is empty');
                    }
                }
              }
          },
          error: function (jqXHR, exception) {
            $('#load_more_button_setor_saldo_filter').html(jqXHR.responseText);
          }
        });
      }

      function getCountRowSetorSaldoFilter(){
        return $('#all_data_setor_saldo tbody tr').length;
      }

      $('#load_more_button_setor_saldo_filter').on('click', function(e){
          loadDataSetorSaldoFilter(2);
      });


      ////////////////////////////////////////////////////////////////////////////////////////////////////

      $('#quickForm').validate({
          rules: {
            password: {
              required: true,
              minlength: 6
            },
            repassword: {
              required: true,
              minlength: 6,
              equalTo: "#password"
            }

          },
          messages: {
            password: {
              required: "Please enter a password",
              minlength: "Your password min 6 characters long"
            },
            repassword: {
              required: "Please enter a re password",
              minlength: "Your re password min 6 characters long",
              equalTo: "Your re password not match with password"
            }
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
        });

      $('.setting').on('click', function(e){
           $(".form-group").find("span").remove(); 
           $(".form-group").find("input").removeClass('is-invalid');
      });

      ///////////////////////////////////////////////////////////////////////////////////////////////////

      $('#modal_setor_saldo').on('show.bs.modal', function(e) {
          $(e.currentTarget).find('.title-header-setor-saldo').hide();
          $(e.currentTarget).find('.btn-ok').hide();
          $(e.currentTarget).find('#layout_input').hide();
          $(e.currentTarget).find('#loading_dialog_saldo').fadeIn();
          $(".form-group").find("span").remove(); 
          $(".form-group").find("input").removeClass('is-invalid');

          $.ajax({
          url: '<?php echo site_url('Profile/saldo');?>',
          type : "GET",
          dataType : "json",
          success : function(response) {
            if(response.data.length > 0){
              if (response.data[0]['saldo'] > 0) {
                var totalSaldo = response.data[0]['saldo'];
                $('#saldo_profile').text("Rp. " + formatRupiah(totalSaldo));
                $(e.currentTarget).find('#saldo').val(formatRupiah(totalSaldo));
                $(e.currentTarget).find('#setor').val(formatRupiah(totalSaldo));

                $(e.currentTarget).find('#setor').keyup(function(){
                  var setoran = parseInt($(this).val().split('.').join(""));
                  if (setoran > totalSaldo) {
                      $(this).val("");
                  }else{
                      $(this).val(formatRupiah(setoran));
                  }
                });
                $(e.currentTarget).find('#loading_dialog_saldo').fadeOut();
                setTimeout(function(){ 
                  $(e.currentTarget).find('#layout_input').show();
                  $(e.currentTarget).find('.btn-ok').show(); 
                }, 700);
              }else{
                $(e.currentTarget).find('#loading_dialog_saldo').fadeOut();
                setTimeout(function(){ 
                  $(".title-header-setor-saldo").show();
                  $(".title-header-setor-saldo").text('Tidak ada saldo yang dapat disetorkan');
                }, 700);
              }
            }
            
          },
          error: function (jqXHR, exception) {
            
          }
        });

      });

      $('#modal_setor_saldo').on('hidden.bs.modal', function (e) {
          $(this)
            .find("input,textarea,select,label")
               .val('')
               .end()
            .find("input[type=checkbox], input[type=radio]")
               .prop("checked", "")
               .end();
        });

      ////////////////////////////////////////////////////////////////////////////

      $('#form-setor').validate({
        rules: {
          setor: {
            required: true
          }
        },
        messages: {
          setor: {
            required: "Please enter a nominal setor"
          }
        },
         submitHandler: function(form) {
             sendSetorSaldo();
         },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });

      function sendSetorSaldo(){
          $(".btn-ok").hide();
          $(".btn-batal").hide();
          $("#loading_dialog_saldo").fadeIn();
          $("#layout_input").hide();

          $.ajax({
            url: '<?php echo site_url('Profile/setor_saldo');?>',
            data : {setor : $('#setor').val().split('.').join("")},
            type : "POST",
            dataType : "json",
            success : function(response) {
              $("#loading_dialog_saldo").fadeOut();
              if (response.status == 200) {
                $('#saldo_profile').text("Rp. " + formatRupiah(response.saldo));
                $(".btn-batal").text('Selesai');
                $(".btn-batal").show();
                setTimeout(function(){ 
                  $(".title-header-setor-saldo").show();
                  $(".title-header-setor-saldo").text('Setor Saldo Berhasil');
                }, 700);
              }else{
                $(".btn-batal").text('Tutup');
                $(".btn-batal").show();
                setTimeout(function(){ 
                  $(".title-header-setor-saldo").show();
                  $(".title-header-setor-saldo").text('Setor Saldo GAGAL');
                }, 700);
              }
            },
            error: function (jqXHR, exception) {
              
            }
          });
      }

      function formatRupiah(bilangan){
          var number_string = bilangan.toString(),
          sisa  = number_string.length % 3,
          rupiah  = number_string.substr(0, sisa),
          ribuan  = number_string.substr(sisa).match(/\d{3}/g);
            
        if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }

        return rupiah;
      }
    
  })
</script>
