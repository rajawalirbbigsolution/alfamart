    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <?php $page = $this->uri->segment(1); ?>
              <li class="breadcrumb-item"><?php echo $page; ?></li>
              <li class="breadcrumb-item">404</li>
            </ol>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="error-page">
        <h1 class="headline text-warning"> 404</h1>

        <div class="error-content">
          <h2><i class="fas fa-exclamation-triangle text-secondary"></i> Oops! Data not found.</h2>
          <p>
			We could not find the data you are looking for. In the meantime, 
			you can return to the <b><?php echo $page;?></b> or try using the search form.
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>


