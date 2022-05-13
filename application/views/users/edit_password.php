<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/kialap/style/order.css"> -->
<!--  <link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" /> -->
<style type="text/css">
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
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/gijgo.min.js"></script>

<link href="<?php echo base_url(); ?>assets/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<link href="<?php echo base_url(); ?>assets/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<div class="section__content section__content--p30">

    <div class="container-fluid">

        <div class="row">

            <!--<br><br> -->

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="breadcome-list single-page-breadcome shadow">

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                            <div class="breadcome-heading">



                            </div>

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                            <ul class="breadcome-menu">



                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>



    </div>

    <!-- Main content -->

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <!-- left column -->

                <div class="col-md-12">

                    <!-- general form elements -->

                    <div class="card card-primary">

                        <div class="card-header">

                            <h3 class="card-title">New Password User</h3>

                        </div>

                        <div class="card-body">
                            <form id="quickForm" role="form" action="<?php echo base_url('users/updatePassword') ?>" method="post" enctype="multipart/form-data" class="add-department" autocomplete="off">
                                
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label>Username</label>
                                        <input type="hidden" name="id" class="form-control" value="<?php echo $data->id ?>" readonly>
                                        <input  name="username" id="username" class="form-control" placeholder="username" value = "<?php echo $data->name ?>" readonly>
                                    </div>
                                  	<div class="col-sm-4">
                                        <label>New Password</label>
                                       <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                                    </div>
                                </div>
                                
                                <p>
                                    <div class="row clearfix">
                                        <div class="col-sm-2">
                                            <a href="<?php echo base_url('Users') ?>" class="btn btn-danger" style="margin-left: 5px;">Back</a>
                                            
                                            <button type="submit" class="btn bg-blue waves-effect">Update</button>
                                        </div>
                                    </div>
                                    <p>
                            </form>


                        </div>

                    </div>
                </div>
            </div>
        </div>
</div><!-- /.container-fluid -->

</section>
<script type="text/javascript">
$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      password: {
        required: true,
        minlength: 5
      },

    },
    messages: {
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
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
});
</script>

