<?php $__env->startSection('body'); ?>
<style type="text/css">
  .date{
    text-align: left
  }
  .numbering{
    width: 10px;
  }

  .members, .male_members, .female_members{
    width: 8%
  }
  @media  print{
    .noPrint{
      display: none
    }
  }
</style>
  <div style="">
    <div id="loader">
      <center>
        <img style="width: 300px; margin: 40px 0;" src="<?php echo __static::loader(Auth::user()->color); ?>">
      </center>
    </div>
  </div>

  <div style="" id="content">
    <div class="row">
      <div class="col-md-12">
        <div class="row" >
          <br>
          <?php if(!empty($block_farms_group)): ?>
            <?php $__currentLoopData = $block_farms_group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $block_farms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(count($block_farms) > 0): ?>
                <div class="col-md-12" style="break-after: page;">
                

                  <?php echo $__env->make('printables.header_sra', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                  <p><b><?php echo e(strtoupper($key)); ?> Block Farms</b></p>
                  <p class="text-left" style="font-weight: bold">Total: <?php echo e(count($block_farms)); ?> <?php echo e(ucfirst($key)); ?> Block Farms
                    <span class="pull-right">

                      <?php if(count($filters) > 0 ): ?>
                        Filters:
                        <span style="color:red !important">
                          <?php  
                            $last_element = end($filters);
                          ?>
                          <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($filter); ?><?php if($filter != $last_element): ?>,<?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </span>
                      <?php endif; ?>
                      
                    </span>
                  </p>
                  <table class="table table-bordered">
                     <thead class="">
                      <tr class="text-strong">
                        <?php if(!empty($columns_chosen)): ?>
                          <?php if(in_array("numbering", $columns_chosen)): ?>
                            <th>#</th>
                          <?php endif; ?>
                        <?php endif; ?>
                        
                        <th>Block Farm</th>
                        
                        <?php if(!empty($columns_chosen)): ?>
                          <?php $__currentLoopData = $columns_chosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column_chosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php switch($column_chosen):
                              case ("numbering"): ?>
                                <?php break; ?>
                              <?php default: ?>
                                <th><?php echo e(array_search($column_chosen, $columns)); ?></th>
                                <?php break; ?>
                            <?php endswitch; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($block_farms)): ?>
                          <?php
                            $num = 0;
                          ?>
                        <?php $__currentLoopData = $block_farms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $block_farm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php
                            $num++;
                          ?>
                          <tr>
                            <?php if(!empty($columns_chosen)): ?>
                              <?php if(in_array("numbering", $columns_chosen)): ?>
                                <td class="numbering text-left"><?php echo e($num); ?></td>
                              <?php endif; ?>
                            <?php endif; ?>

                            <td class="text-left">
                              <?php echo e($block_farm->block_farm_name); ?>

                            </td>

                            <?php if(!empty($columns_chosen)): ?>
                              <?php $__currentLoopData = $columns_chosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column_chosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php switch($column_chosen):
                                  case ("date"): ?>
                                    <td class=" <?php echo e($column_chosen); ?>"><?php echo e(date("M. d, Y",strtotime($block_farm->$column_chosen))); ?></td>
                                    <?php break; ?>

                                  <?php case ("mill_district"): ?>
                                    <td class="text-left <?php echo e($column_chosen); ?>"><?php echo e(isset($block_farm->millDistrict->mill_district) ? $block_farm->millDistrict->mill_district : $block_farm->mill_district); ?></td>
                                    <?php break; ?>
                                  <?php case ('members'): ?>
                                    <td class="<?php echo e($column_chosen); ?>">
                                      <?php echo e(count($block_farm->blockFarmMembers)); ?>

                                    </td>
                                    <?php break; ?>


                                  <?php case ('male_members'): ?>
                                    <td class="<?php echo e($column_chosen); ?>">
                                      <?php echo e(count($block_farm->blockFarmMembers->where('sex','=',"MALE"))); ?>

                                    </td>
                                    <?php break; ?>
                                  <?php case ('female_members'): ?>
                                    <td class="<?php echo e($column_chosen); ?>">
                                      <?php echo e(count($block_farm->blockFarmMembers->where('sex','=',"FEMALE"))); ?>

                                    </td>
                                    <?php break; ?>


                                  <?php case ("numbering"): ?>
                                    <?php break; ?>
                                  <?php default: ?>
                                    <td class="text-left <?php echo e($column_chosen); ?>"><?php echo e($block_farm->$column_chosen); ?></td>
                                <?php endswitch; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                  <hr class="noPrint" style="border: 1px dashed blue !important">
                </div>

              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> No data!</h4>
              We have not found any data based on your filters.
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#loader").fadeOut(function(){
        $("#content").fadeIn(1000);
      })
    })
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('printables.print_layout_no_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>