@extends('layouts.admin-master')

@section('content')
	                                                                                                                                                                                                  
  <section class="content-header">
      <h1>Mill Districts</h1>
  </section>

  <section class="content">
    <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">List of Menus</h3>
              <div class="pull-right">
                 <button type="button" class="btn bg-purple" data-toggle="modal" data-target="#add_mill_district_modal" data-original-title="" title=""><i class="fa fa-plus"></i> Add new</button>

              </div>
            </div>
            <div class="panel">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#advanced_filters" aria-expanded="true" class="">
                    <i class="fa fa-filter"></i>  Advanced Filters <i class=" fa  fa-angle-down"></i>
                  </a>
                </h4>
              </div>
              <div id="advanced_filters" class="panel-collapse collapse" aria-expanded="true" style="">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-1 col-sm-2 col-lg-2">
                      <label>Is menu:</label>
                      <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm filter_menu filters">
                        <option value="">All</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                      </select>
                    </div>
                    <div class="col-md-1 col-sm-2 col-lg-2">
                      <label>Is dropdown:</label>
                      <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm filter_dropdown filters">
                        <option value="">All</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-body">
	             <div id="mill_district_table_container" style="display: none">
	                
	              
	                <table class="table table-bordered table-striped table-hover" id="mill_district_table" style="width: 100% !important; font-size: 14px">
	                  <thead>
	                    <tr>
	                      <th>Location</th>
	                      <th>Region</th>
	                      <th>Mill District</th>
	                      <th>Chairman</th>
	                      <th>Address</th>
	                      <th>Mill District Officer</th>
	                      <th>Phone</th>
	                      <th class="action">Action</th>
	                    </tr>
	                  </thead>
	                  <tbody>
	                    
	                  </tbody>
	                </table>

	             </div>
	        </div>
	        	<div id="tbl_loader">
	              <center>
	                <img style="width: 100px" src="{{ asset('images/loader.gif') }}">
	            </center>
	        </div>
            <!-- /.box-body -->
          </div>
    </div>

  </section>

@endsection


