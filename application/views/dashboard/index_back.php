<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

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

    <div class="row mb-2">

      <div class="col-lg-2">

        <ol class="breadcrumb">

          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>

        </ol>

      </div>

      <div class="col-lg-10">

        <div class="row float-right">



        </div>

      </div>

    </div>

  </div>

</div>



<section class="content">

  <div class="container-fluid">

    <div class="row">

      <!-- <div class="col-md-12">

        <div class="card card-secondary card-outline card-outline-tabs">

          <div class="card-header p-0 border-bottom-0">

            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

              <li class="nav-item">

                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false"><i class="fas fa-city"></i></a>

              </li>







            </ul>

          </div>

          <div class="card-body">

            <div class="tab-content" id="custom-tabs-one-tabContent">

              <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                <div class="col-lg-12">

                  <div class="row">

                    <div class="col-md-3">

                      <div class="form-group">

                        <input type="text" class="form-control form-control-sm" id="code_manifest" name="code_manifest" placeholder="Parameter">

                      </div>

                    </div>

                    <div class="col-md-2">

                      <div class="form-group">

                        <select class="form-control form-control-sm" name="status" id="id_filter">

                          <option value="">--Filter--</option>

                          <option value="1">Code Manifest</option>
                          <option value="2">Kabupaten</option>
                          <option value="3">Kecamatan</option>
                          <option value="4">Kelurahan</option>
                          <option value="5">Korlap</option>
                          <option value="6">Driver</option>
                          <option value="7">Truck</option>





                        </select>

                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="row float-center">

                        <div class="col-md-4 col-6">

                          <div class="form-group">

                            <button type="submit" class="btn btn-custon-four btn-default btn-sm" id="filter-manifest">

                              <i class="fa fa-filter" aria-hidden="true"></i> Search

                            </button>

                          </div>

                        </div>



                      </div>

                    </div>

                  </div>

                </div>

              </div>


            </div>

          </div>

        </div>

       

      </div> -->

    </div>



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

    <div class="row">

      <div class="col-md-12">

        <div class="row">

          <div class="col-md-12">

            <div class="card">

              <div class="card-body p-0">

                <div class="table-responsive">
                  <div class="row clearfix">


                    <div class="col-sm-12">
                      <div class="container">
                        <h4 style="margin: 10px;">KINERJA PENYALURAN BANSOS BANPRES-TAHAP II</h4>
                       <div id="container" style="height: 400px"></div>
                      </div>

                    </div>



                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-12">
                      <h4 style="margin: 10px;"> ACHIEVEMENT PENGIRIMAN BANSOS BANPRES -TAHAP II</h4>
                      <table class="table">
                        <thead>
                          <tr>
                            <td><b>WILAYAH</b> </td>
                            <td align="right"><b>TARGET TEREALISASI</b> </td>
                            <td align="right"><b>PENGIRIMAN</b> </td>
                            <td align="right"><b>PENCAPAIAN</b></td>

                          </tr>
                        </thead>
                        <tbody>
                          <?php $no = 1; ?>
                          <?php $total_target1 = 0; ?>
                          <?php $total_kpm1 = 0; ?>
                          <?php foreach ($data_non_ok as $bansos1) { ?>
                            <tr>
                              <td><?php echo ($bansos1->kabupaten_target); ?></td>
                              <td align="right">
                                <?php if ($bansos1->target != null) {
                                  echo number_format($bansos1->target, 0);
                                } else {
                                  echo "0";
                                }

                                ?>


                              </td>
                              <td align="right">
                                <?php if ($bansos1->total != null) {
                                  echo number_format($bansos1->total, 0);
                                } else {
                                  echo "0";
                                }

                                ?>

                              </td>
                              <td align="right">
                                <?php if ($bansos1->total == null) {
                                  echo "0,0";
                                } else {
                                  echo number_format((($bansos1->total / $bansos1->target) * 100), 1);
                                }
                                ?>
                                %
                              </td>


                            </tr>
                            <?php $total_target1 +=  $bansos1->target; ?>
                            <?php $total_kpm1 +=  $bansos1->total; ?>
                            <?php $no++; ?>
                          <?php } ?>
                          <tr>
                            <td align="center"><b>Total</b></td>
                            <td align="right"><?php echo number_format($total_target1, 0); ?></td>
                            <td align="right"><?php echo number_format($total_kpm1, 0); ?></td>
                            <td align="right"><?php echo number_format((($total_kpm1 / $total_target1) * 100), 1); ?>%</td>

                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row clearfix">
                    <div class="col-sm-12">
                      <h4 style="margin: 10px;"> ACHIEVEMENT PER HARI</h4>
                      <table class="table">
                        <thead>
                          <tr>
                            <td><b>DATE</b> </td>
                            <!-- <?php foreach ($list_kabupaten as $kabupaten) { ?>
                              <td align="right"><b><?php echo $kabupaten->kabupaten ?></b></td>
                            <?php } ?> -->
                            <td align="right"><b>JKB</b></td>
                            <td align="right"><b>JKP</b></td>
                            <td align="right"><b>JKS</b></td>
                            <td align="right"><b>JKU</b></td>
                            <td align="right"><b>BKS</b></td>
                            <td align="right"><b>BGR</b></td>
                            <td align="right"><b>DPK</b></td>
                            <td align="right"><b>TGR</b></td>
                            <td align="right"><b>TGS</b></td>
                            <td align="right"><b>TOTAL</b></td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php $tph = 0;
                            foreach ($real_list as $key => $data) {
                              if ($key  % 10 == 0) {
                                if ($key != 0) { ?>
                                  <td align="right"><b><?php echo number_format($tph, 0, ",", ".") ?></b></td>
                                <?php } ?>
                          </tr>
                          <tr>
                            <td><?php echo $data ?></td>
                          <?php $tph = 0;
                              } else {
                                $tph += $data ?>
                            <td align="right"><?php echo number_format($data, 0, ",", ".") ?></td>
                        <?php }
                            } ?>
                        <td align="right"><b><?php echo number_format($tph, 0, ",", ".") ?></b></td>
                          </tr>
                          <tr>
                            <td><b>TOTAL</b></td>
                            <?php $sum_total = 0;
                            $sum_array = array();
                            foreach ($sum_list as $sum) {
                              $sum_total += $sum;
                              array_push($sum_array, $sum); ?>
                              <td align="right"><b><?php echo number_format($sum, 0, ",", ".") ?></b></td>
                            <?php }
                            array_push($sum_array, $sum_total); ?>
                            <td align="right"><b><?php echo number_format($sum_total, 0, ",", ".") ?></b></td>
                          </tr>
                          <tr>
                            <td><b>TARGET</b></td>
                            <?php $sum_target = 0;
                            $target_array = array();
                            foreach ($target_list as $target) {
                              $sum_target += $target->target;
                              array_push($target_array, $target->target); ?>
                              <td align="right"><b><?php echo number_format($target->target, 0, ",", ".") ?></b></td>
                            <?php }
                            array_push($target_array, $sum_target); ?>
                            <td align="right"><b><?php echo number_format($sum_target, 0, ",", ".") ?></b></td>
                          </tr>
                          <tr>
                            <td><b>ACHV %</b></td>
                            <?php for ($i = 0; $i < count($target_array); $i++) { ?>
                              <td align="right"><b><?php echo number_format($sum_array[$i] / $target_array[$i] * 100, 2, ",", ".") ?>%</b></td>
                            <?php } ?>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>



              </div>

            </div>

          </div>

        </div>

      </div>

    </div>



  </div>











