<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">×</span></button>
  <h4 class="modal-title"><?php echo e($seminar->title); ?></h4>
</div>
<div class="modal-body">
	<div class="well well-sm">

		<dl class="dl-horizontal">
	        <dt>Title:</dt>
	        <dd><?php echo e($seminar->title); ?></dd>

	        <dt>Mill District:</dt>
	        <dd><?php echo e(isset($seminar->millDistrict->mill_district) ? $seminar->millDistrict->mill_district : 'N/A'); ?></dd>

	        <dt>Sponsor:</dt>
	        <dd><?php echo e($seminar->sponsor); ?></dd>
	       
	       	<dt>Venue:</dt>
	        <dd><?php echo e($seminar->venue); ?></dd>

	        <dt>Date from:</dt>
	        <dd> <?php echo e(date('F d, Y', strtotime($seminar->date_covered_from))); ?> </dd>

	        <dt>Date to:</dt>
	        <dd><?php echo e(date('F d, Y', strtotime($seminar->date_covered_to))); ?></dd>
	     </dl>
	</div>
	

	<?php if($seminar->seminarSpeaker->count() > 0): ?>
		<div class="well well-sm">
			<p class="text-center"> <b>Speakers</b> </p>
			<hr class="no-margin">
			<table class="table  table-bordered" style="background-color: white">
				<thead>
					<th>Speaker</th>
					<th>Topic</th>
				</thead>
				<tbody>
					<?php $__currentLoopData = $seminar->seminarSpeaker; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td> <?php echo e($data->fullname); ?> </td>
							<td> <?php echo e($data->topic); ?> </td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
			
		</div>

	<?php else: ?>
		<div class="well well-sm">
			<p class="text-center"> <b>No speaker for this seminar</b> </p>
		</div>

	<?php endif; ?>

	
	<hr>

		<?php if(!empty($seminar->attendance_sheet_filename) && $file_details['exists'] == 'true' ): ?>
			<div class="text-center">
				<label> Attendance Sheet Scanned File</label>
			</div>
			
			<div class="clearfix attatchment-horizontal">
				<div>
					<span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
				</div>
				<div>
					<div class="mailbox-attachment-info">
				        <a href="<?php echo e(route('dashboard.seminar.download_attendance_sheet', $seminar->slug)); ?>?new=<?php echo e(md5(uniqid(rand(), true))); ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <?php echo e($seminar->attendance_sheet_filename); ?> </a>
			            <span class="mailbox-attachment-size" >
			              <?php echo e($file_details['size']); ?>

			              <a href="<?php echo e(route('dashboard.seminar.download_attendance_sheet', $seminar->slug)); ?>?new=<?php echo e(md5(uniqid(rand(), true))); ?>" target="_blank" class="download_attendance btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download fa-fw"></i> Download</a>
			              <a style="margin-right: 5px" href="<?php echo e(route('dashboard.seminar.view_attendance_sheet', $seminar->slug)); ?>" target="_blank" class="download_attendance btn btn-default btn-xs pull-right"><i class="fa fa-file-text fa-fw"></i> View</a>
			            </span>
				      </div>
				</div>		
			</div>
		<?php else: ?>
			<?php if($file_details['exists'] == 'false'): ?>
				<div class="text-center text-warning">
					<label>
						<i class="fa fa-info-circle"></i> File not found.
					</label>
				</div>
			<?php else: ?>
				<div class="text-center text-blue">
					<label>
						<i class="fa  fa-info-circle"></i> 
						No attendance sheet attached.
					</label>
				</div>
			<?php endif; ?>

		<?php endif; ?>
</div>
<div class="modal-footer">
	<div class="row">
		<?php echo __html::timestamp($seminar ,"5"); ?>


		<div class="col-md-2">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>