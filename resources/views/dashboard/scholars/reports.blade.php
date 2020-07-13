@extends('layouts.admin-master')
@section('content')
	<style type="text/css">
		.for_sort>li{
			padding: 1px 10px; 
			background-color: #ebdcec
		}
	</style>
  <section class="content-header">
      <h1>Printable Reports</h1>
  </section>
  <section class="content">
    	<div class="box box-default">
    		
            <div class="box-header with-border">
              <i class="fa fa-warning"></i>

              <h3 class="box-title">Alerts</h3>
            </div>


            <div class="box-body">

            	<div class="row">
            		<div class="col-md-3">
            			<div class="well well-sm">
            				<form id="generate_report_form">
	            				Filters
	            				<br>
		            			<div class="row">
		            				<div class="col-md-12">
		            					<label>Layout:</label>
				            			<select name="type" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
					                        <option value="all">List All</option>
					                        <option value="scholarship">Group by Scholarship Type</option>
					                        <option value="sex">Group by Sex</option>
					                        <option value="mill_district">Group by Mill District</option>
					                        <option value="course">Group by Course</option>
					                        <option value="school">Group by School</option>
				                      	</select>
		            				</div>


		            				<div class="col-md-6">
		            					<label>Scholarship Type:</label>
				            			<select name="scholarship_type" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
					                        <option value="">All</option>
					                        <option value="CHED">CHED</option>
					                        <option value="TESDA">TESDA</option>
					                        <option value="SRA">SRA</option>
				                      	</select>
		            				</div>

		            				<div class="col-md-6">
		            					<label>Sex:</label>
				            			<select name="sex" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
					                        <option value="">All</option>
					                        <option value="MALE">Male</option>
					                        <option value="FEMALE">Female</option>
				                      	</select>
		            				</div>

		            				<div class="col-md-6">
		            					<label>Mill District:</label>
				            			<select name="mill_district" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
					                        <option value="">All</option>
					                        @foreach($mill_districts as $key=> $location)
					                          <optgroup label="{{$key}}">
					                            @foreach($location as $mill_district => $slug)
					                            <option value="{{$slug}}">
					                              {{$mill_district}}
					                            </option>
					                            @endforeach
					                          </optgroup>
					                        
					                        @endforeach
				                      	</select>
		            				</div>

		            				<div class="col-md-6">
		            					<label>Course:</label>
				            			<select name="course" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
					                        <option value="">All</option>
					                        @if(isset($courses))
					                          @php
					                            // $courses->sortBy('course_applied')
					                          @endphp
					                          @foreach($courses as $key => $bs_ms)
					                            <optgroup label="{{$key}}">
					                              @foreach($bs_ms as $course)
					                                <option value="{{$course}}">{{$course}}</option>
					                              @endforeach
					                            </optgroup>
					                          @endforeach
					                        @endif
				                      	</select>
		            				</div>

		            				
		            				<div class="col-md-12">
		            					<br>
		            					Select columns to show: <span class="text-info text-strong pull-right">(Drag to reorder)</span>
		            					<ol class="for_sort sortable todo-list" >
		            						
		            					
			            					@if(!empty($columns))
			            						@foreach($columns as $key => $column)
			            						<li>
			            							<div class="checkbox" style="margin: 0">
								                      <label>
								                        <input checked type="checkbox" name="columns[]" value="{{$column}}"> {{$key}}
								                      </label>
								                    </div>
			            						</li>
			            						@endforeach
			            					@endif
		            					</ol>
		            				</div>
		            			</div>
		            			<br>
		            			<div class="row">
		            				<div class="col-md-12">
		            					<button type="submit" class="pull-right btn {!! __static::bg_color(Auth::user()->color) !!}">Generate Report</button>
		            				</div>
		            			</div>
	            			</form>
            			</div>
            		</div>

            		<div class="col-md-9">
            			<div class="panel panel-default">
            				<div class="panel-heading clearfix">
            					<span style="font-weight: bold; font-size: 16px">Print Preview</span>
            					<button id="print_btn" class="btn {!! __static::bg_color(Auth::user()->color) !!} btn-sm pull-right"><i class="fa fa-print"></i> Print</button>
            				</div>
            				<div class="panel-body" style="height: 700px">
            					<div id="print_container" style="text-align: center; margin-top: 100px">
					    			<i class="fa fa-print" style="font-size: 300px; color: grey; "></i>
					    			<br>
					    			<span class="text-info">Click <b>"Generate Report"</b> button to see print preview here</span>
					    		</div>


            					<div id="report_frame_loader" style="display: none">
									 <center>
									 	<img style="width: 100px; margin: 140px 0;" src="{!! __static::loader(Auth::user()->color) !!}">
									 </center>
            					</div>
            					<div class="row" id="report_frame_container" style="height: 100%; display: none">
            						<div class="col-md-12" style="height: 100%">
            							<div class="embed-responsive embed-responsive-16by9">
									      <iframe id="report_frame" style="width: 100%; height: 100%" class="embed-responsive" src=""></iframe>
									    </div>


            							
            						</div>
            					</div>
            				</div>
            			</div>
            		</div>
            	</div>

            </div>
        </div>     
     

	</div>
   
	</section>

@endsection


@section('modals')





  {!! __html::blank_modal('show_scholars_modal','lg') !!}
  {!! __html::blank_modal('edit_scholars_modal','lg') !!}




  



@endsection 


@section('scripts')
<script type="text/javascript">
	$("#generate_report_form").submit(function (e) {
		e.preventDefault();

		url = "{{ route('dashboard.scholars.report_generate') }}";
		data = $(this).serialize();

		$("#report_frame_loader").show();
		$("#report_frame_container").hide();

		$("#report_frame").attr("src", url+"?"+data);

		wait_button("#generate_report_form");
		$("#print_container").slideUp();
	});

	$("#report_frame").on('load', function(){
		$("#report_frame_loader").slideUp(function(){
			$("#report_frame_container").fadeIn();
		});
		unwait_button("#generate_report_form","Generate Report");
	})

	$(".for_sort").sortable();

	$("#print_btn").click(function(){
		$("#report_frame").get(0).contentWindow.print();
	})
</script>
@endsection