<?php $__env->startSection('content'); ?>

<section class="content-header">
  <h1>Order Of Payment Details</h1>
  <div class="pull-right" style="margin-top: -25px;">
    <?php echo __html::back_button(['dashboard.sugar_order_of_payment.index']); ?>

  </div>
</section>

<section class="content">
  
  <div class="box">
        
    <div class="box-header with-border">
      <h3 class="box-title">Details</h3>
      <div class="box-tools">
        <a href="<?php echo e(route('dashboard.sugar_order_of_payment.print', $sugar_oop->slug)); ?>" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print</a>&nbsp;
        <a href="<?php echo e(route('dashboard.sugar_order_of_payment.edit', $sugar_oop->slug)); ?>" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
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
              <dt>Date:</dt>
              <dd><?php echo e(__dataType::date_parse($sugar_oop->date, 'F d,Y')); ?></dd>
              <dt>Sample No:</dt>
              <dd><?php echo e($sugar_oop->sample_no); ?></dd>
              <dt>Received From:</dt>
              <dd><?php echo e($sugar_oop->received_from); ?></dd>
              <dt>Address:</dt>
              <dd><?php echo e($sugar_oop->address); ?></dd>
              <dt>Kind of Sample:</dt>
              <dd><?php echo e(optional($sugar_oop->sugarSample)->name); ?></dd>
              <dt>Received By:</dt>
              <dd><?php echo e($sugar_oop->received_by); ?></dd>
            </dl>
          </div>
        </div>
      </div> 




      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Parameters</h3>
          </div>
          <div class="box-body">

            <table class="table table-bordered">
              
              <tr>
                  <th>Name</th>
                  <th>Price</th>
              </tr>  

              <?php $__currentLoopData = $sugar_oop->sugarAnalysisParameter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($data->name); ?></td>
                    <td><?php echo e(number_format($data->price, 2)); ?></td>
                </tr> 
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <tr>
                  <td><b>Total Price</b></td>
                  <td><b><?php echo e(number_format($sugar_oop->total_price, 2)); ?></b></td>
              </tr>

            </table>

          </div>
        </div>
      </div>



    </div>

  </div>

</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>