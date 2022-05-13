<link rel="stylesheet" href="<?php echo base_url(); ?>assets/kialap/style/order.css">
<style>
  .child-menu {
    padding-left: 5rem;
  }
</style>

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

              <h3 class="card-title">Add Module Link</h3>

            </div>

            <form id="add-product" role="form" action="<?php echo base_url('ModuleLink/update') ?>" method="post" enctype="multipart/form-data" class="add-department" autocomplete="off">

              <div class="card-body">
                <div class="row">

                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                    <div class="input-mask-title">

                      <label>Role</label>

                    </div>

                  </div>

                  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

                    <div class="input-mark-inner mg-b-22">
                      <input type="hidden" name="role" class="role" value="<?php echo $id ?>" />
                      <select name="role" class="form-control" id="role" disabled>
                        <option value="0">-select-</option>
                        <?php foreach ($role_list as $role) { ?>
                          <option value="<?php echo $role->id ?>" <?php echo $role->id == $id ? "selected" : ""; ?>><?php echo $role->role ?></option>
                        <?php } ?>
                      </select>

                      <small class="form-text text-muted"><?php echo form_error('role');  ?></small>
                    </div>

                  </div>

                </div>
                <div class="row">
                  <div class="col-12" id="module-list">
                    <?php $start_order = 0;
                    for ($i = 0; $i < count($data); $i++) { ?>
                      <div class="row">
                        <div class="col-4 <?php echo $data[$i]->is_parent != 1 ? "child-menu" : ""; ?>">
                          <input type="hidden" name="link[<?php echo $i ?>]" class="link-id" value="<?php echo $data[$i]->link_id ?>" />
                          <select name="module[<?php echo $i ?>]" class="form-control select-module" id="module">
                            <option value=" 0"> -module- </option>
                            <?php foreach ($module_list as $module) {
                              echo '<option value = "' . $module->id . '" ' .
                                ($module->id == $data[$i]->module_id ? "selected" : "") . '>' .
                                $module->module_name . '</option>';
                            } ?>
                          </select>
                        </div>
                        <div class="col-4 my-auto">
                          <span class="module_url" style="font-size:1rem;"><?php echo $data[$i]->module_url; ?></span>
                        </div>
                        <div class="col-1">
                          <input type="text" name="module_order[<?php echo $i ?>]" class="form-control input-order" placeholder="Order" value="<?php echo $data[$i]->order;
                                                                                                                                                $start_order = $data[$i]->order; ?>"></input>
                        </div>
                        <div class="col-2">
                          <label style="font-size:1.5rem;"> Main Menu?
                            <input type="hidden" name="is_parent[<?php echo $i ?>]" class="is-parent" value="0" />
                            <input type="checkbox" name="is_parent[<?php echo $i ?>]" class="is-parent" value="1" <?php echo $data[$i]->is_parent == 1 ? "checked" : ""; ?> /> </label>
                        </div>
                        <div class="col-1">
                          <input type="hidden" name="status[<?php echo $i ?>]" class="status" value="1" />
                          <button data-toggle="tooltip" type="button" title="delete" class="btn btn-default btn-sm delete-row" id="delete-row">
                            <i class="fa fa-times" style="color: blue;"></i>
                          </button>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-center">
                    <button id="add-module-btn" type="button" class="btn btn-default btn-sm" align="center">Add Module</button>
                  </div>
                </div>

                <br>

                <div class="row">

                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                    <div class="input-mask-title">

                      <label></label>

                    </div>

                  </div>

                  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

                    <div class="input-mark-inner mg-b-22">



                      <a href="<?php echo base_url('ModuleLink') ?>" class="btn btn-danger" style="margin-left: 5px;">Back</a>

                      <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>

                    </div>

                  </div>

                </div>

                <p>

              </div>

            </form>

          </div>

          <!-- /.card -->











          <!-- /.card -->



        </div>

        <!--/.col (left) -->



        <!-- /.card -->

      </div>

      <!--/.col (right) -->

    </div>

    <!-- /.row -->

</div><!-- /.container-fluid -->

</section>



<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/gijgo.min.js"></script>

<link href="<?php echo base_url(); ?>assets/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
  $(document).ready(function() {
    var order = <?php echo $start_order ?>;
    var index = <?php echo count($data) ?>;
    var module_url_list = {};
    <?php foreach ($module_list as $module) {
      echo 'module_url_list["' . $module->id . '"] = "' . $module->module_url . '";';
    } ?>
    $("#add-module-btn").click(function() {
      var module_row =
        '<div class="row">' +
        '<div class="col-4">' +
        '<input type="hidden" name="link[' + index + ']" class="link-id" value="0" />' +
        '<select name="module[' + index + ']" class="form-control select-module" id="module">' +
        '<option value = "0" > -module- </option>' +
        '<?php foreach ($module_list as $module) {
            echo '<option value = "' . $module->id . '" >' . $module->module_name . '</option>';
          } ?>' +
        '</select>' +
        '</div>' +
        '<div class="col-5 my-auto">' +
        '<span class="module_url" style="font-size:1rem;"></span>' +
        '</div>' +
        '<div class="col-1">' +
        '<input type="text" name="module_order[' + index + ']" class="form-control input-order" placeholder="Order"></input>' +
        '</div>' +
        '<div class="col-2">' +
        '<label style="font-size:1.5rem;"> Main Menu? ' +
        '<input type="hidden" name="is_parent[' + index + ']" class="is-parent" value="0"/> ' +
        '<input type="checkbox" name="is_parent[' + index + ']" class="is-parent" value="1" checked/>  </label>' +
        '</div>' +
        '</div>';
      $("#module-list").append(module_row);
      index++;
    });
    $(document).on("change", ".select-module", function() {
      var id = $(this).val();
      var module_url = $(this).parent().parent().find($(".module_url"));
      var input_order = $(this).parent().parent().find($(".input-order"));
      module_url.text(module_url_list[id]);
      if (id == 0) {
        order -= 10;
        input_order.val("");
      } else if (input_order.val() == "") {
        order += 10;
        input_order.val(order);
      }
    });
    $(document).on("change", ".is-parent", function() {
      var child = $(this).parent().parent().parent();
      child.children(":first").toggleClass("child-menu");
    });

    $(document).on("click", ".delete-row", function() {
      var parent = $(this).parent().parent();
      var container = $(this).parent();
      container.children(":first").val("0");
      parent.attr("hidden", "true");
    });
  });
</script>