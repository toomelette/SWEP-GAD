<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>Add Laboratory Service</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="<?php echo e(route('dashboard.sugar_service.store')); ?>" autocomplete="off">

        <div class="box-body">
          

          <div class="col-md-6">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Fields</h3>
              </div>
              
              <div class="box-body">

                <?php echo csrf_field(); ?>    

                <?php echo __form::textbox(
                  '12', 'name', 'text', 'Name *', 'Name', old('name'), $errors->has('name'), $errors->first('name'), ''
                ); ?>


                <?php echo __form::textbox_numeric(
                  '12', 'price', 'text', 'Price ', 'Price', old('price'), $errors->has('price'), $errors->first('price'), ''
                ); ?> 

                <?php echo __form::textbox(
                  '12', 'standard_str', 'text', 'Standard in text', 'Standard in text', old('standard_str'), $errors->has('standard_str'), $errors->first('standard_str'), ''
                ); ?>


                <div class="col-md-12"></div>

                <?php echo __form::textbox(
                  '6', 'standard_dec_max', 'text', 'Max standard in numeric', '0.00', old('standard_dec_max'), $errors->has('standard_dec_max'), $errors->first('standard_dec_max'), ''
                ); ?>


                <?php echo __form::textbox(
                  '6', 'standard_dec_min', 'text', 'Min standard in numeric', '0.00', old('standard_dec_min'), $errors->has('standard_dec_min'), $errors->first('standard_dec_min'), ''
                ); ?>


              </div>
            </div>
          </div>


          <div class="col-md-6">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Methods</h3>
                <button id="add_row" type="button" class="btn btn-sm bg-green pull-right">Add Row &nbsp;<i class="fa fw fa-plus"></i></button>
              </div>
              
              <div class="box-body no-padding">
                
                <table class="table table-bordered">

                  <tr>
                    <th>Name *</th>
                    <th style="width: 40px"></th>
                  </tr>

                  <tbody id="table_body">


                    <?php if(old('row')): ?>

                      <?php $__currentLoopData = old('row'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>

                          <td>
                            <div class="form-group">
                              <input type="text" name="row[<?php echo e($key); ?>][name]" class="form-control" placeholder="Name" value="<?php echo e($value['name']); ?>">
                              <small class="text-danger"><?php echo e($errors->first('row.'. $key .'.name')); ?></small>
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

  <?php if(Session::has('SUGAR_SERVICE_CREATE_SUCCESS')): ?>

    <?php echo __html::modal(
      'ss_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('SUGAR_SERVICE_CREATE_SUCCESS')
    ); ?>

  
  <?php endif; ?>

<?php $__env->stopSection(); ?> 






<?php $__env->startSection('scripts'); ?>

  <script type="text/javascript">

    <?php if(Session::has('SUGAR_SERVICE_CREATE_SUCCESS')): ?>
      $('#ss_create').modal('show');
    <?php endif; ?>


    
    $(document).ready(function() {
      $("#add_row").on("click", function() {
        var i = $("#table_body").children().length;
        var content ='<tr>' +
                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][name]" class="form-control" placeholder="Name">' +
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