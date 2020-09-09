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

            	<div class="nav-tabs-custom">
            		<ul class="nav nav-tabs">
            			<li class="active"><a href="#block_farm_tab" data-toggle="tab">Block Farm</a></li>
            			<li><a href="#bf_members_tab" data-toggle="tab">Block Farm Members</a></li>
            		</ul>
            		<div class="tab-content">
            			<div class="tab-pane active" id="block_farm_tab">
            				<div class="row">
            					<div class="col-md-3">
            						<div class="well well-sm">
            							<form id="generate_report_form">
            								Filters
            								<br>
            								<div class="row">
            									<div class="col-md-6">
            										<label>Layout:</label>
            										<select name="layout" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
            											<option value="all">List All</option>
            											<option value="mill_district">Group by Mill District</option>

            										</select>
            									</div>


            									<div class="col-md-6">
            										<label>Mill District:</label>
            										<select name="mill_district" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
            											<option value="">All</option>
            											@if(count($mill_districts_list) > 0)
            											@foreach($mill_districts_list as $key => $mill_district )
            											<option value="{{$mill_district}}">{{$key}}</option>
            											@endforeach
            											@endif
            										</select>
            									</div>


            									<div class="col-md-12">
            										<div class="form-group">
            											<input type="checkbox" id="date_range_check">
            											<label> Date range:</label>

            											<div class="input-group">
            												<div class="input-group-addon">
            													<i class="fa fa-calendar"></i>
            												</div>
            												<input name="date_range" type="text" class="form-control pull-right filters" id="date_range" autocomplete="off"disabled>


            											</div>
            										</div>
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
            				<!-- /.tab-pane -->
            			<div class="tab-pane" id="bf_members_tab">
            					The European languages are members of the same family. Their separate existence is a myth.
            					For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
            					in their grammar, their pronunciation and their most common words. Everyone realizes why a
            					new common language would be desirable: one could refuse to pay expensive translators. To
            					achieve this, it would be necessary to have uniform grammar, pronunciation and more common
            					words. If several languages coalesce, the grammar of the resulting language is more simple
            					and regular than that of the individual languages.
            			</div>
            				<!-- /.tab-pane -->
            		</div>
            			<!-- /.tab-content -->
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
	$(document).ready(function(){
		$("#date_range").attr('disabled','disabled');
	})

	$("#date_range_check").change(function(){
		if($(this).prop('checked') == true){
			$("#date_range").removeAttr('disabled');
		}else{
			$("#date_range").attr('disabled','disabled');
		}
	});
	$("#date_range").daterangepicker({});


	$("#generate_report_form").submit(function (e) {
		e.preventDefault();

		url = "{{ route('dashboard.block_farm.report_generate') }}";
		data = $(this).serialize();
		console.log(data);
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