@section('modals')

  {!! __html::modal_delete('seminar_delete') !!}

  <!-- Add Seminar Modal -->
  <div class="modal fade" id="add_mill_district_modal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      	<form id="add_mill_district_form" autocomplete="off">
      		@csrf
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span></button>
	          <h4 class="modal-title">Add Mill District</h4>
	        </div>
	        <div class="modal-body">
	        	<div class="row">
	        		{!! __form::select_static(
                      '12 location', 'location', 'Location *', old('is_menu'), [
                        
                      ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
                    ) !!}

                    {!! __form::select_static(
                      '12 region', 'region', 'Region *', old('is_menu'), [
                      ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
                    ) !!}



	        		{!! __form::textbox(
                      '12 mill_district', 'mill_district', 'text', 'Mill District *', 'Mill District', old('title'), '', $errors->first('title'), 'style="text-transform: uppercase"'
                    ) !!}

                    {!! __form::textbox(
                      '12 chairman', 'chairman', 'text', 'Chairman *', 'Chairman', old('title'), '', $errors->first('title'), ''
                    ) !!}

                    {!! __form::textbox(
                      '12 address', 'address', 'text', 'Address *', 'Address', old('title'), '', $errors->first('title'), ''
                    ) !!}

                    {!! __form::textbox(
                      '12 mdo', 'mdo', 'text', 'Mill District Officer *', 'Mill District Officer', old('title'), '', $errors->first('title'), ''
                    ) !!}

                    {!! __form::textbox(
                      '12 phone', 'phone', 'text', 'Contact number *', 'Contact number', old('title'), '', $errors->first('title'), ''
                    ) !!}

	        	</div>
	        </div>
	        <div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          		<button type="submit" class="btn btn-primary add_block_farm_btn"><i class="fa fa-save"> </i> Save</button>
	        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit modal -->
  <div class="modal fade" id="edit_seminar_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        
          <div id="edit_seminar_modal_loader">
            <center>
              <img style="width: 70px; margin: 40px 0;" src="{{ asset('images/loader.gif') }}">
            </center>
          </div>
        </div>
    </div>
  </div>

{!! __html::blank_modal('edit_mill_district_modal','sm') !!}
{!! __html::blank_modal('show_mill_district_modal','xl') !!}
  {!! __html::modal_loader() !!}


@endsection 


@section('scripts')
<script type="text/javascript">
	function dt_draw(){
		mill_district_tbl.draw(false);
	}
</script>
<script type="text/javascript">

	 active = '';

  $('#mill_district_table')
    .on('preXhr.dt', function ( e, settings, data ) {
        Pace.restart();
    } )

  modal_loader = $("#modal_loader").parent('div').html();
  //-----DATATABLES-----//
    //Initialize DataTable
    mill_district_tbl = $("#mill_district_table").DataTable({
      'dom' : 'lBfrtip',
      "processing": true,
      "serverSide": true,
      "ajax" : '{{ route("dashboard.mill_district.index") }}',
      "columns": [
          { "data": "location" },
          { "data": "region" },
          { "data": "mill_district" },
          { "data": "chairman" },
          { "data": "address" },
          { "data": "mdo" },
          { "data": "phone" },
          { "data": "action" }
      ],
      "buttons": [
          {!! __js::dt_buttons() !!}
      ],
      "columnDefs":[
        {
          "targets" : [ 0 , 1 , 2],
          "visible" : true
        },
        {
          "targets" : 1,
          "class" : 'sex-th'
        },
        {
          "targets" : 5,
          "orderable" : false,
          "class" : 'action'
        },

        {
          "targets": 3, 
          // "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
        }
      ],
      "responsive": false,
      "initComplete": function( settings, json ) {
          $('#tbl_loader').fadeOut(function(){
            $("#mill_district_table_container").fadeIn();
          });
        },
      "language": 
        {          
          "processing": "<center><img style='width: 70px' src='{{ asset('images/loader.gif') }}'></center>",
        },
      "drawCallback": function(settings){
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="modal"]').tooltip();
        if(active != ''){
           $("#mill_district_table #"+active).addClass('success');
        }
      }
    })

    //Search Bar Styling
    style_datatable('#mill_district_table');

    //Need to press enter to search
    $('#mill_district_table_filter input').unbind();
    $('#mill_district_table_filter input').bind('keyup', function (e) {
        if (e.keyCode == 13) {
            mill_district_tbl.search(this.value).draw();
        }
    });




   regions = @php echo $regions; @endphp;


	$.each(regions, function (a, item) {
		$("#add_mill_district_form #location").append('<option value="'+a+'">'+a+'</option>');
	});

	$("body").on('change', 'select#location', function(){
		val = $(this).val();
		r = $(this).parent('div').siblings('.region').find('#region');
		r.html('<option value="">Select</option>');

		$.each(regions[val], function (i, t) {
			r.append('<option value="'+t+'">'+t+'</option>');
		})
	})

	$("body").on('submit','#edit_mill_district_form', function(e){
		e.preventDefault();
	    id = $(this).attr('data');
	    wait_button("#edit_scholars_form");
	    uri = "{{ route('dashboard.mill_district.update','slug') }}";
	    uri = uri.replace('slug',id);

	    $.ajax({
	      url: uri,
	      data: $(this).serialize(),
	      type: 'PUT',
	      dataType: 'json',
	      success: function(response){
	        succeed("#edit_mill_district_form","save",false);
	        $("#edit_mill_district_modal").modal('hide');
	        notify("Mill District successfully updated",'success');
	        active = response.slug
	        mill_district_tbl.draw(false);
	      },
	      error: function(response){
	        console.log(response);
	        errored("#edit_mill_district_form","save",response);
	        notify("Error: Check console.", 'danger');
	      }

	    })
	})



	$("#add_mill_district_form").submit(function(e){
		e.preventDefault();
		wait_button("#add_mill_district_form");
		$.ajax({
			url: "{{route('dashboard.mill_district.store')}}",
			data: $(this).serialize(),
			type: 'POST',
			success: function(response){
				succeed('#add_mill_district_form','save',true);
				notify("Mill District successfully added",'success');
				active = response.slug
	        	mill_district_tbl.draw(false);
			},
			error: function(response){
				notify("Error: Check console.", 'danger');
				errored('#add_mill_district_form','save',response)				
			}
		})
	})

	$("body").on("click",".edit_mill_district_btn", function(){

		load_modal("#edit_mill_district_modal");
		uri = "{{route('dashboard.mill_district.edit','slug')}}";
		uri = uri.replace('slug', $(this).attr('data'));
		$.ajax({
			url : uri,
			type: 'GET',
			success: function(response){
				populate_modal('#edit_mill_district_modal',response);
			},
			error: function(response){
				notify("Error: Check console.", 'danger');
				console.log(response)
			}
		})
	});

	$("body").on("click",".delete_mill_district_btn", function(){
    id = $(this).attr('data');
    confirm("{{ route('dashboard.mill_district.destroy', 'slug') }}", id);
  })

  $("body").on("click",".show_mill_district_btn", function(){
    id = $(this).attr('data');
    uri = "{{route('dashboard.mill_district.show', 'slug')}}";
    uri = uri.replace('slug',id);
    load_modal("#show_mill_district_modal");
    $.ajax({
      url : uri,
      type : 'GET',
      success: function(response){
        populate_modal('#show_mill_district_modal',response);
      },
      error: function(response){

      }
    })
  })
	
</script>

@endsection