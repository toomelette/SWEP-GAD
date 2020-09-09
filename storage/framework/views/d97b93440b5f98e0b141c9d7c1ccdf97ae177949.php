<form id="edit_bf_member_form" data = "<?php echo e($bf_member->slug); ?>">
  <?php echo csrf_field(); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><?php echo e($bf_member->lastname); ?>, <?php echo e($bf_member->firstname); ?> <?php echo e(substr($bf_member->middlename, 0, 1)); ?>.</h4>
  </div>
  <div class="modal-body">
    <div class="row">

      <div class="col-md-8">
        <label>Block Farm *</label>
        <div class="input-group block_farm except has-success">
          <input autocomplete="off" name="block_farm" placeholder="Block Farm the farmer belongs to" type="text" class="form-control block_farm_search" value="<?php echo e($bf_member->blockFarm->block_farm_name); ?>" readonly="">
          <span class="input-group-btn">
            <button  type="button" class="btn btn-warning btn-flat clear_btn"data="edit">
              <i class="fa fa-times"></i>
            </button>
          </span>
        </div>
      </div>
      

      <?php
        $start = date("Y", strtotime(date("Y-m-d")."- 15 years")); 
        $end = date("Y", strtotime(date("Y-m-d")."+ 2 years"));
        $years = [];

        for ($i = $start; $i < $end; $i++){
          $years[$i] = $i;
        }
      ?>

      <?php echo __form::select_static(
        '4 crop_year', 'crop_year', 'Crop Year *', date('Y'), $years, $errors->has('is_menu'), $errors->first('is_menu'), '', ''
      ); ?>

    </div>

    <div class="block_farm_details_container" style="">
      <div class="well well-sm">
        <div class="box box-solid" style="margin-bottom: 5px">
          <div class="box-header with-border">
            <i class="fa icon-farm"></i>
            <h4 class="box-title">Block Farm Details</h4>
          </div>
            <!-- /.box-header -->
          <div class="box-body">
            <dl>
              <div class="row">
                <div class="col-md-5">
                   <dt>Block Farm Name:</dt>
                   <dd><?php echo e($bf_member->blockFarm->block_farm_name); ?></dd>
                </div>
                <div class="col-md-3">
                  <dt>Mill District</dt>
                  <dd><?php echo e($bf_member->blockFarm->millDistrict->mill_district); ?></dd>
                </div>
                <div class="col-md-4">
                  <dt>Enrolee</dt>
                  <dd><?php echo e($bf_member->blockFarm->enrolee_name); ?></dd>
                </div>
              </div>
            </dl>
          </div>
            <!-- /.box-body -->
        </div>
      </div>
    </div>
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_11" data-toggle="tab">Farmer's Info</a></li>
        <li><a href="#tab_22" data-toggle="tab">Family Members</a></li>
        <li><a href="#tab_23" data-toggle="tab">Farm and Business</a></li>                  
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_11">
          <div class="row">
            <?php echo __form::textbox(
              '3 lastname', 'lastname', 'text', 'Last Name', 'Last Name', $bf_member->lastname, '' , $errors->first('title'), ''
            ); ?>

            <?php echo __form::textbox(
              '3 firstname', 'firstname', 'text', 'First Name', 'First Name', $bf_member->firstname, '' , $errors->first('title'), ''
            ); ?>


            <?php echo __form::textbox(
              '3 middlename', 'middlename', 'text', 'Middle Name', 'Middle Name', $bf_member->middlename, '' , $errors->first('title'), ''
            ); ?>

            <?php echo __form::datepicker(
              '3 bday', 'bday',  'Birthday *', $bf_member->bday, $errors->has('date_covered_from'), $errors->first('date_covered_from')
            ); ?>

          </div>
          <div class="row">
            <?php echo __form::select_static(
              '2 sex', 'sex', 'Sex*', $bf_member->sex, 
              [
                "MALE" => "MALE",
                "FEMALE" => "FEMALE"
              ]
              , $errors->has('is_menu'), $errors->first('is_menu'), '', ''
            ); ?>


            <?php echo __form::select_static(
              '2 civil_status', 'civil_status', 'Civil Status*', $bf_member->civil_status, [
                'Single' => 'Single',
                'Married' => 'Married',
                'Divorced' => 'Divorced',
                'Separated' => 'Separated',
                'Widowed' => 'Widowed'               
              ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
            ); ?>


            <?php echo __form::select_static(
              '3 educ_att', 'educ_att', 'Educational Attainment*', $bf_member->educ_att, [
                'Doctoral Degree' => 'Doctoral Degree', 
                'Masteral Degree' => 'Masteral Degree', 
                'College Graduate' => 'College Graduate', 
                'College Level' => 'College Level', 
                'High School Graduate' => 'High School Graduate', 
                'High School Level' => 'High School Level',
                'Elementary Graduate' => 'Elementary Graduate',
                'Pre-Elementary' => 'Pre-Elementary',
                'None' => 'None'
                
              ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
            ); ?>


            <?php echo __form::textbox(
              '3 years_sugarcane_farming', 'years_sugarcane_farming', 'number', 'Years in Sugarcane Farming', 'No. of Years in Sugarcane Farming', $bf_member->years_sugarcane_farming, $errors->has('title'), $errors->first('title'), ''
            ); ?>


            <?php echo __form::select_static(
              '2 tenurial', 'tenurial', 'Tenurial Status*',$bf_member->tenurial, [
                'Private-leased' => 'Private-leased', 
                'Owned and Individually managed' => 'Owned and Individually managed', 
                'CLOA Holder and lessee' => 'CLOA Holder and lessee', 
                'CLOA on process' => 'CLOA on process', 
                'Others' => 'Others'
                
              ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
            ); ?>



          </div>
        </div>
        <div class="tab-pane" id="tab_22">
          <div class="row" style="margin-bottom: 15px">
            <div class="col-sm-12">
              <button type="button" data-toggle="modal" data-target="#add_family_modal_edit" class="btn btn-sm bg-purple pull-right">
                <i class="fa fa-plus"></i> Add family member
              </button>
            </div>
          </div>

          <table class="table table-bordered table-striped table-hover" id="family_table_edit" style="width: 100% !important; font-size: 14px;">
            <thead>
              <tr>
                <th>Data</th>
                <th>Name</th>
                <th class="th-10">Sex</th>
                <th>Birthday</th>
                <th>Education</th>
                <th>Civil | Economic status</th>
                <th class="th-10">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($bf_member->familyMembers)): ?>
                <?php $__currentLoopData = $bf_member->familyMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $family_member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr id="member-<?php echo e($family_member->slug); ?>">
                  <td>
                    <?php
                      $data = [
                        'id' => 'member-'.$family_member->slug,
                        'lastname' => $family_member->lastname,
                        'firstname' => $family_member->firstname,
                        'middlename' => $family_member->middlename,
                        'sex' => $family_member->sex,
                        'bday' => date("m/d/Y",strtotime($family_member->bday)),
                        'educ_att' => $family_member->educ_att,
                        'civil_status' => $family_member->civil_status,
                        'eco_status' => $family_member->eco_status,
                      ];
                    ?>
                    <?php echo e(json_encode($data)); ?>

                  </td>
                  <td>
                    <?php echo e($family_member->lastname); ?>, <?php echo e($family_member->firstname); ?> <?php echo e(substr($family_member->middlename, 0, 1)); ?>.
                  </td>
                  <td><?php echo e($family_member->sex); ?></td>
                  <td><?php echo e(date("m/d/Y",strtotime($family_member->bday))); ?></td>
                  <td><?php echo e($family_member->educ_att); ?></td>
                  <td><?php echo e($family_member->civil_status); ?> | <?php echo e($family_member->eco_status); ?></td>
                  <td>
                    <div class="btn-group">
                      <button type="button" data="member-<?php echo e($family_member->slug); ?>" class="btn btn-default btn-sm edit_family_btn_edit" data-toggle="modal" data-target="#edit_family_modal_edit" title="" data-placement="top" data-original-title="Edit">
                        <i class="fa fa-edit"></i>
                      </button>
                      <button type="button" data="" class="btn btn-sm btn-danger remove_member_edit" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete">
                        <i class="fa fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        <div class="tab-pane" id="tab_23">
          <table class="6-9-tbl table-bordered x-tbl"  style="background-color: #dfccff87 !important">
            <thead>
              <tr >
                <th></th>
                <th class="text-center">
                  Sugarcane crop <i class="fa fa-question-circle" title="PC = Plant Cane | RC = Ratoon Cane"></i>
                </th>
                <th class="text-center">
                  Total farm area <i class="fa fa-question-circle" title="in ha."></i>
                </th>
                <th class="text-center">Variety Planted</th>
                <th class="text-center">Total TC</th>
                <th class="text-center">Total LKg</th>
                <th class="text-center">Molasses</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>a.</td>
                <td>
                  <input type='text' class='editable'>
                </td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
              </tr>
              <tr>
                <td>b.</td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
              </tr>
              <tr>
                <td>c.</td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
              </tr>
              <tr>
                <td>d.</td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
              </tr>
            </tbody>
          </table>
          <br>
          <div class="row">
            <?php echo __form::textbox(
              '3 sugar_per_bag', 'sugar_per_bag', 'text', 'Price of sugar per bag', 'Price of sugar per bag', old('title'), 'sugar_per_bag', $errors->first('title'), ''
            ); ?>


            <?php echo __form::textbox(
              '3 molasses_per_kg', 'molasses_per_kg', 'text', 'Price of mollases/kg', 'Price of mollases/kg', old('title'), 'molasses_per_kg', $errors->first('title'), ''
            ); ?>


            <?php echo __form::textbox(
              '3 planter_miller', 'planter_miller', 'text', 'Planter-Miller Sharing', 'Planter-Miller Sharing', old('title'), '', $errors->first('title'), ''
            ); ?>


            <?php echo __form::textbox(
              '3 income_sugarcane', 'income_sugarcane', 'text', 'Total income from sugarcane', 'Total income from sugarcane', old('title'), 'income_sugarcane', $errors->first('title'), ''
            ); ?>


          </div>

          <table class="14-19-tbl table-bordered"  style="background-color: #dfccff87 !important">
            <thead>
              <tr >
                <th></th>
                <th class="text-center">Other crops planted</th>
                <th class="text-center">
                  Total farm area <i class="fa fa-question-circle" title="in ha."></i>
                </th>
                <th class="text-center">Annual Income</th>
                <th class="text-center">Livestock Raised</th>
                <th class="text-center">No of heads</th>
                <th class="text-center">Annual Income</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>a.</td>
                <td><input type='text' name="wala" class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable autonum'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable autonum'></td>
              </tr>
              <tr>
                <td>b.</td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable autonum'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable autonum'></td>
              </tr>
              <tr>
                <td>c.</td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable autonum'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable autonum'></td>
              </tr>
              <tr>
                <td>d.</td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable autonum'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable'></td>
                <td><input type='text' class='editable autonum'></td>
              </tr>
            </tbody>
          </table>


        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn <?php echo __static::bg_color(Auth::user()->color); ?>"><i class="fa fa-save"></i> Save</button>
  </div>
</form>

<script type="text/javascript">
  chosen_bf_edit = "<?php echo e($bf_member->blockFarm->slug); ?>";


</script>