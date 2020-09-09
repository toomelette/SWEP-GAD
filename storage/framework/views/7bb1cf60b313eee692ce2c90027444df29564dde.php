<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><?php echo e($bf_member->lastname); ?>, <?php echo e($bf_member->firstname); ?></h4>
  </div>
  <div class="modal-body">
  	<div class="nav-tabs-custom">
  		<ul class="nav nav-tabs">
  			<li class="active"><a href="#tab_31" data-toggle="tab">Farmer information</a></li>
  			<li><a href="#tab_32" data-toggle="tab">Family Members</a></li>
  		</ul>
  		<div class="tab-content">
  			<div class="tab-pane active" id="tab_31">
  				<div class="well well-sm bg-white">
            <div class="row">
              <div class="col-md-6">
                <dl class=" dl-horizontal">
                  <dt>Last Name:</dt>
                  <dd><?php echo e($bf_member->lastname); ?></dd>

                  <dt>First Name:</dt>
                  <dd><?php echo e($bf_member->firstname); ?></dd>

                  <dt>Middle Name:</dt>
                  <dd><?php echo e($bf_member->middlename); ?></dd>

                  <dt>Birthday:</dt>
                  <dd><?php echo e(date("M. d, Y", strtotime($bf_member->bday))); ?></dd>

                  <dt>Age:</dt>
                  <dd><?php echo e($bf_member->age); ?> year(s) old</dd>

                  <dt>Sex:</dt>
                  <dd><?php echo e($bf_member->sex); ?></dd>

                  <dt>Civil Status:</dt>
                  <dd><?php echo e($bf_member->civil_status); ?></dd>

                </dl>
              </div>

              <div class="col-md-6">
                <dl class=" dl-horizontal">
                  <dt>Educational Att.:</dt>
                  <dd><?php echo e($bf_member->educ_att); ?></dd>

                  <dt>Sugarcane Farming:</dt>
                  <dd><?php echo e($bf_member->years_sugarcane_farming); ?> year(s)</dd>

                  <dt>Tenurial Status:</dt>
                  <dd><?php echo e($bf_member->tenurial); ?></dd>

                  <dt>No. of Family Members:</dt>
                  <dd><?php echo e($bf_member->maleFamilyMembers->count() + $bf_member->femaleFamilyMembers->count()); ?></dd>

                  <dt>Male Family Members:</dt>
                  <dd><?php echo e($bf_member->maleFamilyMembers->count()); ?></dd>

                  <dt>Female Family Members:</dt>
                  <dd><?php echo e($bf_member->femaleFamilyMembers->count()); ?></dd>

                </dl>
              </div>
            </div>
          </div>
  			</div>
  				<!-- /.tab-pane -->
  				<div class="tab-pane" id="tab_32">
  					<?php if(!empty($bf_member->familyMembers)): ?>
              <?php if($bf_member->familyMembers->count() > 0): ?>
                <table class="table table-bordered bg-white">
                  <thead>
                    <tr class="<?php echo __static::bg_color(Auth::user()->color); ?>">
                      <th>Fullname</th>
                      <th>Sex</th>
                      <th>Birthday</th>
                      <th>Age</th>
                      <th>Civil Status</th>
                      <th>Economic Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $bf_member->familyMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $familyMember): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td>
                          <?php echo e($familyMember->lastname); ?> , 
                          <?php echo e($familyMember->firstname); ?>

                          <?php echo e($familyMember->middlename); ?>

                        </td>
                        <td>
                          <?php echo __html::sex($familyMember->sex); ?>

                        </td>
                        <td>
                          <?php echo e($familyMember->bday); ?>

                        </td>
                        <td>
                          <?php echo e(\Carbon::parse($familyMember->bday)->age); ?> 
                        </td>
                        <td>
                          <?php echo e($familyMember->civil_status); ?>

                        </td>
                        <td>
                          <?php echo e($familyMember->eco_status); ?>

                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              <?php else: ?>
                <div class="callout callout-success">
                  <h4>No family members added to <?php echo e($bf_member->firstname); ?></h4>

                  <p>You can add using edit button found on the table.</p>
                </div>
              <?php endif; ?>
            <?php endif; ?>
  				</div>
  				<!-- /.tab-pane -->
  			</div>
  			<!-- /.tab-content -->
  		</div>
    </div>
  <div class="modal-footer">
  	<div class="row">
  		<?php echo __html::timestamp($bf_member ,"4"); ?>

  		<div class="col-md-4">
  			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  		</div>
  	</div>
    
  </div>
</div>