
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
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">

                <h3 class="profile-username text-center"><?php echo $profile[0]->name ?></h3>

                <p class="text-muted text-center"><?php echo $profile[0]->email ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item text-sm">
                    <?php echo $profile[0]->address ?></a>
                  </li>
                  <li class="list-group-item text-sm">
                    <b><i class="fas fa-phone"></i> Telepon</b> <a class="float-right"><?php echo $profile[0]->phone_number ?></a>
                  </li>
                  <li class="list-group-item text-primary text-sm">
                    <b class="text-success text-lg"><i class="fas fa-dollar-sign"></i> Saldo</b> <a class="float-right text-success text-lg" id="saldo_profile">Rp. <span class="saldo"><?php echo $profile[0]->saldo ?></span></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#topup" data-toggle="tab">TopUp</a></li>
                  <li class="nav-item"><a class="nav-link" href="#balancing_saldo" data-toggle="tab">Balancing Saldo</a></li>
                  <li class="nav-item"><a class="nav-link setting" href="#setting" data-toggle="tab">Setting</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">

                  <div class="active tab-pane" id="topup">
                    <div class="row" style="margin-bottom: 10px; margin-top: -10px;">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                          <select class="form-control form-control-sm select2bs4" style="width: 100%;" id="kolom_request_topup" name="kolom_request_topup">
                            <option value="req_id">Req Id</option>
                            <option value="nominal">Nominal</option>
                            <option value="bank">Bank</option>
                            <option value="no_rekening">No Rek</option>
                            <option value="atas_nama">A/N</option>
                            <option value="created_date">Created Date</option>
                            <option value="approve_date">Approve Date</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <input type="text" name="label_request_topup" id="label_request_topup" class="form-control form-control-sm float-right" placeholder="value">
                          <input type="text" name="label_date_request_topup" id="label_date_request_topup" class="form-control form-control-sm float-right" placeholder="value" style="display: none;">
                        </div>
                        <div class="col-md-2">
                          <button type="submit" class="btn btn-default btn-sm" id="submit_filter_request_topup">Search</button>
                        </div>
                      </div>
                      <div class="table-responsive">
                          <table class="table table-striped projects" id="all_data_request_topup">
                            <thead>
                            <tr>
                              <th>No</th>
                              <th>Req Id</th>
                              <th>Nominal</th>
                              <th>Bank</th>
                              <th>No Rek</th>
                              <th>A/N</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                          </table>
                      </div>

                      <div class="card-footer clearfix">
                        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-left" id="load_more_button_request_topup">Load More</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-left" id="load_more_button_request_topup_filter" style="display: none;">Load More</a>
                      </div>
                  </div>

                  <div class="tab-pane" id="balancing_saldo">
                    <div class="row" style="margin-bottom: 10px; margin-top: -10px;">
                        <div class="col-md-3"></div>
                        <div class="col-md-3" id="div_lain_label_date_balancing_saldo"></div>
                        <div class="col-md-3">
                          <select class="form-control form-control-sm select2bs4" style="width: 100%;" id="kolom_history_balancing" name="kolom_history_balancing">
                            <option value="Request Top Up">Request Top Up</option>
                            <option value="Top Up Admin">Top Up Admin</option>
                            <option value="Transaksi PPOB">Transaksi PPOB</option>
                            <option value="Transfer Saldo">Transfer Saldo</option>
                            <option value="created_date">Date</option>
                          </select>
                        </div>
                        <div class="col-md-4" id="div_label_date_balancing_saldo" style="display: none;">
                          <input type="text" name="label_date_balancing_saldo" id="label_date_balancing_saldo" class="form-control form-control-sm float-right" placeholder="value">
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-default btn-sm" id="submit_filter_balancing_saldo">Search</button>
                        </div>
                      </div>
                      <div class="table-responsive">
                          <table class="table table-striped projects" id="all_data_balancing_saldo">
                            <thead>
                            <tr>
                              <th>No</th>
                              <th>Action</th>
                              <th>Before</th>
                              <th>After</th>
                              <th>Created By</th>
                              <th>Date</th>
                              <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                          </table>
                      </div>

                      <div class="card-footer clearfix">
                        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-left" id="load_more_button_balancing_saldo">Load More</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-left" id="load_more_button_balancing_saldo_filter" style="display: none;">Load More</a>
                      </div>
                  </div>

                  <div class="tab-pane" id="setting">
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
                          <label for="inputName" class="col-form-label">Email</label>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Email" readonly="readonly" value="<?php echo $profile[0]->email ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label for="inputName" class="col-form-label">Phone</label>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="Phone" readonly="readonly" value="<?php echo $profile[0]->phone_number ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label for="inputName" class="col-form-label">Address</label>
                        </div>
                        <div class="col-md-10">
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <textarea class="form-control form-control-sm" id="address" name="address" placeholder="Address" readonly="readonly"><?php echo $profile[0]->address ?></textarea>
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
