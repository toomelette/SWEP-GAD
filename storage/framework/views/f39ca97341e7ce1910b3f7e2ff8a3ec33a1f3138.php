<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Reorder Menus</h4>
</div>
<div class="modal-body">
	<p class="text-primary">Drag the <i class="fa fa-arrows"></i> icon to rearrange.</p>
	<ol id="sort_menus" class="sortable todo-list">
		<?php
			$menus = $menus->sortBy('order');	
		?>

		<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($menu->is_menu != 0): ?>
				<li data="<?php echo e($menu->slug); ?>">
			      <span class="handle ui-sortable-handle">
			            <i class="fa fa-arrows"></i>
			       </span>
			      <span class="text"><?php echo e($menu->name); ?></span>
			    </li>
		    <?php endif; ?>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ol>


</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

	<button type="button" class="btn btn-primary submit_reorder_btn"> <i class="fa fa-save"></i> Save</button>
</div>