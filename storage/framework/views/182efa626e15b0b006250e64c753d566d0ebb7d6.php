<?php

  $table_sessions = [ Session::get('SUGAR_SERVICE_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'e' => Request::get('e'),
                      ];

?>







<?php $__env->startSection('content'); ?>
    
  <section class="content-header">
      <h1>Manage Laboratory Services</h1>
  </section>

  <section class="content">
    
    
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="<?php echo e(route('dashboard.sugar_service.index')); ?>">

    <div class="box" id="pjax-container" style="overflow-x:auto;">

              
      <div class="box-header with-border">
        <?php echo __html::table_search(route('dashboard.sugar_service.index')); ?>

      </div>

      
    </form>

              
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', 'Name'));?></th>
            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('standard', 'Standards'));?></th>
            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('price', 'Price'));?></th>
            <th style="width: 150px">Action</th>
          </tr>
          <?php $__currentLoopData = $sugar_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <tr <?php echo __html::table_highlighter($data->slug, $table_sessions); ?> >
              <td><?php echo e($data->name); ?></td>
              <td><?php echo e($data->standard_str); ?></td>
              <td><?php echo e(number_format($data->price, 2)); ?></td>
              <td> 
                <select id="action" class="form-control input-md">
                  <option value="">Select</option>
                  <option data-type="1" data-url="<?php echo e(route('dashboard.sugar_service.edit', $data->slug)); ?>">Edit</option>
                  <option data-type="0" data-action="delete" data-url="<?php echo e(route('dashboard.sugar_service.destroy', $data->slug)); ?>">Delete</option>
                </select>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </table>
      </div>

      <?php if($sugar_services->isEmpty()): ?>
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      <?php endif; ?>

      <div class="box-footer">
        <?php echo __html::table_counter($sugar_services); ?>

        <?php echo $sugar_services->appends($appended_requests); ?>

      </div>

    </div>

  </section>

<?php $__env->stopSection(); ?>





<?php $__env->startSection('modals'); ?>

  <?php echo __html::modal_delete('ss_delete'); ?>


<?php $__env->stopSection(); ?> 





<?php $__env->startSection('scripts'); ?>

  <script type="text/javascript">

    
    <?php echo __js::modal_confirm_delete_caller('ss_delete'); ?>


    
    <?php if(Session::has('SUGAR_SERVICE_UPDATE_SUCCESS')): ?>
      <?php echo __js::toast(Session::get('SUGAR_SERVICE_UPDATE_SUCCESS')); ?>

    <?php endif; ?>

    
    <?php if(Session::has('SUGAR_SERVICE_DELETE_SUCCESS')): ?>
      <?php echo __js::toast(Session::get('SUGAR_SERVICE_DELETE_SUCCESS')); ?>

    <?php endif; ?>

  </script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>