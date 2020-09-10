<?php

  $table_sessions = [ ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'e' => Request::get('e'),

                        'ss' => Request::get('ss'),
                        'we' => Request::get('we'),
                      ];

  $sugar_samples_static = __static::sugar_samples();

?>






<?php $__env->startSection('content'); ?>
    
  <section class="content-header">
      <h1>Manage Sugar Analyses</h1>
  </section>

  <section class="content">
    
    
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="<?php echo e(route('dashboard.sugar_analysis.index')); ?>">


      
      <?php echo __html::filter_open(); ?>


        <?php echo __form::select_dynamic_for_filter(
          '3', 'ss', 'Kind Of Sample', old('ss'), $global_sugar_samples_all, 'sugar_sample_id', 'name', 'submit_soop_filter', '', ''
        ); ?>


        <div class="col-md-12 no-padding">
          
          <h5>Date Filter : </h5>

          <?php echo __form::datepicker('3', 'we',  'Week Ending', old('we'), '', ''); ?>


          <button type="submit" class="btn btn-primary" style="margin:25px;">Filter Date <i class="fa fa-fw fa-arrow-circle-right"></i></button>

        </div>

      <?php echo __html::filter_close('submit_soop_filter'); ?>



    <div class="box" id="pjax-container" style="overflow-x:auto;">

              
      <div class="box-header with-border">
        <?php echo __html::table_search(route('dashboard.sugar_analysis.index')); ?>

      </div>

      
    </form>

              
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('sample_no', 'Sample No.'));?></th>
            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('sugarSample.name', 'Kind of Sample'));?></th>
            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('origin', 'Origin'));?></th>
            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('week_ending', 'Week Ending'));?></th>
            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('status', 'Status'));?></th>
            <th style="width: 150px">Action</th>
          </tr>
          <?php $__currentLoopData = $sugar_analysis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <tr <?php echo __html::table_highlighter($data->slug, $table_sessions); ?> >
              <td><?php echo e($data->sample_no); ?></td>
              <td><?php echo e($data->sugarSample->name); ?></td>
              <td><?php echo e($data->origin); ?></td>
              <td><?php echo e(__dataType::date_parse($data->week_ending, 'F d,Y')); ?></td>
              <td>
                <?php if($data->sugar_sample_id == $sugar_samples_static['cja']): ?>
                  <?php if($data->caneJuiceAnalysis->isEmpty()): ?>
                    <span class="label label-warning">PENDING</span>
                  <?php else: ?>
                    <span class="label label-success">ANALYZED</span> 
                  <?php endif; ?>
                <?php else: ?>
                  <?php if($data->status == "PENDING"): ?>
                    <span class="label label-warning">PENDING</span>
                  <?php elseif($data->status == "ANALYZED"): ?>
                    <span class="label label-success">ANALYZED</span> 
                  <?php endif; ?>
                <?php endif; ?>
              </td>
              <td>
                <a href="<?php echo e(route('dashboard.sugar_analysis.edit', $data->slug)); ?>" type="button" class="btn btn-default btn-sm">Fill Results</a>
                <a href="<?php echo e(route('dashboard.sugar_analysis.show', $data->slug)); ?>" type="button" class="btn btn-default btn-sm">Print</a>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </table>
      </div>

      <?php if($sugar_analysis->isEmpty()): ?>
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      <?php endif; ?>

      <div class="box-footer">
        <?php echo __html::table_counter($sugar_analysis); ?>

        <?php echo $sugar_analysis->appends($appended_requests); ?>

      </div>

    </div>

  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>