</section>





<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>

<!-- <script src="<?php echo base_url(); ?>assets/js-data/manifest/get-index.js" id="date" data-start="<?php echo date('d-m-Y', strtotime($start)); ?>" data-end="<?php echo date('d-m-Y', strtotime($end)); ?>"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>


<script type="text/javascript">
  $(function () {
    $('#container').highcharts({
        chart: { type:'bar',
        },
        xAxis: {
            categories: [<?php
        if (!is_null($data_non_ok)) {
          foreach ($data_non_ok as $dt) {
            if ($dt->kabupaten_target == 'KOTA BEKASI') {
              $name_kab = 'BKS';
            } else if ($dt->kabupaten_target == 'BOGOR') {
              $name_kab = 'BGR';
            } else if ($dt->kabupaten_target == 'KOTA DEPOK') {
              $name_kab = 'DPK';
            } else if ($dt->kabupaten_target == 'KOTA TANGERANG') {
              $name_kab = 'TGR';
            } else if ($dt->kabupaten_target == 'KOTA TANGERANG SELATAN') {
              $name_kab = 'TGS';
            } else if ($dt->kabupaten_target == 'JAKARTA BARAT') {
              $name_kab = 'JKB';
            } else if ($dt->kabupaten_target == 'JAKARTA UTARA') {
              $name_kab = 'JKU';
            } else if ($dt->kabupaten_target == 'JAKARTA SELATAN') {
              $name_kab = 'JKS';
            } else if ($dt->kabupaten_target == 'JAKARTA PUSAT') {
              $name_kab = 'JKP';
            } else if ($dt->kabupaten_target == 'JAKARTA TIMUR') {
              $name_kab = 'JKT';
            } else {
            }

            echo "'" . $name_kab . "',";
          }
        }
        ?>]
        },
        
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    formatter:function() {
                        return this.point.t;
                    }
                }
            }
        },
        
        series: [ 

        {
         
          data: [
              {
            <?php
            if (!is_null($data_non_ok)) {
              foreach ($data_non_ok as $dt) {
                echo 'y:'.$dt->target.','.'t:"'.$dt->target. '",';
              }
            }
            ?>
         },
          {
            <?php
            if (!is_null($data_non_ok)) {
              foreach ($data_non_ok as $dt) {
                $value = 0;
                if($dt->total == null){
                     $value = 0;
                }else{
                   $value = $dt->total;
                }
                echo 'y:'.$value.','.'t:"'.$value. '",';
              }
            }
            ?>
         }
          ]
        }


        ]
    });
});
  
