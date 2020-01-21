@extends('layouts.admin-master')
@section('content')
  <section class="content-header">
      <h1>Manage Scholars</h1>
  </section>
  <section class="content">
      {{-- Table Grid --}}        
      <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Scholars</h3>
              <div class="pull-right">
                <button type="button" class="btn bg-purple" data-toggle="modal" data-target="#add_scholar_modal"><i class="fa fa-plus"></i> New Scholar</button>
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
              <div id="advanced_filters" class="panel-collapse collapse" aria-expanded="true">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-1 col-sm-2 col-lg-2">
                      <label>Sex:</label>
                      <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                        <option value="">All</option>
                        <option value="MALE">Male</option>
                        <option value="FEMALE">Female</option>
                      </select>
                    </div>
                    <div class="col-md-1 col-sm-2 col-lg-2">
                      <label>Scholarship:</label>
                      <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm filter_scholarship filters">
                        <option value="">All</option>
                        <option value="TESDA">TESDA</option>
                        <option value="CHED-U">CHED-Undergraduate</option>
                        <option value="CHED-G">CHED-Graduate</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="scholars_table_container" style="display: none">
                <table class="table table-bordered table-striped table-hover" id="scholars_table" style="width: 100% !important">
                  <thead>
                    <tr>
  
                      <th>Name & Address</th>
                      <th>Mill District</th>
                      <th style="width: 50px">Scholarship</th>
                      <th>Course & School</th>
                      <th>Date of Birth</th>
                      <th>Sex</th>
                      <th class="action">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
              

              <div id="tbl_loader">
                <center>
                  <img style="width: 100px" src="{{ asset('images/loader.gif') }}">
                </center>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

    </div>
    
  </section>

@endsection


