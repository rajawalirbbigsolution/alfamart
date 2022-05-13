<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>integrated BAnsos Management System</title>
  <link rel="icon" href="<?php echo base_url(); ?>assets/image/bulok/logo_only.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="position: fixed; right: 0; left: 0; top: 0; z-index: 1030;">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown" id="get-list">
          <span class="nav-link" data-toggle="dropdown" href="#" id="bell-notification" style="cursor: pointer;">
            <i class="far fa-bell"></i>
            <a class="badge badge-warning navbar-badge" href="#" id="badge-notification" style="cursor: pointer;"></a>
          </span>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- <span class="dropdown-item dropdown-header"></span> -->
            <!-- <div class="dropdown-divider"></div> -->
            <div id="div_list">

            </div>
            <!-- <a href="#" class="dropdown-item" id="code_bast"> -->

            </a>

            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url('Notification'); ?>" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>

        <li class="nav-item dropdown" style="margin-right: 10px;">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <?php $this->load->library('session'); ?>
            <?php if ($this->uri->segment(1) == "Profile") {
              echo '<i class="fas fa-user mr-2 text-primary"></i> <span class="text-primary">' . $this->session->userdata('name') . '</span>';
            } else {
              echo '<i class="fas fa-user mr-2"></i>' . $this->session->userdata('name');
            }  ?>
          </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="border: 1px solid;">
            <a href="<?php echo base_url('Profile/') ?>" class="dropdown-item">
              Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url('Login/logout'); ?>" class="dropdown-item">
              Signout
            </a>
          </div>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(#000046, #1cb5e0); width: 220px; border-top-right-radius:50px; border-bottom-left-radius:25px; border: 0;">
      <!-- Brand Logo -->
      <a href="#" class="brand-link" style="background-color: #fff; width: 220px; border-top-right-radius:50px; border: 0; text-align:center;">
        <img src="<?php echo base_url(); ?>assets/image/bulok/logo_panjang.png" alt="AdminLTE Logo" height="50px" width="auto">
        <!--  <span class="brand-text font-weight-bold">Bansos Management</span><br> -->
      </a>
      <?php
      $role = $this->session->userdata('role');
      $menu_list = $this->session->userdata('menu');
      ?>
      <!-- Sidebar -->
      <br>
      <div class="sidebar">
        <!-- Sidebar Menu -->

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php $in_main_menu = 0;
            foreach ($menu_list as $menu) {
              if ($menu->is_parent == '1' && $menu->module_url != '') {
                if ($in_main_menu == 1) {
                  echo '</ul></li>';
                  $in_main_menu = 0;
                }
                echo '<li class="nav-item">
                <a href="' . base_url() . $menu->module_url . '" class="nav-link ' . ($this->uri->segment(1) == $menu->module_url ? 'active' : '') . '">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>' . $menu->module_name . '</p>
                </a>
              </li>';
              } else if ($menu->is_parent == '0') {
                $in_main_menu = 1;
                echo '<li class="nav-item">
                <a href="' . base_url() . $menu->module_url . '" class="nav-link ' . ($this->uri->segment(1) == $menu->module_url ? 'active' : '') . '">
                  <i class="far fa-circle nav-icon"></i>
                  <p>' . $menu->module_name . '</p>
                </a>
              </li>';
              } else {
                if ($in_main_menu == 1) {
                  echo '</ul></li>';
                  $in_main_menu = 0;
                }
                echo '<li class="nav-item has-treeview">
                <a href="' . base_url() . $menu->module_url . '" class="nav-link ' . ($this->uri->segment(1) == $menu->module_url ? 'active' : '') . '">
                  <i class="nav-icon fas fa-th"></i>
                  <p>' . $menu->module_name . '</p><i class="right fas fa-angle-left"></i>
                </a>
              <ul class="nav nav-treeview">';
              }
            } ?>
          </ul>

          <!-- end of Report -->
          <!-- /.sidebar-menu -->
      </div>

      <!-- /.sidebar -->
  </div>

  <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div id="overlay" style="display:none;">
      <div class="loader">Loading...</div>
      <!-- <div class="spinner"></div> -->
      <br />
      Loading...
    </div>
    <div style="border: 0; height:60px;"></div>
    <input type="hidden" name="userid" id="userid" value="<?php echo $this->session->userdata('role');?>">
    <?php $this->load->view($content); ?>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="#">Bansos Management</a></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 2.0.0
    </div>
  </footer>

  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <!-- <script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script> -->
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/testing/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery K<?php echo base_url(); ?>assets/testing/ob Chart -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/testing/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url(); ?>assets/testing/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/testing/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/testing/plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/testing/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

  <script>
    $(document).ready(function() {
      $('a.nav-link.active').closest('li.has-treeview').addClass('menu-open');
      $('a.nav-link.active').closest('a.nav-link').addClass('active');
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {

      function tampil_data_barang() {

        $.ajax({

          url: '<?php echo base_url() ?>Audit/notificationWeb',
          type: 'get',
          success: function(data) {

            $('#badge-notification').text(data);


          }
        });

        setInterval(function() {
          tampil_data_barang();
        }, 1800000);
      }


      $("#bell-notification").on('click', function() {
        $('#div_list').empty();

        $.ajax({

          url: '<?php echo base_url() ?>Audit/listNotificationWeb',
          type: "get",
          dataType: "json",
          success: function(response) {

            response.forEach(function(row) {
              var ket = '';
              if (row.minus == 1 && row.damage == 0) {
                ket = ' KURANG ';
              } else if (row.minus == 0 && row.damage == 1) {
                ket = ' RUSAK ';
              }

              $('#div_list').append('<div style="border-bottom: 1px solid #e9ecef;font-size:0.8rem;">' + row.code_bast + " " +
                row.kelurahan + " " +
                ket + row.difference + '</div>');

              //$('#code_bast').text(row.code_bast);
            });
          }
        });
      });
    });
  </script>

</body>

</html>