</script>

<!-- <script type="text/javascript">
  var ctx = document.getElementById('myChart-non').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
      labels: [
        <?php
        if (!is_null($data_non_ok)) {
          foreach ($data_non_ok as $dt) {
            if ($dt->kabupaten_target == 'KOTA BEKASI') {
              $name_kab = 'BKS';
            } else if ($dt->kabupaten_target == 'BOGOR') {
              $name_kab = 'BGR';
            } else if ($dt->kabupaten_target == 'KOTA DEPOK') {
              $name_kab = 'DPK';
            } else if ($dt->kabupaten_target == 'KOTA TANGERANG') {
              $name_kab = 'TGR';
            } else if ($dt->kabupaten_target == 'KOTA TANGERANG SELATAN') {
              $name_kab = 'TGS';
            } else if ($dt->kabupaten_target == 'JAKARTA BARAT') {
              $name_kab = 'JKB';
            } else if ($dt->kabupaten_target == 'JAKARTA UTARA') {
              $name_kab = 'JKU';
            } else if ($dt->kabupaten_target == 'JAKARTA SELATAN') {
              $name_kab = 'JKS';
            } else if ($dt->kabupaten_target == 'JAKARTA PUSAT') {
              $name_kab = 'JKP';
            } else if ($dt->kabupaten_target == 'JAKARTA TIMUR') {
              $name_kab = 'JKT';
            } else {
            }

            echo "'" . $name_kab . "',";
          }
        }
        ?>
      ],
      datasets: [

        {
          label: 'Target Terealisasi',
          backgroundColor: '#4169E1',
          borderColor: '##93C3D2',
          data: [
            <?php
            if (!is_null($data_non_ok)) {
              foreach ($data_non_ok as $dt) {
                echo $dt->target . ", ";
              }
            }
            ?>
          ]
        },
        {
          label: 'Pengiriman',
          backgroundColor: '#FF0000',
          borderColor: '#93C3D2',
          data: [
            <?php
            if (!is_null($data_non_ok)) {
              foreach ($data_non_ok as $dt) {
                echo $dt->total . ", ";
              }
            }
            ?>
          ]
        }


      ]
    },

  });


</script> -->
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

  });

  setTimeout(function() {
    $("div.alert").remove();
  }, 5000);
</script>