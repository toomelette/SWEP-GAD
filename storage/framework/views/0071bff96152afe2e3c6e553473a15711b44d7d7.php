<?php
  
  $sugar_samples_static = __static::sugar_samples();
  $sugar_services_static = __static::sugar_services();
  
?>



<?php $__env->startSection('content'); ?>

<section class="content-header">
  <h1>Sugar Analysis Details</h1>
  <div class="pull-right" style="margin-top: -25px;">
    <?php echo __html::back_button(['dashboard.sugar_analysis.index']); ?>

  </div>
</section>

<section class="content">
  
  <div class="box">
        
    <div class="box-header with-border">
      <h3 class="box-title">Details</h3>
      <div class="box-tools">
        <a href="<?php echo e(route('dashboard.sugar_analysis.print', $sugar_analysis->slug)); ?>" class="btn btn-sm btn-default" target="_blank">
          <i class="fa fa-print"></i> Print
        </a>&nbsp;
        <a href="<?php echo e(route('dashboard.sugar_analysis.edit', $sugar_analysis->slug)); ?>" class="btn btn-sm btn-default">
          <i class="fa fa-pencil"></i> Edit
        </a>
      </div>
    </div>

    <div class="box-body">

      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Order of Payment Info</h3>
          </div>
          <div class="box-body">
            <dl class="dl-horizontal">
              <dt>OR #:</dt>
              <dd><?php echo e($sugar_analysis->or_no); ?></dd>
              <dt>Date:</dt>
              <dd><?php echo e(__dataType::date_parse($sugar_analysis->date, 'F d,Y')); ?></dd>
              <dt>Sample No:</dt>
              <dd><?php echo e($sugar_analysis->sample_no); ?></dd>
              <dt>Origin/Mill Company:</dt>
              <dd><?php echo e($sugar_analysis->origin); ?></dd>
              <dt>Address:</dt>
              <dd><?php echo e($sugar_analysis->address); ?></dd>
              <dt>Kind of Sample:</dt>
              <dd><?php echo e(optional($sugar_analysis->sugarSample)->name); ?></dd>

              <?php if($sugar_analysis->sugar_sample_id == $sugar_samples_static['muscovado']): ?> 
                <dt>Code:</dt>
                <dd><?php echo e($sugar_analysis->code); ?></dd>
              <?php endif; ?>

              <?php if($sugar_analysis->sugar_sample_id == $sugar_samples_static['molasses']): ?> 
                <dt>Source:</dt>
                <dd><?php echo e($sugar_analysis->source); ?></dd>
              <?php endif; ?>

              <dt>Quantity:</dt>
              <dd><?php echo e(number_format($sugar_analysis->quantity_mt, 3)); ?> MT</dd>
              <dt>Week Ending:</dt>
              <dd><?php echo e(__dataType::date_parse($sugar_analysis->week_ending, 'F d,Y')); ?></dd>
              <dt>Date Submitted:</dt>
              <dd><?php echo e(__dataType::date_parse($sugar_analysis->date_submitted, 'F d,Y')); ?></dd>
              <dt>Date Sampled:</dt>
              <dd><?php echo e(__dataType::date_parse($sugar_analysis->date_sampled, 'F d,Y')); ?></dd>
              <dt>Date Analyzed:</dt>
              <dd><?php echo e($sugar_analysis->date_analyzed); ?></dd>
              <dt>Description of Sample:</dt>
              <dd><?php echo e($sugar_analysis->description); ?></dd>
            </dl>
          </div>
        </div>
      </div> 



      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Services</h3>
          </div>
          <div class="box-body">

            <table class="table table-bordered">
              
              <tr>
                  <th>Parameters</th>
                  <th>Results</th>
                  <th>Standards</th>
              </tr>  

              <?php $__currentLoopData = $sugar_analysis->sugarAnalysisParameter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($data->name); ?></td>
                    <td>
                      <?php if($data->sugar_service_id == $sugar_services_static['mois']): ?>
                        <?php echo e(number_format($data->moisture_result_dec, 2) .' / '. number_format($data->moisture_sf_dec, 2)); ?>

                      <?php else: ?>
                        <?php echo e(number_format($data->result_dec, 2)); ?>

                      <?php endif; ?>
                    </td>
                    <td><?php echo e($data->standard_str); ?></td>
                </tr> 
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </table>

          </div>
        </div>
      </div>



    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>