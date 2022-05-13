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
                  <div class="row clearfix" style="margin-bottom: 1rem;">


                    <div class="col-sm-12">
                      <div class="col-md-12">
                          <div class="container">
                            <h4 style="margin: 10px;">KINERJA PENYALURAN BANSOS BANPRES-TAHAP II</h4>
                            <canvas id="myChart-non" style="min-height:542px;max-height:542px;"></canvas>
                          </div>
                      </div>
                      

                    </div>
                     <!-- <div class="col-sm-6">
                        <?php
 
                        $dataPoints = array( 
                          array("label"=>"Chrome", "y"=>64.02),
                          array("label"=>"Firefox", "y"=>12.55),
                          array("label"=>"IE", "y"=>8.47),
                          array("label"=>"Safari", "y"=>6.08),
                          array("label"=>"Edge", "y"=>4.29),
                          array("label"=>"Others", "y"=>4.59)
                        )
                         
                        ?>
                      <div class="col-md-12">
                          <div class="container">
                            <h4 style="margin: 10px;">KINERJA PENYALURAN BANSOS BANPRES-TAHAP II</h4>
                            <div id="chartContainer" style="min-height:542px;max-height:542px;"></div>
                          </div>
                      </div>
                     </div> -->

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
                          <?php $total_total = 0; ?>
                          <?php $total_target = 0; ?>
                          <?php $data_pie = array(); ?>
                          <?php foreach ($data_target_total as $target_total) { ?>
                            <tr>
                              <td><?php echo ($target_total->kabupaten_target); ?></td>
                              <td align="right">
                                <?php echo number_format($target_total->target, 0, ",", "."); ?>
                              </td>
                              <td align="right">
                                <?php echo number_format($target_total->total, 0, ",", "."); ?>
                              </td>
                              <td align="right">
                                <?php echo number_format((($target_total->total / $target_total->target) * 100), 2); ?>%
                              </td>


                            </tr>
                            <?php $total_target +=  $target_total->target; ?>
                            <?php $total_total +=  $target_total->total; ?>
                             <?php   $data_pie[] = (object) ['label' => $target_total->kabupaten_target,'y' => $target_total->total ]; ?>
                          <?php } ?>
                          <tr>
                            <td align="center"><b>Total</b></td>
                            <td align="right"><?php echo number_format($total_target, 0, ",", "."); ?></td>
                            <td align="right"><?php echo number_format($total_total, 0, ",", "."); ?></td>
                            <td align="right"><?php echo number_format((($total_total / $total_target) * 100), 2, ",", "."); ?>%</td>

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

                  <div class="row clearfix">
                    <div class="col-sm-12">
                      <h4 style="margin: 10px;"> ACHIVEMENT TRUCK & RIT PER HARI</h4>
                      <table class="table">
                        <thead>
                          <tr>
                            <td><b>TANGGAL</b> </td>
                            <td><b>TRUCK, RIT, & KPM</b> </td>
                            <td align="center"><b>JKB</b></td>
                            <td align="center"><b>JKP</b></td>
                            <td align="center"><b>JKS</b></td>
                            <td align="center"><b>JKU</b></td>
                            <td align="center"><b>BKS</b></td>
                            <td align="center"><b>BGR</b></td>
                            <td align="center"><b>DPK</b></td>
                            <td align="center"><b>TGR</b></td>
                            <td align="center"><b>TGS</b></td>
                            <td align="center"><b>TOTAL</b></td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($truck_rit as $trit) { ?>
                            <tr>
                              <td rowspan="3"><?php echo $trit['date_manifest'] ?></td>
                              <td>Truk</td>
                              <td align="right"><?php echo number_format($trit['row'][0]['truck'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][1]['truck'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][2]['truck'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][3]['truck'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][4]['truck'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][5]['truck'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][6]['truck'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][7]['truck'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][8]['truck'], 0, ",", ".") ?></td>
                              <td align="right"><b><?php echo number_format($trit['row'][0]['truck'] +
                                                      $trit['row'][1]['truck'] +
                                                      $trit['row'][2]['truck'] +
                                                      $trit['row'][3]['truck'] +
                                                      $trit['row'][4]['truck'] +
                                                      $trit['row'][5]['truck'] +
                                                      $trit['row'][6]['truck'] +
                                                      $trit['row'][7]['truck'] +
                                                      $trit['row'][8]['truck'], 0, ",", ".") ?></b></td>
                            </tr>
                            <tr>
                              <td style="padding-left: 0.75rem;">Rit</td>
                              <td align="right"><?php echo number_format($trit['row'][0]['rit'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][1]['rit'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][2]['rit'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][3]['rit'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][4]['rit'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][5]['rit'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][6]['rit'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][7]['rit'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][8]['rit'], 0, ",", ".") ?></td>
                              <td align="right"><b><?php echo number_format($trit['row'][0]['rit'] +
                                                      $trit['row'][1]['rit'] +
                                                      $trit['row'][2]['rit'] +
                                                      $trit['row'][3]['rit'] +
                                                      $trit['row'][4]['rit'] +
                                                      $trit['row'][5]['rit'] +
                                                      $trit['row'][6]['rit'] +
                                                      $trit['row'][7]['rit'] +
                                                      $trit['row'][8]['rit'], 0, ",", ".") ?></b></td>
                            </tr>
                            <tr>
                              <td style="padding-left: 0.75rem;">KPM</td>
                              <td align="right"><?php echo number_format($trit['row'][0]['total'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][1]['total'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][2]['total'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][3]['total'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][4]['total'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][5]['total'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][6]['total'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][7]['total'], 0, ",", ".") ?></td>
                              <td align="right"><?php echo number_format($trit['row'][8]['total'], 0, ",", ".") ?></td>
                              <td align="right"><b><?php echo number_format($trit['row'][0]['total'] +
                                                      $trit['row'][1]['total'] +
                                                      $trit['row'][2]['total'] +
                                                      $trit['row'][3]['total'] +
                                                      $trit['row'][4]['total'] +
                                                      $trit['row'][5]['total'] +
                                                      $trit['row'][6]['total'] +
                                                      $trit['row'][7]['total'] +
                                                      $trit['row'][8]['total'], 0, ",", ".") ?></b></td>
                            </tr>
                          <?php } ?>
                          <tr>
                            <td rowspan="3"><b>Total</b></td>
                            <td><b>Truk</b></td>
                            <?php $total_index = 0;
                            $sum_total = 0;
                            foreach ($list_kabupaten as $kabupaten) {
                              if ($kabupaten->kabupaten == $total_truck_rit[$total_index]->kabupaten) { ?>
                                <td align="right"><b><?php echo number_format($total_truck_rit[$total_index]->truck, 0, ",", ".") ?></b></td>
                              <?php $sum_total += $total_truck_rit[$total_index]->truck;
                                $total_index++;
                              } else { ?>
                                <td align="right"><b>0</b></td>
                            <?php }
                            } ?>
                            <td align="right"><b><?php echo number_format($sum_total, 0, ",", ".") ?></b></td>
                          </tr>
                          <tr>
                            <td style="padding-left: 0.75rem;"><b>Rit</b></td>
                            <?php $total_index = 0;
                            $sum_total = 0;
                            foreach ($list_kabupaten as $kabupaten) {
                              if ($kabupaten->kabupaten == $total_truck_rit[$total_index]->kabupaten) { ?>
                                <td align="right"><b><?php echo number_format($total_truck_rit[$total_index]->rit, 0, ",", ".") ?></b></td>
                              <?php $sum_total += $total_truck_rit[$total_index]->rit;
                                $total_index++;
                              } else { ?>
                                <td align="right"><b>0</b></td>
                            <?php }
                            } ?>
                            <td align="right"><b><?php echo number_format($sum_total, 0, ",", ".") ?></b></td>
                          </tr>
                          <tr>
                            <td style="padding-left: 0.75rem;"><b>KPM</b></td>
                            <?php $total_index = 0;
                            $sum_total = 0;
                            foreach ($list_kabupaten as $kabupaten) {
                              if ($kabupaten->kabupaten == $total_truck_rit[$total_index]->kabupaten) { ?>
                                <td align="right"><b><?php echo number_format($total_truck_rit[$total_index]->total, 0, ",", ".") ?></b></td>
                              <?php $sum_total += $total_truck_rit[$total_index]->total;
                                $total_index++;
                              } else { ?>
                                <td align="right"><b>0</b></td>
                            <?php }
                            } ?>
                            <td align="right"><b><?php echo number_format($sum_total, 0, ",", ".") ?></b></td>
                          </tr>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script type="text/javascript">
  var ctx = document.getElementById("myChart-non").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
      labels: [<?php

                if (!is_null($data_target_total)) {
                  foreach ($data_target_total as $dt) {
                    if ($dt->kabupaten_target == 'BEKASI') {
                      $name_kab = 'BKS';
                    } else if ($dt->kabupaten_target == 'BOGOR') {
                      $name_kab = 'BGR';
                    } else if ($dt->kabupaten_target == 'DEPOK') {
                      $name_kab = 'DPK';
                    } else if ($dt->kabupaten_target == 'TANGERANG') {
                      $name_kab = 'TGR';
                    } else if ($dt->kabupaten_target == 'TANGERANG SELATAN') {
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
                ?>],

      datasets: [

        {
          label: 'Target Terealisasi',
          backgroundColor: '#4169E1',
          borderColor: '##93C3D2',
          data: [<?php

                  if (!is_null($data_target_total)) {
                    foreach ($data_target_total as $dt) {
                      echo $dt->target . ", ";
                    }
                  }
                  ?>],

          borderWidth: 1
        }, {
          label: 'Pengiriman',
          backgroundColor: '#FF0000',
          borderColor: '#93C3D2',
          data: [<?php

                  if (!is_null($data_target_total)) {
                    foreach ($data_target_total as $dt) {
                      echo $dt->total . ", ";
                    }
                  }
                  ?>],
          borderWidth: 1
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      scales: {
        yAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
          },
          ticks: {
            beginAtZero: true
          }
        }],
        xAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
          },
          ticks: {
            autoSkip: false,
            display: false,
            suggestedMax: 510000
          }
        }]

      }
    },


    showTooltips: false,
    onAnimationComplete: function() {

      var ctx = this.chart.ctx;
      ctx.font = this.scale.font;
      ctx.fillStyle = this.scale.textColor
      ctx.textAlign = "center";
      ctx.textBaseline = "bottom";

      this.datasets.forEach(function(dataset) {
        dataset.bars.forEach(function(bar) {
          ctx.fillText(bar.value, bar.x, bar.y - 5);
        });
      })
    }
  });
  // Define a plugin to provide data labels
  Chart.plugins.register({
    afterDatasetsDraw: function(chart, easing) {
      // To only draw at the end of animation, check for easing === 1
      var ctx = chart.ctx;

      chart.data.datasets.forEach(function(dataset, i) {
        var meta = chart.getDatasetMeta(i);
        if (!meta.hidden) {
          meta.data.forEach(function(element, index) {
            // Draw the text in black, with the specified font
            ctx.fillStyle = 'rgb(0, 0, 0)';

            var fontSize = 16;
            var fontStyle = 'normal';
            var fontFamily = 'Source Sans Pro';
            ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

            // Just naively convert to string for now
            var dataString = dataset.data[index].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            // Make sure alignment settings are correct
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            var padding = 28;
            var position = element.tooltipPosition();
            ctx.fillText(dataString, position.x + padding, position.y);
          });
        }
      });
    }
  });
</script>

<script type="text/javascript">
  var $statusfilter = 0;
  $(document).ready(function() {
    setTimeout(function() {
      location.reload();
    }, 10 * 60 * 1000);
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

<script type="text/javascript">
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
      
  data: [{
    type: "pie",
    yValueFormatString: "#,##0\"\"",
    indexLabel: "{label} ({y})",
    dataPoints: <?php echo json_encode($data_pie, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}
</script>