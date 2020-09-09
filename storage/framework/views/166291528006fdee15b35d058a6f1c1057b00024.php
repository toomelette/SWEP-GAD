<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title"><?php echo e($scholars->lastname); ?>, <?php echo e($scholars->firstname); ?> <?php echo e($scholars->middlename); ?></h4>
</div>

<div class="modal-body">
	<div class="well well-sm">
		<div class="row">
			<div class="col-md-4">
				<dl class="no-margin">
					<dt>Scholarship applied for:</dt>
					<dd>
						<?php switch($scholars->scholarship_applied):
							case ('CHED-U'): ?>
								CHED - Undergraduate Degree
								<?php break; ?>
							<?php case ('CHED-G'): ?>	
								CHED - Graduate Degree
								<?php break; ?>
							<?php default: ?>
								<?php echo e($scholars->scholarship_applied); ?>

								<?php break; ?>
						<?php endswitch; ?>
					</dd>
				</dl>
			</div>
			<div class="col-md-4">
				<dl class="no-margin">
					<dt>Title of course applied for:</dt>
					<dd><?php echo e($scholars->course_applied); ?></dd>
				</dl>
			</div>

			<div class="col-md-4">
				<dl class="no-margin">
					<dt>Name of State University/College:</dt>
					<dd><?php echo e($scholars->school); ?></dd>
				</dl>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6" style="height: auto !important;">
			<div class="well well-sm" >
				<dl class="dl-horizontal no-margin">
					<p class="page-header-sm text-center on-well text-info">
						Scholar Information
					</p>

					<dt>Last Name:</dt>
					<dd><?php echo e($scholars->lastname); ?></dd>

					<dt>First Name:</dt>
					<dd><?php echo e($scholars->firstname); ?></dd>

					<dt>Middle Name:</dt>
					<dd><?php echo e($scholars->middlename); ?></dd>

					<dt>Date of Birth:</dt>
					<dd><?php echo e(date("F d, Y",strtotime($scholars->birth))); ?></dd>

					<dt>Age:</dt>
					<dd><?php echo e($scholars->age); ?></dd>

					<dt>Sex:</dt>
					<dd><?php echo e($scholars->sex); ?></dd>

					<dt>Status:</dt>
					<dd><?php echo e($scholars->civil_status); ?></dd>

					<p class="page-header-sm text-center on-well text-info">
						Address
					</p>

					<dt>Mill District:</dt>
					<dd> <?php echo e(isset($scholars->millDistrict->mill_district) ? $scholars->millDistrict->mill_district : $scholars->mill_district); ?></dd>

					<dt>Province:</dt>
					<dd> <?php echo e($scholars->address_province); ?></dd>

					<dt>City/Municipality:</dt>
					<dd> <?php echo e($scholars->address_city); ?></dd>

					<dt>Detailed address:</dt>
					<dd> <?php echo e($scholars->address_specific); ?></dd>

					<dt>Years living in address:</dt>
					<dd> <?php echo e($scholars->address_no_years); ?></dd>


				</dl>
			</div>
		</div>
		<div class="col-md-6">
			<div class="well well-sm">
				<dl class="dl-horizontal no-margin">
					

					<p class="page-header-sm text-center on-well text-info">
						Occupation
					</p>

					<dt>Occupation:</dt>
					<dd>
						<?php echo __html::check_null($scholars->occupation); ?>

					</dd>

					<dt>Name of Company:</dt>
					<dd>
						<?php echo __html::check_null($scholars->office_name); ?>

					</dd>

					<dt>Office address:</dt>
					<dd>
						<?php echo __html::check_null($scholars->office_address); ?>

					</dd>

					<dt>Office phone no.:</dt>
					<dd>
						<?php echo __html::check_null($scholars->office_phone); ?>

					</dd>

				</dl>
			</div>
		</div>
	</div>
	<p class="page-header-sm text-center text-info">
		Information of immediate relative
	</p>

	<div class="row">
		<div class="col-md-4">
			<div class="well well-sm">
				<dl class="no-margin">
					<dt>Mother's Name:</dt>
					<dd>
						<?php echo __html::check_null($scholars->mother_name); ?>

					</dd>

					<dt>Phone no.:</dt>
					<dd>
						<?php echo __html::check_null($scholars->mother_phone); ?>

					</dd>
				</dl>
			</div>
		</div>

		<div class="col-md-4">
			<div class="well well-sm">
				<dl class="no-margin">
					<dt>Father's Name:</dt>
					<dd>
						<?php echo __html::check_null($scholars->father_name); ?>

					</dd>

					<dt>Phone no.:</dt>
					<dd>
						<?php echo __html::check_null($scholars->father_phone); ?>

					</dd>
				</dl>
			</div>
		</div>

		<div class="col-md-4">
			<div class="well well-sm">
				<dl class="no-margin">
					<dt>Spouse's Name:</dt>
					<dd>
						<?php echo __html::check_null($scholars->spouse_name); ?>

					</dd>

					<dt>Phone no.:</dt>
					<dd>
						<?php echo __html::check_null($scholars->spouse_phone); ?>

					</dd>
				</dl>
			</div>
		</div>

	</div>
</div>

<div class="modal-footer">
	<div class="row">
		<?php echo __html::timestamp($scholars ,"4"); ?> 

		<div class="col-md-4">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
