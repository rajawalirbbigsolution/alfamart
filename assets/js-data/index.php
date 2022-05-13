<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BANSOS | Dashboard</title>
  <link rel="icon" href="<?php echo base_url(); ?>assets/image/bulok/dnr-logo.png">
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
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>

      <!-- SEARCH FORM -->
      <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

      <!-- Right navbar links -->

      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> -->

        <!-- Notifications Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->

        <li class="nav-item dropdown" style="margin-right: 10px;">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <?php $this->load->library('session'); ?>
            <?php if ($this->uri->segment(1) == "Profile") {
              echo '<i class="fas fa-user mr-2 text-primary"></i> <span class="text-primary">' . $this->session->userdata('name') . '</span>';
            } else {
              echo '<i class="fas fa-user mr-2"></i>' . $this->session->userdata('name');
            }  ?>
          </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
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
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #264598; width: 220px;">
      <!-- Brand Logo -->
      <a href="#" class="brand-link" style="background-color: #264598;width: 220px;">

        <img src="<?php echo base_url(); ?>assets/image/bulok/Logo_bansos.png" alt="AdminLTE Logo" height="100%" width="100%">
        <!--  <span class="brand-text font-weight-bold">Bansos Management</span><br> -->

      </a>
      <?php $role = $this->session->userdata('role'); ?>
      <?php if ($role == 'ADMIN') { ?>
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

              <li class="nav-item">
                <a href="<?php echo base_url('Dashboard') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Dashboard") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    DASHBOARD
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('Order') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Order") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    DATA KPM JAKBAR
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('OrderNon') ?>" class="nav-link <?php if ($this->uri->segment(1) == "OrderNon") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    DATA KPM NON JAKBAR
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('Shipping') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Shipping") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Manifest Non JAKBAR
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('Manifest') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Manifest") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Manifest JAKBAR
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('DeleteManifest') ?>" class="nav-link <?php if ($this->uri->segment(1) == "DeleteManifest") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Delete Manifest
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('Schedule') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Schedule") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Schedule JAKBAR
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('ManifestKorlap') ?>" class="nav-link <?php if ($this->uri->segment(1) == "ManifestKorlap") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Manifest Korlap
                  </p>
                </a>
              </li>

             

              <li class="nav-item has-treeview <?php if ($this->uri->segment(1) == "Report" || $this->uri->segment(1) == "ReportNon" || $this->uri->segment(1) == "ReportCom") {
                                                  echo 'menu-open';
                                                } ?>">
                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == "Report" || $this->uri->segment(1) == "ReportNon" || $this->uri->segment(1) == "ReportCom") {
                                              echo 'active';
                                            } ?>">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Report
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                     <li class="nav-item">
                      <a href="<?php echo base_url('Report') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Report") echo 'active'; ?>">
                       <i class="far fa-circle nav-icon"></i>
                        <p>

                          Report Manifest Jakbar
                        </p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="<?php echo base_url('ReportNon') ?>" class="nav-link <?php if ($this->uri->segment(1) == "ReportNon") echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>

                          Report Manifest Non Jakbar
                        </p>
                      </a>
                    </li>

                     <li class="nav-item">
                      <a href="<?php echo base_url('ReportCom') ?>" class="nav-link <?php if ($this->uri->segment(1) == "ReportCom") echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>

                          Report Bast Complete
                        </p>
                      </a>
                    </li>
                </ul>
              </li>



              <li class="nav-item has-treeview <?php if ($this->uri->segment(1) == "Driver" || $this->uri->segment(1) == "Truck" || $this->uri->segment(1) == "Expedition" || $this->uri->segment(1) == "Warehouse" || $this->uri->segment(1) == "Korlap") {
                                                  echo 'menu-open';
                                                } ?>">
                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == "Driver" || $this->uri->segment(1) == "Truck" || $this->uri->segment(1) == "Expedition" || $this->uri->segment(1) == "Warehouse" || $this->uri->segment(1) == "Korlap") {
                                              echo 'active';
                                            } ?>">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Master
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="<?php echo base_url('Driver') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Driver") {
                                                                                  echo 'active';
                                                                                } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Driver</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('Truck') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Truck") {
                                                                                echo 'active';
                                                                              } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Truck</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('Warehouse') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Warehouse") {
                                                                                    echo 'active';
                                                                                  } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Warehouse</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo base_url('Expedition') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Expedition") {
                                                                                      echo 'active';
                                                                                    } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Expedition</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo base_url('Korlap') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Korlap") {
                                                                                  echo 'active';
                                                                                } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Koordinator</p>
                    </a>
                  </li>
                </ul>
              </li>


              <!--  <?php if ($this->session->userdata('role') == "CS") { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('Order_cs') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Order_cs") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie" ></i>
                  <p>
                    Order
                  </p>
                </a>
              </li>
          <?php } ?> -->

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>

      <?php } else if ($role == 'BULOG') { ?>
        <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="<?php echo base_url('Dashboard') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Dashboard") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    DASHBOARD
                  </p>
                </a>
              </li>

              <li class="nav-item has-treeview <?php if ($this->uri->segment(1) == "Report" || $this->uri->segment(1) == "ReportNon" || $this->uri->segment(1) == "ReportCom") {
                                                  echo 'menu-open';
                                                } ?>">
                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == "Report" || $this->uri->segment(1) == "ReportNon" || $this->uri->segment(1) == "ReportCom") {
                                              echo 'active';
                                            } ?>">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Report
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                     <li class="nav-item">
                      <a href="<?php echo base_url('Report') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Report") echo 'active'; ?>">
                       <i class="far fa-circle nav-icon"></i>
                        <p>

                          Report Manifest Jakbar
                        </p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="<?php echo base_url('ReportNon') ?>" class="nav-link <?php if ($this->uri->segment(1) == "ReportNon") echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>

                          Report Manifest Non Jakbar
                        </p>
                      </a>
                    </li>

                    
                </ul>
              </li>
          </nav>

          <!-- /.sidebar-menu -->
        </div>
      <?php } else if ($role == 'OPERATOR') { ?>
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


              <li class="nav-item">
                <a href="<?php echo base_url('Order') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Order") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    DATA KPM JAKBAR
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('OrderNon') ?>" class="nav-link <?php if ($this->uri->segment(1) == "OrderNon") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    DATA KPM NON JAKBAR
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('Shipping') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Shipping") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Manifest Non JAKBAR
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('Manifest') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Manifest") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Manifest JAKBAR
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('DeleteManifest') ?>" class="nav-link <?php if ($this->uri->segment(1) == "DeleteManifest") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Delete Manifest
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('Schedule') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Schedule") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Schedule JAKBAR
                  </p>
                </a>
              </li>



             <li class="nav-item has-treeview <?php if ($this->uri->segment(1) == "Report" || $this->uri->segment(1) == "ReportNon" || $this->uri->segment(1) == "ReportCom") {
                                                  echo 'menu-open';
                                                } ?>">
                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == "Report" || $this->uri->segment(1) == "ReportNon" || $this->uri->segment(1) == "ReportCom") {
                                              echo 'active';
                                            } ?>">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Report
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                     <li class="nav-item">
                      <a href="<?php echo base_url('Report') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Report") echo 'active'; ?>">
                       <i class="far fa-circle nav-icon"></i>
                        <p>

                          Report Manifest Jakbar
                        </p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="<?php echo base_url('ReportNon') ?>" class="nav-link <?php if ($this->uri->segment(1) == "ReportNon") echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>

                          Report Manifest Non Jakbar
                        </p>
                      </a>
                    </li>

                     <li class="nav-item">
                      <a href="<?php echo base_url('ReportCom') ?>" class="nav-link <?php if ($this->uri->segment(1) == "ReportCom") echo 'active'; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>

                          Report Bast Complete
                        </p>
                      </a>
                    </li>
                </ul>
              </li>



              <li class="nav-item has-treeview <?php if ($this->uri->segment(1) == "Driver" || $this->uri->segment(1) == "Truck" || $this->uri->segment(1) == "Expedition" || $this->uri->segment(1) == "Warehouse" || $this->uri->segment(1) == "Korlap") {
                                                  echo 'menu-open';
                                                } ?>">
                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == "Driver" || $this->uri->segment(1) == "Truck" || $this->uri->segment(1) == "Expedition" || $this->uri->segment(1) == "Warehouse" || $this->uri->segment(1) == "Korlap") {
                                              echo 'active';
                                            } ?>">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Master
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="<?php echo base_url('Driver') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Driver") {
                                                                                  echo 'active';
                                                                                } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Driver</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('Truck') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Truck") {
                                                                                echo 'active';
                                                                              } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Truck</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('Warehouse') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Warehouse") {
                                                                                    echo 'active';
                                                                                  } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Warehouse</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo base_url('Expedition') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Expedition") {
                                                                                      echo 'active';
                                                                                    } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Expedition</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo base_url('Korlap') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Korlap") {
                                                                                  echo 'active';
                                                                                } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Koordinator</p>
                    </a>
                  </li>
                </ul>
              </li>


              <!--  <?php if ($this->session->userdata('role') == "CS") { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('Order_cs') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Order_cs") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie" ></i>
                  <p>
                    Order
                  </p>
                </a>
              </li>
          <?php } ?> -->

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>


      <?php } else if ($role == 'ENTRY') { ?>
        <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="<?php echo base_url('Shipping') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Shipping") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Manifest Non JAKBAR
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('Manifest') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Manifest") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Manifest JAKBAR
                  </p>
                </a>
              </li>

              <li class="nav-item has-treeview <?php if ($this->uri->segment(1) == "Driver" || $this->uri->segment(1) == "Truck" || $this->uri->segment(1) == "Expedition" || $this->uri->segment(1) == "Warehouse" || $this->uri->segment(1) == "Korlap") {
                                                  echo 'menu-open';
                                                } ?>">
                <a href="#" class="nav-link <?php if ($this->uri->segment(1) == "Driver" || $this->uri->segment(1) == "Truck" || $this->uri->segment(1) == "Expedition" || $this->uri->segment(1) == "Warehouse" || $this->uri->segment(1) == "Korlap") {
                                              echo 'active';
                                            } ?>">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Master
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="<?php echo base_url('Driver') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Driver") {
                                                                                  echo 'active';
                                                                                } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Driver</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('Truck') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Truck") {
                                                                                echo 'active';
                                                                              } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Truck</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('Warehouse') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Warehouse") {
                                                                                    echo 'active';
                                                                                  } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Warehouse</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo base_url('Expedition') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Expedition") {
                                                                                      echo 'active';
                                                                                    } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Expedition</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo base_url('Korlap') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Korlap") {
                                                                                  echo 'active';
                                                                                } ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Koordinator</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>

      <?php } else if ($role == 'KEMENSOS') { ?>
      
           <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="<?php echo base_url('Dashboard') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Dashboard") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    DASHBOARD
                  </p>
                </a>
              </li>

            </ul>
          </nav>

          <!-- /.sidebar-menu -->
        </div>
      <?php } else { ?>
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



              <li class="nav-item">
                <a href="<?php echo base_url('ManifestKorlap') ?>" class="nav-link <?php if ($this->uri->segment(1) == "ManifestKorlap") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Manifest Korlap
                  </p>
                </a>
              </li>






              <!--  <?php if ($this->session->userdata('role') == "CS") { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('Order_cs') ?>" class="nav-link <?php if ($this->uri->segment(1) == "Order_cs") echo 'active'; ?>">
                  <i class="nav-icon fas fa-chart-pie" ></i>
                  <p>
                    Order
                  </p>
                </a>
              </li>
          <?php } ?> -->

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      <?php } ?>

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
      <?php $this->load->view($content); ?>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020 <a href="#">Bansos Management</a></strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.1
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
</body>

</html>