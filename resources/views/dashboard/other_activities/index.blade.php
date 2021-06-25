@extends('layouts.admin-master')
@section('content')
    <section class="content-header">
        <h1>Other Activities</h1>
    </section>
    <section class="content">
        {{-- Table Grid --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Other Activities</h3>
                <div class="pull-right">
                    <button type="button" class="btn {!! __static::bg_color(Auth::user()->color) !!}" data-toggle="modal" data-target="#add_activity_modal"><i class="fa fa-plus"></i> New Activity</button>
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
                                    <option value="CHED">CHED</option>
                                    <option value="SRA">SRA</option>
                                </select>
                            </div>
                            {{-- @php
                            print('<pre>'.print_r($mill_districts,true).'</pre>')
                            @endphp --}}






                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div id="scholars_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="scholars_table" style="width: 100% !important">
                        <thead>
                        <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
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
                        <img style="width: 100px"
                             src="{!! __static::loader(Auth::user()->color) !!}">
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
    <div class="modal fade" id="add_activity_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="add_activity_form" autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">New Activity</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {!! __form::textbox(
                              '9 activity', 'activity', 'text', 'Activity *', 'Activity', '', '', '', ''
                            ) !!}

                            {!! __form::textbox(
                              '3 date', 'date', 'date', 'Date *', 'Date', '', '', '', ''
                            ) !!}
                        </div>
                        <div class="row">
                            {!! __form::textbox(
                              '4 project_code', 'project_code', 'text', 'Project Code *', 'Project Code', '', '', '', ''
                            ) !!}

                            {!! __form::textbox(
                              '4 utilized_fund', 'utilized_fund', 'text', 'Utilized Fund *', 'Utilized Fund', '', '', '', ''
                            ) !!}

                            {!! __form::textbox(
                              '4 venue', 'venue', 'text', 'Venue *', 'Venue', '', '', '', ''
                            ) !!}
                        </div>
                        <div class="row">
                            {!! __form::native_textarea('12','details','Details','',2,'') !!}
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="has_participants" value="1"> This activity involves participants
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!}"><i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {!! __html::blank_modal('show_scholars_modal','lg') !!}
    {!! __html::blank_modal('edit_scholars_modal','lg') !!}








@endsection


@section('scripts')
    <script type="text/javascript">
        function dt_draw(){
            scholars_tbl.draw();
        }

        function filter_dt(){
            sex = $(".filter_sex").val();
            scholarship_type = $(".filter_scholarship").val();
            mill_district = $(".filter_mill_district").val();
            course = $(".filter_course").val();
            scholars_tbl.ajax.url(
                "{{ route('dashboard.scholars.index') }}?sex="+sex+"&scholarship_type="+scholarship_type+"&mill_district="+mill_district+"&course="+course).load();

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


    </script>
    <script type="text/javascript">
        {!! __js::modal_loader() !!}
            active = '';



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
                    "targets" : 0,
                    "class" : "scholars_name"
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
                    "targets": 1,
                    "visible": false
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
                    "processing": "<center><img style='width: 70px' src='{!! __static::loader(Auth::user()->color) !!}'></center>",
                },
            "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active != ''){
                    $("#scholars_table #"+active).addClass('success');
                }
            },
            'rowGroup': {
                'dataSrc': 'mill_district'
            },
            "order": [[ 1, "asc" ], [0, 'asc']]
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


        $("#add_activity_form").submit(function (e) {
            e.preventDefault();

            //wait_button("#add_activity_form");

            $.ajax({
                url : "{{ route('dashboard.other_activities.store') }}",
                data : $(this).serialize(),
                type: 'POST',
                dataType: 'json',
                success: function(response){
                    $("#add_scholar_form").get(0).reset();
                    notify("Scholar has been added successfully","success");
                    // active = response.slug;
                    // scholars_tbl.draw(false);
                    succeed("#add_activity_form", "save" ,true);
                },
                error: function(response){
                    console.log(response);
                    errored("#add_activity_form","save",response);

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
            uri = "{{ route('dashboard.scholars.update','slug') }}";
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