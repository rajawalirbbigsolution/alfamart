<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>">
<style type="text/css">
     .txtedit{
        display: none;
        width: 98%;
     }
     </style>
<style type="text/css">


.table_zonasi td{
  padding: 0.4rem;

}

.editor{
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
<div class="content-header">

  <div class="container-fluid" style="margin-top: 8px;">

    <div class="row mb-2">

      <div class="col-lg-5">

        <ol class="breadcrumb">

          <li class="breadcrumbs-joy"><a style="font-family: 'Source Sans Pro',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'; font-size: 32px;  font-weight: bold;" href="#"><b><?php echo $title; ?></b></a></li>

        </ol>

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
                 <form method="post" action="<?php echo base_url("Zonasi/importZonasi"); ?>" enctype="multipart/form-data">
                  <input accept=".xlsx" type="file" name="file" required>
                  <button type="submit" name="submit" value="upload">Preview </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</div>

  <?php
  if($this->input->post('submit', TRUE) == 'upload'){ // Jika user menekan tombol Preview pada form
    if(isset($upload_error)){ // Jika proses upload gagal
      echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
      die; // stop skrip
    }

    // Buat sebuah tag form untuk proses import data ke database
    echo "<form method='post' action='".base_url("Zonasi/SaveImport")."'>";

    // Buat sebuah div untuk alert validasi kosong
  /*  echo 'total'.$total;*/
    echo "
    <div class='col-md-12'>
      <div class='row'>
        <div class='col-md-12'>
          <div class='card'>
            <div class='card-body p-0'>
              <div class='table-responsive'>
              <table class='table table-striped projects table_zonasi'>    
                <tr>
                  <th colspan='6'>Preview Data</th>
                  <th><button name='simpan' type='submit' class='btn bg-blue waves-effect' style='float: left;' id='simpan'>Simpan</button></th>
                </tr>
                <tr>
                  <th>Provinsi</th>
                  <th>Kabupaten</th>
                  <th>Kecamatan</th>
                  <th>Kelurahan</th>
                  <th>Priority</th>
                  <th>Warehouse</th>
                  <th>Date Plan</th
                </tr>";

    // $numrow = 1;
    foreach($data_ar as $data_sheet){
      foreach ($data_sheet as $row) {
        echo "<tr style='background-color:".$row['validasidata']."'>";
        echo "<td><input style='width:100px;' type='text' name='provinsi[]' value='".$row['provinsi']."' required></td>";
        echo "<td><input style='width:100px;' type='text' name='kabupaten[]' value='".$row['kabupaten']."'required></td>";
        echo "<td><input style='width:100px;' type='text' name='kecamatan[]' value='".$row['kecamatan']."' required></td>";
        echo "<td><input style='width:100px;' type='text' name='kelurahan[]' value='".$row['kelurahan']."' required></td>";
        echo "<td><input style='width:40px;' type='number' name='priority[]' value='".$row['priority']."' required></td>";
        echo "<td><input style='width:100px;' type='text' name='code_warehouse[]' value='".$row['code_warehouse']."' required></td>";
        echo "<td><input style='width:120px;' type='date' name='date_plan[]' value='".$row['date_plan']."' required></td>";
        echo "</tr>";
      }
    }

    echo "</table>
     </div></div></div></div></div></div>";

  }
  ?>
  
</section>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/testing/plugins/select2/js/select2.min.js?>"></script>
<script type="text/javascript">
   $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
   });
   document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
      elements[i].oninvalid = function(e) {
        e.target.setCustomValidity("");
        if (!e.target.validity.valid) {
          e.target.setCustomValidity("Data Tidak Boleh Kosong");
        }
      };
      elements[i].oninput = function(e) {
        e.target.setCustomValidity("");
      };
    }
  });
  document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("select");
    for (var i = 0; i < elements.length; i++) {
      elements[i].oninvalid = function(e) {
        e.target.setCustomValidity("");
        if (!e.target.validity.valid) {
          e.target.setCustomValidity("Data Tidak Boleh Kosong");
        }
      };
      elements[i].oninput = function(e) {
        e.target.setCustomValidity("");
      };
    }
  });
</script>
