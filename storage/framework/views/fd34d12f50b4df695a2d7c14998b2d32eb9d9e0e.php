<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>Add Menu</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="<?php echo e(route('dashboard.menu.store')); ?>">

        <div class="box-body">

          <div class="col-md-11">
                  
            <?php echo csrf_field(); ?>    

            <?php echo __form::textbox(
              '4', 'name', 'text', 'Name *', 'Name', old('name'), $errors->has('name'), $errors->first('name'), ''
            ); ?>


            <?php echo __form::textbox(
              '4', 'route', 'text', 'Route *', 'Route', old('route'), $errors->has('route'), $errors->first('route'), ''
            ); ?>    

            <?php echo __form::textbox(
              '4', 'category', 'text', 'Category *', 'Category', old('category'), $errors->has('category'), $errors->first('category'), ''
            ); ?>


            <div class="col-md-12"></div>

            <?php echo __form::textbox(
              '4', 'icon', 'text', 'Icon *', 'Icon', old('icon'), $errors->has('icon'), $errors->first('icon'), ''
            ); ?>


            <?php echo __form::select_static(
              '4', 'is_menu', 'Is Menu *', old('is_menu'), ['1' => 'true', '0' => 'false'], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
            ); ?>

            
            <?php echo __form::select_static(
              '4', 'is_dropdown', 'Is Dropdown *', old('is_dropdown'), ['1' => 'true', '0' => 'false'], $errors->has('is_dropdown'), $errors->first('is_dropdown'), '', ''
            ); ?>


          </div>


          
          <div class="col-md-12" style="padding-top:40px;">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Submenu</h3>
                <button id="add_row" type="button" class="btn btn-sm bg-green pull-right">Add Row &nbsp;<i class="fa fw fa-plus"></i></button>
              </div>
              
              <div class="box-body no-padding">
                
                <table class="table table-bordered">

                  <tr>
                    <th>Name *</th>
                    <th>Route *</th>
                    <th>Is Nav *</th>
                    <th style="width: 40px"></th>
                  </tr>

                  <tbody id="table_body">


                    <?php if(old('row')): ?>

                      <?php $__currentLoopData = old('row'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>

                          <td>
                            <div class="form-group">
                              <input type="text" name="row[<?php echo e($key); ?>][sub_name]" class="form-control" placeholder="Name" value="<?php echo e($value['sub_name']); ?>">
                              <small class="text-danger"><?php echo e($errors->first('row.'. $key .'.sub_name')); ?></small>
                            </div>
                          </td>


                          <td>
                            <div class="form-group">
                              <input type="text" name="row[<?php echo e($key); ?>][sub_route]" class="form-control" placeholder="Route" value="<?php echo e($value['sub_route']); ?>">
                              <small class="text-danger"><?php echo e($errors->first('row.'. $key .'.sub_route')); ?></small>
                            </div>
                          </td>


                          <td>
                            <div class="form-group">
                              <select name="row[<?php echo e($key); ?>][sub_is_nav]" class="form-control">
                                <option value="">Select</option>
                                  <option value="true" <?php echo $value['sub_is_nav'] == "true" ? 'selected' : ''; ?>>1</option>
                                  <option value="false" <?php echo $value['sub_is_nav'] == "false" ? 'selected' : ''; ?>>0</option>
                              </select>
                              <small class="text-danger"><?php echo e($errors->first('row.'. $key .'.sub_is_nav')); ?></small>
                            </div>
                          </td>


                          <td>
                              <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                          </td>

                        </tr>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>

                    </tbody>
                </table>
               
              </div>

            </div>
          </div>

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

<?php $__env->stopSection(); ?>





<?php $__env->startSection('modals'); ?>

  <?php if(Session::has('MENU_CREATE_SUCCESS')): ?>

    <?php echo __html::modal(
      'menu_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('MENU_CREATE_SUCCESS')
    ); ?>

  
  <?php endif; ?>

<?php $__env->stopSection(); ?> 






<?php $__env->startSection('scripts'); ?>

  <script type="text/javascript">

    <?php if(Session::has('MENU_CREATE_SUCCESS')): ?>
      $('#menu_create').modal('show');
    <?php endif; ?>


    
    $(document).ready(function() {
      $("#add_row").on("click", function() {
        var i = $("#table_body").children().length;
        var content ='<tr>' +
                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][sub_name]" class="form-control" placeholder="Name">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][sub_route]" class="form-control" placeholder="Route">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<select name="row[' + i + '][sub_is_nav]" class="form-control">' +
                              '<option value="">Select</option>' +
                              '<option value="true">1</option>' +
                              '<option value="false">0</option>' +
                            '</select>' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                            '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                        '</td>' +

                      '</tr>';
        $("#table_body").append($(content));
      });
    });



  </script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>