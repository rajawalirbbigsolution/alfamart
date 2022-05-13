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


	</style>

    <div class="content-header" >

      <div class="container-fluid" style="margin-top: 8px;">

        <div class="row mb-2">

          <div class="col-lg-2">

            <ol class="breadcrumb">

              <li class="breadcrumb-item"><a href="#">Dashboard/Data Bansos</a></li>

            </ol>

          </div>

          <div class="col-lg-10">

                <div class="row float-right">

                    <a href="<?php echo base_url('Shipping/add'); ?>">

                        <button type="button" class="btn btn-default btn-sm">

                            <i class="fa fa-add" aria-hidden="true"></i> Add Manifest

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

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <?php echo $this->session->flashdata('notice'); ?>

                        <?php echo $this->session->flashdata('successMessageInsert'); ?>

                        <?php echo $this->session->flashdata('errorMessageInsert'); ?>

                        <?php echo $this->session->flashdata('successMessageUpdate'); ?>

                        <?php echo $this->session->flashdata('errorMessageUpdate'); ?>

                        <?php echo $this->session->flashdata('errorMessageDataNotfound'); ?>

                        <?php if($this->session->flashdata('errorMessageDataNotfoundArray')){

                            $errorMessageDataNotfound = $this->session->flashdata('errorMessageDataNotfoundArray');

                            echo '<div class="alert alert-danger alert-mg-b alert-success-style4 alert-st-bg3">

                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">

                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>

                                </button>

                                <i class="fa fa-times edu-danger-error admin-check-pro admin-check-pro-clr3" aria-hidden="true"></i>';

                            for($i = 0; $i < count($errorMessageDataNotfound); $i++){

                                echo '<p><strong>Danger! </strong> nama product <span style="color: red;">'.$errorMessageDataNotfound[$i]['name_product'].'</span> dan variant <span style="color: red;">'.$errorMessageDataNotfound[$i]['variant'].'</span> tidak ditemukan di Master Product.</p>';

                            }

                            echo '</div>';

                        }?>

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
                      <div class="card-body">
                          <h3> List : </h3>
                        
                        
                        <p> kabupaten : <?php echo $dt_object->kabupaten; ?> </p>
                        <p> kecamatan : <?php echo $dt_object->kecamatan; ?> </p>
                        <p> kelurahan : <?php echo $dt_object->kelurahan; ?> </p>
                        <p> Rw : <?php echo $dt_object->no_rw; ?> </p>
                        <p> Rt : <?php echo $dt_object->no_rt; ?> </p>
                        
                      </div>
                      

                      <table class="table table-striped projects" id="data">

                      <thead>

                        <tr>

                            <tr>

            								<th data-field="id" class="no">No</th>
            								<th data-field="code_product" data-editable="true" class="code_product">Nama KPM</th>
            								<th data-field="email" data-editable="true" class="variant">Status</th>

            								<th data-field="action">Action</th>

            							</tr>

                        </tr>

                      </thead>

                      <tbody>

                        <?php $no = 1; ?>
                        <?php foreach ($dt_bansos as $key1) { ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $key1['nama_kep_kel']; ?><br><?php echo $key1['nik_ktp']; ?></td>
                            <!-- <td><?php echo $key1['alamat']; ?></td> -->
                            <td>
                              <?php if ($key1['status'] == 0) { 
                                echo 'Belum';
                              }else{
                                echo "Sudah";
                              }
                              ?>
                            </td>
                            <td>
                              <?php if ($key1['status'] == 0) { ?>
                                <button data-toggle="modal" data-target="#PrimaryModalhdbgclEdit" data-href="#" data-nik_ktp="<?php echo $key1['nik_ktp']; ?>" class="btn btn-primary"> upload</button>
                              <?php }else{ ?>
                                <img  id="myImg" src="<?php echo base_url();?>/assets/upload/image_user/<?php echo $key1['image'];?>" width="150px">
                             <?php  } ?>
                              
                            </td>
                          </tr>
                          <?php $no++; ?>
                       <?php } ?>
                      </tbody>

                  </table>
                    <div class="card-tools text-center" id="pagination"></div>
                  </div>

                  

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

	  

        </div>

      

	<div id="PrimaryModalhdbgclEdit" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-1">
                <h4 class="modal-title">Upload Image</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a> 
                    <a>Nik: <h5 id="show_nik"></h5></a>

                </div>
            </div>
            <div class="modal-body">
               <form id="add-product" role="form" action="<?php echo base_url('Shipping/update') ?>" method="post" enctype="multipart/form-data" class="add-department" autocomplete="off">
                   <div class="row clearfix">
                     
                     <div class="col-sm-12" align="left">
                        <a>Image <font color=red>*</font> </a>
                      <p>
                        <input type='file' name="filefoto" id="id_image"  onchange="readURL(this);" accept="image">
                      <br>
                       <span class="text-error" id="txt_username"></span>
                     </div>
                </div>

                 <div class="row clearfix">
                     
                     <div class="col-sm-12" align="left">
                          <img id="blah" src="#" alt="your image" />
                       <input type="hidden" name="nik_ktp" id="input_nik">
                       <input type="hidden" name="id" value="<?php echo $dt_object->id;?>">
                     </div>
                   </div>
               
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-blue waves-effect" data-dismiss="modal" href="#">Cancel</button>
                <button type="button" class="btn bg-blue waves-effect"  id="send_edit">Upload</button>
                <button type="submit" class="btn bg-blue waves-effect" style="display:none;" id="kirim_edit">Upload</button>
            </div>
               </form>
               
        
        </div>
    </div>
</div>



    </section>





<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>

 <!-- <script src="<?php echo base_url(); ?>assets/js-data/shipping/get-index.js" id="date" data-start="<?php echo date('d-m-Y', strtotime($start)); ?>" data-end="<?php echo date('d-m-Y', strtotime($end)); ?>"></script> -->
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
 <script type="text/javascript">
     var $statusfilter = 0;
        $(document).ready(function(){
            $('.filterbtn').click(function(){
            if($statusfilter == 0){
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
    
    setTimeout(function(){
       $("div.alert").remove();
    }, 5000 );

    $('#PrimaryModalhdbgclEdit').on('show.bs.modal', function(e) { 
      var nik_ktp = $(e.relatedTarget).data('nik_ktp');
      

      $(e.currentTarget).find('#show_nik').text(nik_ktp);
      $(e.currentTarget).find('#input_nik').val(nik_ktp);
      });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(400)
                    .height(400);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#send_edit").click(function () {
    if ($("#id_image").val() < 1) {
      $("#txt_username").text("Image is empty");
    } else {
      $("#txt_username").text("");
    }

    

    if (
      $("#id_image").val().length > 0  ) {
        $("#kirim_edit").click();
    }
  });

     



   </script>
   <script>
            // Get the modal
            var modal = document.getElementById('myModal');

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById('myImg');
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            img.onclick = function(){
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() { 
                modal.style.display = "none";
            }
        </script>

  