@section('modals')



  <!-- Add Seminar Modal -->
  <div class="modal fade" id="add_scholar_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="add_scholar_form" autocomplete="off">
          @csrf
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">New Scholar</h4>
          </div>
          <div class="modal-body">            
              <div class="row">
                {!! __form::select_static(
                    '3 scholarship_applied', 'scholarship_applied', 'Scholarship applied for: *', '' , [
                      'TESDA' => 'TESDA', 
                      'CHED, Undergraduate Degree' => 'CHED-U', 
                      'CHED, Graduate Degree' => 'CHED-G', 
                    ], '', '', '', ''
                ) !!}

                {!! __form::textbox(
                  '5 course_applied', 'course_applied', 'text', 'Title of course applied for: *', 'Title of course applied for', '', '', '', ''
                ) !!}

                {!! __form::textbox(
                  '4 school', 'school', 'text', 'Name of State University/College: *', 'Name of State University/College', '', '', '', ''
                ) !!}

              </div>
              
              <p class="page-header-sm text-info">
                Information about the scholar
              </p>

              <div class="row">
                {!! __form::textbox(
                  '4 firstname', 'firstname', 'text', 'First Name *', 'First Name', '', '', '', ''
                ) !!}

                {!! __form::textbox(
                  '4 middlename', 'middlename', 'text', 'Middle Name *', 'Middle Name', '', '', '', ''
                ) !!}

                {!! __form::textbox(
                  '4 lastname', 'lastname', 'text', 'Last Name *', 'Last Name', '', '', '', ''
                ) !!}
              </div>

              <div class="row">
                {!! __form::textbox(
                  '4 mill_district', 'mill_district', 'text', 'Mill District *', 'Mill District', '', '', '', ''
                ) !!}


                {!! __form::datepicker(
                  '3 birth', 'birth',  'Birthday *', old('date_covered_from') ? old('date_covered_from') : Carbon::now()->format('m/d/Y'), '', ''
                ) !!}


                {!! __form::select_static(
                  '2 sex', 'sex', 'Sex: *', '' , [
                    'Male' => 'MALE', 
                    'Female' => 'FEMALE', 
                  ], '', '', '', ''
                ) !!}

                {!! __form::select_static(
                  '3 civil_status', 'civil_status', 'Civil Status*', old('is_menu'), [
                    'Single' => 'Single',
                    'Married' => 'Married',
                    'Divorced' => 'Divorced',
                    'Separated' => 'Separated',
                    'Widowed' => 'Widowed'               
                  ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
                ) !!}
              </div>

              <p class="page-header-sm text-info">
                Address of the scholar
              </p>

              <div class="row">
                {!! __form::textbox(
                  '3 address_province', 'address_province', 'text', 'Province *', 'Province', '', '', '', ''
                ) !!}

                {!! __form::textbox(
                  '3 address_city', 'address_city', 'text', 'City/Municipality *', 'City/Municipality', '', '', '', ''
                ) !!}

                {!! __form::textbox(
                  '6 address_specific', 'address_specific', 'text', 'Detailed address *', 'Detailed address', '', '', '', ''
                ) !!}

              </div>
                

              <div class="row">

                {!! __form::textbox(
                  '5 address_no_years', 'address_no_years', 'number', 'Number of years living in present address *', 'Number of years living in present address', '', '', '', 'min="0"'
                ) !!}

                {!! __form::textbox(
                  '3 phone', 'phone', 'text', 'Phone No. *', 'Phone No.', '', '', '', ''
                ) !!}

                {!! __form::textbox(
                  '4 citizenship', 'citizenship', 'text', 'Citizenship *', 'Citizenship', '', '', '', ''
                ) !!}

              </div>

              <p class="page-header-sm text-info">
                Occupation of the scholar (Leave blank if not applicable)
              </p>
                
              <div class="row">
                {!! __form::textbox(
                  '5 occupation', 'occupation', 'text', 'Occupation', 'Occupation', '', '', '', ''
                ) !!}

                {!! __form::textbox(
                  '7 office_name', 'office_name', 'text', 'Name of Company', 'Name of Company', '', '', '', ''
                ) !!}

                {!! __form::textbox(
                  '7 office_address', 'office_address', 'text', 'Office Address', 'Office Address', '', '', '', ''
                ) !!}

                {!! __form::textbox(
                  '5 office_phone', 'office_phone', 'text', 'Phone No.', 'Phone No.', '', '', '', ''
                ) !!}
              </div>
              
              <p class="page-header-sm text-info">
                Information of Scholar's Immediate relative
              </p>

              
                <div class="row">

                  <div class="col-md-4">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        Mother
                      </div>
                      <div class="panel-body">
                        <div class="row">
                          {!! __form::textbox(
                          '12 father_name', 'mother_name', 'text', "Mother's Name", "Mother's Name", '', '', '', ''
                          ) !!}
                          {!! __form::textbox(
                          '12 mother_phone', 'mother_phone', 'text', "Phone No.", "Phone No.", '', '', '', ''
                          ) !!}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        Father
                      </div>
                      <div class="panel-body">
                        <div class="row">
                          {!! __form::textbox(
                          '12 father_name', 'father_name', 'text', "Father's Name", "Father's Name", '', '', '', ''
                          ) !!}
                          {!! __form::textbox(
                          '12 father_phone', 'father_phone', 'text', "Phone No.", "Phone No.", '', '', '', ''
                          ) !!}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        Spouse (Leave blank if N/A)
                      </div>
                      <div class="panel-body">
                        <div class="row">
                          {!! __form::textbox(
                          '12 spouse_name', 'spouse_name', 'text', "Name of Spouse", "Name of Spouse", '', '', '', ''
                          ) !!}
                          {!! __form::textbox(
                          '12 spouse_phone', 'spouse_phone', 'text', "Phone No.", "Phone No.", '', '', '', ''
                          ) !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary submit_add_seminar"><i class="fa fa-save"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>



  {!! __html::blank_modal('show_scholars_modal','lg') !!}
  {!! __html::blank_modal('edit_scholars_modal','lg') !!}
  {!! __html::modal_loader() !!}



  



@endsection 


@section('scripts')
<script type="text/javascript">
  function dt_draw(){
    scholars_tbl.draw();
  }

  function filter_dt(){
    sex = $(".filter_sex").val();
    scholarship_type = $(".filter_scholarship").val();
    scholars_tbl.ajax.url(
      "{{ route('dashboard.scholars.index') }}?sex="+sex+"&scholarship_type="+scholarship_type).load();

    $(".filters").each(function(index, el) {
      if($(this).val() != ''){
        $(this).parent("div").addClass('has-success');
        $(this).siblings('label').addClass('text-green');
      }else{
        $(this).parent("div").removeClass('has-success');
        $(this).siblings('label').removeClass('text-green');
      }
    });
  }

  // function toggle_visibility(){
  //   column = scholars_tbl.column(0);
  //   column.visible( ! column.visible() );

  //   if(column.visible() == true){
  //     $('.chkbox').iCheck({
  //         checkboxClass: 'icheckbox_flat-green',
  //         radioClass: 'iradio_minimal',
  //         increaseArea: '20%' // optional
  //       });
  //   }
  // }
</script>
<script type="text/javascript">
  {!! __js::modal_loader() !!}
  active = '';

  $('#scholars_table')
    .on('preXhr.dt', function ( e, settings, data ) {
        Pace.restart();
    } )
 
  //-----DATATABLES-----//
  //Initialize DataTable
  scholars_tbl = $("#scholars_table").DataTable({
    'dom' : 'lBfrtip',
    "processing": true,
    "serverSide": true,
    "ajax" : {
      url : '{{ route("dashboard.scholars.index") }}',
      type: 'GET',
    },
    "columns": [
        { "data": "fullname" },
        { "data": "mill_district" },
        { "data": "scholarship_applied" },
        { "data": "course_school" },
        { "data": "birth" },
        { "data": "sex" },
        { "data": "action" }
    ],
    "buttons": [
        {!! __js::dt_buttons() !!}
    ],
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    "columnDefs":[
      {
        // "targets" : 0,
        // "visible" : false,
        // "class" : "dt-select"
      },
      {
        "targets" : 5,
        "orderable" : false,
        "class" : 'sex-th'
      },
      {
        "targets" : 6,
        "orderable" : false,
        "class" : 'action'
      },
      {
        "targets": 4, 
        // "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
      }
    ],
    "responsive": false,
    "initComplete": function( settings, json ) {
        $('#tbl_loader').fadeOut(function(){
          $("#scholars_table_container").fadeIn();
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
         $("#scholars_table #"+active).addClass('success');
      }
      $('.chkbox').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_minimal',
        increaseArea: '20%' // optional
      });

    }
  })




  style_datatable("#scholars_table");
  

  //Search Bar Styling
    $('#scholars_table_filter input').css("width","300px");
    $("#scholars_table_filter input").attr("placeholder","Press enter to search");

    //Need to press enter to search
    $('#scholars_table_filter input').unbind();
    $('#scholars_table_filter input').bind('keyup', function (e) {
        if (e.keyCode == 13) {
            scholars_tbl.search(this.value).draw();
        }
    });


  $("body").on("change",".filters",function(){
    filter_dt();
  })
  

  $("#add_scholar_form").submit(function (e) {
    e.preventDefault();

    wait_button("#add_scholar_form");

    $.ajax({
      url : "{{ route('dashboard.scholars.store') }}",
      data : $(this).serialize(),
      type: 'POST',
      dataType: 'json',
      success: function(response){
        $("#add_scholar_form").get(0).reset();
        notify("Scholar has been added successfully","success");
        active = response.slug;
        scholars_tbl.draw(false);
        succeed("#add_scholar_form", "save" ,true);
      },
      error: function(response){
        console.log(response);
        errored("#add_scholar_form","save",response);

      }
    })
  })

  $("body").on("click",".show_scholars_btn",function(){
    id = $(this).attr("data");
    load_modal('#show_scholars_modal');
    uri = "{{ route('dashboard.scholars.show','slug') }}";
    uri = uri.replace('slug',id);
    $.ajax({
      url :  uri,
      type: 'GET',
      success: function(response){

        populate_modal("#show_scholars_modal",response);
      },
      errors: function(response){
        console.log(response);
      }
    })
  });

  $("body").on("click",".edit_scholars_btn", function(){

    id = $(this).attr('data');
    load_modal('#edit_scholars_modal');

    uri = " {{ route('dashboard.scholars.edit', 'slug') }} ";
    uri = uri.replace('slug',id);

    $.ajax({
      url : uri,
      type: 'GET',
      success: function(response){

        populate_modal("#edit_scholars_modal",response);

      },
      error: function(response){
       console.log(response); 
      }
    })

  });

  $("body").on("submit","#edit_scholars_form", function(e){
    e.preventDefault();
    id = $(this).attr('data');
    wait_button("#edit_scholars_form");
    uri = "{{ route('dashboard.scholars.update','slug') }}",
    uri = uri.replace('slug',id);

    $.ajax({
      url: uri,
      data: $(this).serialize(),
      type: 'PUT',
      dataType: 'json',
      success: function(response){
        succeed("#edit_scholars_form","save",false);
        $("#edit_scholars_modal").modal('hide');
        notify("Scholar successfully updated",'success');
        active = response.slug
        scholars_tbl.draw(false);
      },
      error: function(response){
        console.log(response);
        errored("#edit_scholars_form","save",response);
      }

    })
  })


  $("body").on("click",".delete_scholars_btn", function(){
    id = $(this).attr('data');
    confirm("{{ route('dashboard.scholars.destroy', 'slug') }}", id);
  })


</script>
@endsection