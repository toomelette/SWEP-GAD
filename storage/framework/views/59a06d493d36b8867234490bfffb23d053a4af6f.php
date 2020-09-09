<?php

  $table_sessions = [];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'e' => Request::get('e'),

                        'ss' => Request::get('ss'),
                        'df' => Request::get('df'),
                        'dt' => Request::get('dt'),
                      ];
                      
?>







<?php $__env->startSection('content'); ?>
    
  <section class="content-header">
      <h1>Manage Order of Payments</h1>
  </section>

  <section class="content">
    
    
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="<?php echo e(route('dashboard.sugar_order_of_payment.index')); ?>">


      
      <?php echo __html::filter_open(); ?>


        <?php echo __form::select_dynamic_for_filter(
          '3', 'ss', 'Kind Of Sample', old('ss'), $global_sugar_samples_all, 'sugar_sample_id', 'name', 'submit_soop_filter', '', ''
        ); ?>


        <div class="col-md-12 no-padding">
          
          <h5>Date Filter : </h5>

          <?php echo __form::datepicker('3', 'df',  'From', old('df'), '', ''); ?>


          <?php echo __form::datepicker('3', 'dt',  'To', old('dt'), '', ''); ?>


          <button type="submit" class="btn btn-primary" style="margin:25px;">Filter Date <i class="fa fa-fw fa-arrow-circle-right"></i></button>

        </div>

      <?php echo __html::filter_close('submit_soop_filter'); ?>




    <div class="box" id="pjax-container" style="overflow-x:auto;">

              
      <div class="box-header with-border">
        <?php echo __html::table_search(route('dashboard.sugar_order_of_payment.index')); ?>

      </div>

      
    </form>

              
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('sample_no', 'Sample No.'));?></th>
            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('sugarSample.name', 'Kind of Sample'));?></th>
            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('received_from', 'Received From'));?></th>
            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('date', 'Date'));?></th>
            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('received_by', 'Received By'));?></th>
            <th style="width: 150px">Action</th>
          </tr>
          <?php $__currentLoopData = $sugar_oops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <tr <?php echo __html::table_highlighter($data->slug, $table_sessions); ?> >
              <td><?php echo e($data->sample_no); ?></td>
              <td><?php echo e(optional($data->sugarSample)->name); ?></td>
              <td><?php echo e($data->received_from); ?></td>
              <td><?php echo e(__dataType::date_parse($data->date, 'F d,Y')); ?></td>
              <td><?php echo e($data->received_by); ?></td>
              <td> 
                <select id="action" class="form-control input-md" style="font-size:15px;">
                  <option value="">Select</option>
                  <option data-type="1" data-url="<?php echo e(route('dashboard.sugar_order_of_payment.show', $data->slug)); ?>">Print</option>
                  <option data-type="1" data-url="<?php echo e(route('dashboard.sugar_order_of_payment.edit', $data->slug)); ?>">Edit</option>
                  <option data-type="0" data-action="delete" data-url="<?php echo e(route('dashboard.sugar_order_of_payment.destroy', $data->slug)); ?>">Delete</option>
                </select>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </table>
      </div>

      <?php if($sugar_oops->isEmpty()): ?>
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      <?php endif; ?>

      <div class="box-footer">
        <?php echo __html::table_counter($sugar_oops); ?>

        <?php echo $sugar_oops->appends($appended_requests); ?>

      </div>

    </div>

  </section>

<?php $__env->stopSection(); ?>





<?php $__env->startSection('modals'); ?>

  <?php echo __html::modal_delete('sugar_oop_delete'); ?>


<?php $__env->stopSection(); ?> 





<?php $__env->startSection('scripts'); ?>

  <script type="text/javascript">

    
    <?php echo __js::modal_confirm_delete_caller('sugar_oop_delete'); ?>


    
    <?php if(Session::has('SUGAR_OOP_DELETE_SUCCESS')): ?>
      <?php echo __js::toast(Session::get('SUGAR_OOP_DELETE_SUCCESS')); ?>

    <?php endif; ?>

  </script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>