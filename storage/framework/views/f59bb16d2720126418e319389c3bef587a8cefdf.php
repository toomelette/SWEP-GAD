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
      <h3 class="box-title"><b>Details</b></h3>
      <div class="box-tools">
        <a href="<?php echo e(route('dashboard.sugar_analysis.cane_juice_analysis_print', $sugar_analysis->slug)); ?>" class="btn btn-sm btn-default" target="_blank">
          <i class="fa fa-print"></i> Print
        </a>&nbsp;
        <a href="<?php echo e(route('dashboard.sugar_analysis.edit', $sugar_analysis->slug)); ?>" class="btn btn-sm btn-default">
          <i class="fa fa-pencil"></i> Edit
        </a>
      </div>
    </div>

    <div class="box-body">

      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Order of Payment Info</h3>
          </div>
          <div class="box-body">
            <dl class="dl-horizontal">
              <dt>OR No.:</dt>
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
            </dl>
          </div>
        </div>
      </div> 



      <div class="col-md-12" style="margin-top:10px;">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Cane Juice Analysis</h3>
          </div>
          
          <div class="box-body">
            <table class="table table-hover">
              <tr>
                <th>Entry No.</th>
                <th>Date Submitted</th>
                <th>Date Sampled</th>
                <th>Date Analyzed</th>
                <th>Variety</th>
                <th>Hacienda</th>
                <th>Corrected Brix</th>
                <th>% POL</th>
                <th>Purity</th>
                <th>Remarks</th>
              </tr>
              <?php $__currentLoopData = $sugar_analysis->caneJuiceAnalysis->sortBy('entry_no'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <tr>
                  <td><?php echo e($data->entry_no); ?></td>
                  <td><?php echo e(__dataType::date_parse($data->date_submitted, '  m/d/Y')); ?></td>
                  <td><?php echo e(__dataType::date_parse($data->date_sampled, '  m/d/Y')); ?></td>
                  <td><?php echo e($data->date_analyzed); ?></td>
                  <td><?php echo e($data->variety); ?></td>
                  <td><?php echo e($data->hacienda); ?></td>
                  <td><?php echo e($data->corrected_brix); ?></td>
                  <td><?php echo e($data->polarization); ?></td>
                  <td><?php echo e($data->purity); ?></td>
                  <td><?php echo e($data->remarks); ?></td>
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