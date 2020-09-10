
<form id="edit_block_farm_form" autocomplete="off">
	<?php echo csrf_field(); ?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Edit</h4>
	</div>
	<div class="modal-body">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_21" data-toggle="tab">Block Farm Information</a></li>
				<li><a href="#tab_22" data-toggle="tab">Production Data</a></li>

			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_21">
					<div class="row">
		              	<?php echo __form::select_static(
		                  '4 mill_district', 'mill_district', 'Mill District: *', $block_farm->mill_district , $mill_districts_list , '', '', '', ''
		                ); ?>



		                <?php echo __form::textbox(
		                  '5 fund_source', 'fund_source', 'text', 'Source of Fund', 'Source of Fund', $block_farm->fund_source, $errors->has('title'), $errors->first('title'), ''
		                ); ?>


		                <?php echo __form::datepicker(
					      '3 date', 'date',  'Date *', date("Y-m-d",strtotime($block_farm->date)) , $errors->has('date_covered_from'), $errors->first('date_covered_from')
					    ); ?>



		                <?php echo __form::textbox(
		                  '6 block_farm_name', 'block_farm_name', 'text', 'Name of Block Farm', 'Name of Block Farm', $block_farm->block_farm_name, $errors->has('title'), $errors->first('title'), ''
		                ); ?>


		                <?php echo __form::textbox(
		                  '6 enrolee_name', 'enrolee_name', 'text', 'Name of Enrolee', 'Name of Enrolee', $block_farm->enrolee_name, $errors->has('title'), $errors->first('title'), ''
		                ); ?>


		                <?php echo __form::textbox(
		                  '8 address', 'address', 'text', 'Address', 'Address', $block_farm->address, $errors->has('title'), $errors->first('title'), ''
		                ); ?>


		               <?php echo __form::select_static(
		                  '4 educ_att', 'educ_att', 'Educational Attainment*', $block_farm->educ_att, [
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

		            </div>
		            <div class="row">
		                <?php echo __form::radio_sex('3 sex', 'sex', 'Sex','' , $block_farm->sex, ''); ?>


		                <?php echo __form::textbox(
		                  '2 age', 'age', 'number', 'Age', 'Age',$block_farm->age, $errors->has('title'), $errors->first('title'), ''
		                ); ?>



		                <?php echo __form::select_static(
		                  '3 civil_status', 'civil_status', 'Civil Status*', $block_farm->civil_status, [
		                    'Single' => 'Single',
		                    'Married' => 'Married',
		                    'Divorced' => 'Divorced',
		                    'Separated' => 'Separated',
		                    'Widowed' => 'Widowed'               
		                  ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
		                ); ?>


		                <?php echo __form::textbox(
		                  '4 religion', 'religion', 'text', 'Religion', 'Religion', $block_farm->religion, $errors->has('title'), $errors->first('title'), ''
		                ); ?>


		                
		              </div>
		              <div class="row">
		                <div class="col-md-12">
		                  <div class="row">
		                  <?php echo __form::textbox(
		                  '4 occupation', 'occupation', 'text', 'Occupation', 'Occupation *', $block_farm->occupation, $errors->has('title'), $errors->first('title'), ''
		                  ); ?>


		                  <?php echo __form::textbox(
		                    '4 annual_income', 'annual_income', 'text', 'Annual Income', 'Annual Income', $block_farm->annual_income, 'e_annual_income', $errors->first('title'), ''
		                  ); ?>


		                  <?php echo __form::textbox(
		                    '4 annual_expense', 'annual_expense', 'text', 'Annual Expense', 'Annual Expense', $block_farm->annual_expense, 'e_annual_expense', $errors->first('title'), ''
		                  ); ?>

		                  </div>                      
		                </div>                  
		              </div>

		              <div class="row">
		             
		                  <?php echo __form::textbox(
		                    '4 years_sugarcane_farming', 'years_sugarcane_farming', 'number', '# of Years in Sugarcane Farming', 'No. of Years in Sugarcane Farming', $block_farm->years_sugarcane_farming, $errors->has('title'), $errors->first('title'), ''
		                  ); ?>


		                  <?php echo __form::textbox(
		                    '4 male_family', 'male_family', 'number', '# of Male Family Member', 'No. of Male Family Member', $block_farm->male_family, $errors->has('title'), $errors->first('title'), ''
		                  ); ?>


		                  <?php echo __form::textbox(
		                    '4 female_family', 'female_family', 'number', '# of Female Family Member', 'No. of Female Family Member', $block_farm->female_family, $errors->has('title'), $errors->first('title'), ''
		                  ); ?>

		       
		  
		              </div>

		              <hr>

				</div>
					<!-- /.tab-pane -->
				<div class="tab-pane" id="tab_22">
					<div class="row">
		                <div class="col-md-6">
		                    <div class="panel panel-default">
		                      <div class="panel-heading">
		                       
		                          <p class="text-center no-margin"><b>
		                          Production Data</b> </p>
		              
		                      </div>
		                      <div class="panel-body">
		                        <table class="table block_farm_table" style="background-color: white">
			                        <thead>
			                          <tr>
			                            <th style="width: 40%"></th>
			                            <th class="text-center">Plant</th>
			                            <th class="text-center">Ratoon</th>
			                          </tr>
			                        </thead>
			                        <tbody>
			                          <tr>
			                            <td class="text-center">
			                              Total Area Planted (ha)
			                            </td>
			                            <td>
			                              <?php echo __form::textbox_tbl_sm('plant_total_area','plant_total_area','number','',$block_farm->plant_total_area,'step="0.00001"'); ?>

			                            </td>
			                            <td>
			                              <?php echo __form::textbox_tbl_sm('ratoon_total_area','ratoon_total_area','number','',$block_farm->ratoon_total_area,'step="0.00001"'); ?>

			                            </td>
			                          </tr>
			                          <tr>
			                            <td colspan="3" class="text-center">
			                              Production per Hectare
			                            </td>
			                          </tr>
			                          <tr>
			                            <td class="text-center">
			                              LKG/TC
			                            </td>
			                            <td>
			                              <?php echo __form::textbox_tbl_sm('plant_lkg_tc','plant_lkg_tc','number','',$block_farm->plant_lkg_tc,'step="0.00001"'); ?>

			                            </td>
			                            <td>
			                              <?php echo __form::textbox_tbl_sm('ratoon_lkg_tc','ratoon_lkg_tc','number','',$block_farm->ratoon_lkg_tc,'step="0.00001"'); ?>

			                            </td>
			                          </tr>

			                          <tr>
			                            <td class="text-center">
			                              TC/ha
			                            </td>
			                            <td>
			                              <?php echo __form::textbox_tbl_sm('plant_tc_ha','plant_tc_ha','number','',$block_farm->plant_tc_ha,'step="0.00001"'); ?>

			                            </td>
			                            <td>
			                              <?php echo __form::textbox_tbl_sm('ratoon_tc_ha','ratoon_tc_ha','number','',$block_farm->ratoon_tc_ha,'step="0.00001"'); ?>

			                            </td>
			                          </tr>

			                          <tr>
			                            <td class="text-center">
			                              LKg/ha
			                            </td>
			                            <td>
			                              <?php echo __form::textbox_tbl_sm('plant_lkg_ha','plant_lkg_ha','number','',$block_farm->plant_lkg_ha,'step="0.00001"'); ?>

			                            </td>
			                            <td>
			                              <?php echo __form::textbox_tbl_sm('ratoon_lkg_ha','ratoon_lkg_ha','number','',$block_farm->ratoon_lkg_ha,'step="0.00001"'); ?>

			                            </td>
			                          </tr>

			                        </tbody>
			                      </table>
		                      </div>
		                    </div>
		                 </div>  
		                <div class="col-md-6">
		                	<div class="panel panel-default">
		                        <div class="panel-heading">
		                          <p class="text-center no-margin">
		                            <b> PROBLEMS ENCOUNTERED </b>
		                          </p>
		                        </div>
		                        <div class="panel-body">
		                        	<?php
										$problem_array = [];
										foreach ($block_farm->bfEncounteredProblem as $key => $problem) {

												$problem_array[$problem->blockFarmProblem->type][$problem->blockFarmProblem->slug] = [
													'slug' => $problem->blockFarmProblem->slug,
													'problem' => $problem->blockFarmProblem->problem
												];
										}

										//print("<pre>".print_r($problem_array,true)."</pre>");
									?>

									<?php
									$block_farm_all_problems = [];
									foreach ($all_problems as $key => $value) {
										$block_farm_all_problems[$value->type][$value->slug] =$value->problem;
									}


									$bf_encountered = [];

									foreach ($block_farm->bfEncounteredProblem as $key => $value) {
										$bf_encountered[$value->problem_slug] = $value->blockFarmProblem->problem;
									}
									//print("<pre>".print_r($bf_encountered,true)."</pre>");
									?>

									<?php $__currentLoopData = $block_farm_all_problems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<div class="row">
										<div class="col-md-6">
											<?php if(!is_numeric($key)): ?>
											<p class="no-margin"><b><?php echo e($key); ?></b> </p>
											<?php else: ?>
												<p class="no-margin"><b>Please select:</b> </p>
											<?php endif; ?>
										</div>
										<div class="col-md-6">
			                              <span class="pull-right">
			                              <div class="checkbox no-margin">
			                                <label><input class="all" type="checkbox" data="<?php echo e($key); ?>">All</label>
			                              </div>
			                            </span>
			                            </div>
									</div>
									
									<hr class="no-margin">
		                        	<div class="row">
		                        		<?php echo __form::checkbox('6','problem[]','',
		                        		$block_farm_all_problems[$key],
		                        		$bf_encountered
		                        		,'data="'.$key.'"'); ?>

		                        	</div>
		                        	
		                        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                        	<p>
		                            	<b>OTHERS (Please specify):</b>
		                        	</p>
		                        	<div class="row"> 
		                            	<?php echo __form::textarea('12 specify_problem', 'specify_problem', '', $block_farm->specify_problem, '', '', 'style="width:100%; resize:none" rows="4"'); ?>

		                        	</div>
		                        </div>
		                    </div>
		                	
		                </div>	
		            </div>
				</div>
			</div>
				<!-- /.tab-content -->
			</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="submit" class="btn <?php echo __static::bg_color(Auth::user()->color); ?> update_btn"><i class="fa fa-save"></i> Save</button>
	</div>
</form>