<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bansos | Log in</title>
  <link rel="icon" href="https://gaprc.dnr.id/assets/landing/dnr-logo.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/testing/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
</head>
<body class="hold-transition login-custom" style="background:url('<?php echo base_url(); ?>assets/image/background.png') no-repeat center center fixed ;-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; overflow:hidden;">
<div class="login-box">
  <div class="login-logo-img">
		<img src="<?php echo base_url(); ?>assets/image/dnr.png" width="25%">
  </div>
  <!-- /.login-logo -->
  <div class="menu-atas menu-atas-text">
      	<a class="menu-atas-text" href="#">Login</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      	<a class="menu-atas-text" href="#">About Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      	<a class="menu-atas-text" href="#">Contact</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </div>
<!--   <div class="container-nav"> -->
<!--       <button class="main-header navbar navbar-expand navbar-white navbar-light" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button> -->
<!--       <div class="collapse navbar-collapse" id="navbarMenu1"> -->
<!--       	<ul class="navbar-nav mr-auto bg-white""> -->
<!--         	<li class="nav-item active"> -->
<!--             	<a class="nav-link" href="#">Login</a> -->
<!--             </li> -->
<!--             <li class="nav-item"> -->
<!--             	<a class="nav-link" href="#">About Us</a> -->
<!--             </li> -->
<!--             <li class="nav-item"> -->
<!--             	<a class="nav-link" href="#">Contact</a> -->
<!--            	</li> -->
<!--        	</ul> -->
<!--       </div> -->
<!--   </div> -->

  <div class="card transbox-login"></div>
  	<div class="rectangle-box">
  		<div class="input-group mb-2">
    		<?php echo $this->session->flashdata('notice'); ?>
        </div>
     <form action="<?php echo base_url('Login/send') ?>" method="post" id="login-form" autocomplete="off">
        <div class="input-group mb-3 form-icons">
              <img src="<?php echo base_url(); ?>assets/image/username.png" style="margin: 7px 0 0 5px; width:8%; height:8%;"/>
              <input type="email" class="form-control-login" name="email_penerima" placeholder="Masukkan Email">
        </div>
        <div class="input-group mb-2"></div>
        <div class="row">
          <div class="col-8"></div>
          <!-- /.col -->
          <div class="col-4">
            <button
        data-sitekey="6LeFJP0UAAAAAEvYhCFBDz82pLwGQPqDknC09DsP" 
        data-callback='onSubmit' 
        data-action='submit' class="g-recaptcha button-login"><img src="<?php echo base_url(); ?>assets/image/login.png" width="70%"></button>
        <br>
       <!--  <a href="">login</a>  -->
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    
    <div class="menu-bawah menu-bawah-text" style="border:0">
      	<a class="menu-bawah-text" href="#">Privacy Policy</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      	<a class="menu-bawah-text" href="#">Term of Use</a>
    </div>
    
    <div class="copyright" style="border:0;">&copy;2020 DNR Bansos Management</div>
    
   </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/testing/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript">
function onSubmit(token) {
 document.getElementById("login-form").submit();
}
  $(function () {
	  
	  setTimeout(function(){
        $('.alert').fadeOut('slow');
    },2000);

	  $('#login-form').validate({
		rules: {
		  email: {
  			required: true,
  			email: true,
		  },
      password: {
        name: true
      },
		  password: {
			   required: true
		  }
		},

		messages: {
		  email: {
			   required: "Email belum diisi",
			   email: "Email salah",
		  },
      name: {
          required: "Nama belum diisi"
      },
		  password: {
			   required: "Password belum diisi"
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
  
});
</script>

</body>
</html>
