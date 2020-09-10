<?php $__env->startSection('body'); ?>
<style type="text/css">
  .block_farm{
  	text-align: left
  }
  .date{
    text-align: left
  }
  .numbering{
    width: 10px;
  }

  .enrolee_name{
  	text-align: left
  }

  .mill_district{
  	text-align: left
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


	<div style="" id="content">
		<div class="row">
		  <div class="col-md-12">
		    <b>LIST OF ALL BLOCK FARMS</b>


		    <div class="row">
		      <br>
		      <div class="col-md-12">
		        <table class="table table-bordered">
		          <thead class="">

		            <?php if(!empty($columns_chosen)): ?>

	                    <?php if(in_array("numbering", $columns_chosen)): ?>
	                      <th>#</th>
	                    <?php endif; ?>

	                    <th>Block Farm</th>
		            	<?php $__currentLoopData = $columns_chosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column_chosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		            		<?php if($column_chosen != "numbering"): ?>
		            			 <th><?php echo e(array_search($column_chosen, $columns)); ?></th>
		            		<?php endif; ?>
		            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		            <?php endif; ?>
		          </thead>
		          <tbody>
		          	<?php
		          		$num = 0;

					    	// $key = array_search("numbering", $columns_chosen);

					    	// unset($columns_chosen[$key]);
		
		          	?>
		          	<?php if(!empty($block_farms)): ?>
		          		<?php $__currentLoopData = $block_farms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block_farm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		          			<?php $num++ ?>
		          			<tr>
		          				<?php if(in_array("numbering", $columns_chosen)): ?>
				                    <th><?php echo e($num); ?></th>
				                <?php endif; ?>
		          				<td class="block_farm"><?php echo e($block_farm->block_farm_name); ?></td>

		          				<?php if(!empty($columns_chosen)): ?>
		          					<?php $__currentLoopData = $columns_chosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column_chosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		          						<?php if($column_chosen != 'numbering'): ?>
		          							<?php switch($column_chosen):
		          								case ('date'): ?>
		          									<td class="<?php echo e($column_chosen); ?>">
		          										<?php echo e(date("M. d, Y",strtotime($block_farm->$column_chosen))); ?>

		          									</td>
		          									<?php break; ?>
		          								<?php case ('enrolee_name'): ?>
		          									<td class="<?php echo e($column_chosen); ?>">
		          										<?php echo e($block_farm->$column_chosen); ?>

		          									</td>
		          									<?php break; ?>
		          								<?php case ('mill_district'): ?>
		          									<td class="<?php echo e($column_chosen); ?>">
			          									<?php echo e(isset($block_farm->millDistrict->mill_district) ? $block_farm->millDistrict->mill_district : $block_farm->mill_district); ?>

			          								</td>
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

		          								<?php default: ?>

		          								<td class="<?php echo e($column_chosen); ?>">
		          									<?php echo e($block_farm->$column_chosen); ?>

		          								</td>


		          							<?php endswitch; ?>
			          					<?php endif; ?>

		          					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		          				<?php endif; ?>
		          			</tr>
		          		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		          	<?php endif; ?>

		          </tbody>
		        </table>
		      </div>
		    </div>
		  </div>
		</div>  
	</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('printables.print_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>