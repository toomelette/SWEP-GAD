<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">{{ $block_farm->block_farm_name }}</h4>
  </div>
  <div class="modal-body">
  	<div class="well well-sm">
  		<div class="row">
  			<div class="col-md-7">
  				<dl class="dl-horizontal">
	                <dt>Name of Block Farm:</dt>
	                <dd>{{ $block_farm->block_farm_name }}</dd>

	                <dt>Mill District:</dt>
	                <dd>{{ $block_farm->mill_district }}</dd>

	                <dt>Source of Fund:</dt>
	                <dd>{{ $block_farm->fund_source }}</dd>

	                <dt>Date:</dt>
	                <dd>{{ date("F d, Y",strtotime($block_farm->date)) }}</dd>

	                <dt>Name of Enrolee:</dt>
	                <dd>{{ $block_farm->enrolee_name }}</dd>

	                <dt>Address:</dt>
	                <dd>{{ $block_farm->address }}</dd>

	                <dt>Educational Attainment:</dt>
	                <dd>{{ $block_farm->educ_att }}</dd>

	                <dt>Sex:</dt>
	                <dd>{{ ucfirst(strtolower($block_farm->sex)) }}</dd>

	                <dt>Age:</dt>
	                <dd>{{ $block_farm->age }}</dd>

	                <dt>Civil Status:</dt>
	                <dd>{{ $block_farm->civil_status }}</dd>
	             </dl>
  			</div>
  			<div class="col-md-5">
  				<dl class="dl-horizontal">
  					<dt>Religion:</dt>
	                <dd>{{ $block_farm->religion }}</dd>

	                <dt>Occupation:</dt>
	                <dd>{{ $block_farm->occupation }}</dd>

	                <dt>Annual Income:</dt>
	                <dd>{{ number_format($block_farm->annual_income,2) }}</dd>

	                <dt>Annual Expense:</dt>
	                <dd>{{ number_format($block_farm->annual_expense,2) }}</dd>

	                <dt>Net Income:</dt>
	                <dd>{{ number_format( $block_farm->annual_income - $block_farm->annual_expense,2) }}</dd>

	                <dt>No. of Years of Experience in Sugarcane Farming:</dt>
	                <dd>{{ $block_farm->years_sugarcane_farming }}</dd>

	                <dt>No. of Family Members:</dt>
	                <dd>{{  $block_farm->female_family +  $block_farm->male_family}}</dd>

	                <dt>Male Family Members:</dt>
	                <dd>{{ $block_farm->male_family }}</dd>

	                <dt>Female Family Members:</dt>
	                <dd>{{ $block_farm->female_family }}</dd>

	                
  				</dl>
  			</div>
  		</div>
  	</div>
   
	@php
	$problem_array = [];
	foreach ($block_farm->bfEncounteredProblem as $key => $problem) {

			$problem_array[$problem->blockFarmProblem->type][$problem->blockFarmProblem->slug] = [
				'slug' => $problem->blockFarmProblem->slug,
				'problem' => $problem->blockFarmProblem->problem
			];
	}

	//print("<pre>".print_r($problem_array,true)."</pre>");
	@endphp
	<div class="well well-sm">
		<div class="row">
			@if (!empty($problem_array))
				<p class="text-center"> <b>PROBLEMS ENCOUNTERED</b> </p>
			@else
				<p class="text-center"> <b>NO PROBLEM ENCOUNTERED</b> </p>
			@endif
			
			@foreach ($problem_array as $key => $problem)
			<div class="col-md-4">
				<div class="panel panel-default"> 
		
					<div class="panel-body"> 
						@if (!is_numeric($key))
							<p class="no-margin"><b>{{ $key }}</b></p>
						@endif
						
						<ul>
							@foreach ($problem as $key_2 => $value)
							<li>{{ $value['problem'] }}</li>
							@endforeach
						</ul>
					</div>
				</div>
				
			</div>
			@endforeach
		</div>
		@if($block_farm->specify_problem != "")
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<p class="no-margin"> <b>Other:</b> </p>
						</div>
						<div class="panel-body">
							<p> {{ $block_farm->specify_problem}} </p>
						</div>
					</div>
					
				</div>
			</div>

		@endif
	</div>
  </div>
  <div class="modal-footer">
  	<div class="row">
		{!! __html::timestamps(
			$block_farm->creator['firstname'] ." ".$block_farm->creator['lastname'],
			$block_farm->created_at,
			$block_farm->updater['firstname'] ." ". $block_farm->updater['lastname'],
			$block_farm->updated_at,"4"
		) !!}	
		<div class="col-md-4">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
    
  </div>
</div>