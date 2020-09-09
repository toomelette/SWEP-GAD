@extends('printables.print_layout')

@section('body')
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
  @media print{
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

		            @if(!empty($columns_chosen))

	                    @if(in_array("numbering", $columns_chosen))
	                      <th>#</th>
	                    @endif

	                    <th>Block Farm</th>
		            	@foreach($columns_chosen as $column_chosen)
		            		@if($column_chosen != "numbering")
		            			 <th>{{ array_search($column_chosen, $columns) }}</th>
		            		@endif
		            	@endforeach
		            @endif
		          </thead>
		          <tbody>
		          	@php
		          		$num = 0;

					    	// $key = array_search("numbering", $columns_chosen);

					    	// unset($columns_chosen[$key]);
		
		          	@endphp
		          	@if(!empty($block_farms))
		          		@foreach($block_farms as $block_farm)
		          			@php $num++ @endphp
		          			<tr>
		          				@if(in_array("numbering", $columns_chosen))
				                    <th>{{$num}}</th>
				                @endif
		          				<td class="block_farm">{{$block_farm->block_farm_name}}</td>

		          				@if(!empty($columns_chosen))
		          					@foreach($columns_chosen as $column_chosen)
		          						@if($column_chosen != 'numbering')
		          							@switch($column_chosen)
		          								@case('date')
		          									<td class="{{$column_chosen}}">
		          										{{date("M. d, Y",strtotime($block_farm->$column_chosen))}}
		          									</td>
		          									@break
		          								@case('enrolee_name')
		          									<td class="{{$column_chosen}}">
		          										{{$block_farm->$column_chosen}}
		          									</td>
		          									@break
		          								@case('mill_district')
		          									<td class="{{$column_chosen}}">
			          									{{
			          									$block_farm->millDistrict->mill_district or
			          									$block_farm->mill_district
			          									}}
			          								</td>
		          									@break
		          								@case('members')
		          									<td class="{{$column_chosen}}">
			          									{{
			          									count($block_farm->blockFarmMembers)
			          									}}
			          								</td>
		          									@break

		          								@case('male_members')
		          									<td class="{{$column_chosen}}">
			          									{{
			          									count($block_farm->blockFarmMembers->where('sex','=',"MALE"))
			          									}}
			          								</td>
		          									@break
		          								@case('female_members')
		          									<td class="{{$column_chosen}}">
			          									{{
			          									count($block_farm->blockFarmMembers->where('sex','=',"FEMALE"))
			          									}}
			          								</td>
		          									@break

		          								@default

		          								<td class="{{$column_chosen}}">
		          									{{$block_farm->$column_chosen}}
		          								</td>


		          							@endswitch
			          					@endif

		          					@endforeach
		          				@endif
		          			</tr>
		          		@endforeach
		          	@endif

		          </tbody>
		        </table>
		      </div>
		    </div>
		  </div>
		</div>  
	</div>
@endsection


