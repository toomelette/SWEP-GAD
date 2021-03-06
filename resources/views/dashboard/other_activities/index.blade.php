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
                                <select name="other_activities_table_length" aria-controls="other_activities_table" class="form-control input-sm filter_sex filters">
                                    <option value="">All</option>
                                    <option value="MALE">Male</option>
                                    <option value="FEMALE">Female</option>
                                </select>
                            </div>
                            <div class="col-md-1 col-sm-2 col-lg-2">
                                <label>Scholarship:</label>
                                <select name="other_activities_table_length" aria-controls="other_activities_table" class="form-control input-sm filter_scholarship filters">
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

                <div id="other_activities_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="other_activities_table" style="width: 100% !important">
                        <thead>
                            <tr class="{!! __static::bg_color(Auth::user()->color) !!}">
                                <th>Activity</th>
                                <th>Date</th>
                                <th>Venue</th>
                                <th>Project Code</th>
                                <th>Utilized Fund</th>
                                <th>Details</th>
                                <th class="">Action</th>
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
                            @php
                                $project_code = \App\Models\Projects::select(['project_code','activity'])->get();
                            @endphp
                            {!! __form::select_object_project_code(
                              '4 project_code', 'project_code', 'Project Code', '', $project_code, '' ,''
                            ) !!}

                            {!! __form::textbox(
                              '4 utilized_fund', 'utilized_fund', 'text', 'Utilized Fund *', 'Utilized Fund', '', '', '', '','autonum'
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



    {!! __html::blank_modal('show_other_modal','lg') !!}
    {!! __html::blank_modal('edit_other_modal','lg') !!}








@endsection


@section('scripts')
    <script type="text/javascript">
        function dt_draw(){
            other_activities_tbl.draw();
        }

        function filter_dt(){
            sex = $(".filter_sex").val();
            scholarship_type = $(".filter_scholarship").val();
            mill_district = $(".filter_mill_district").val();
            course = $(".filter_course").val();
            other_activities_tbl.ajax.url(
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
        other_activities_tbl = $("#other_activities_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : {
                url : '{{ route("dashboard.other_activities.index") }}',
                type: 'GET',
            },
            "columns": [
                { "data": "activity" },
                { "data": "date" },
                { "data": "venue" },
                { "data": "project_code" },
                { "data": "utilized_fund" },
                { "data": "details" },
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
                    "targets" : 6,
                    "orderable" : false,
                    "class" : 'action-60'
                },
            ],
            "responsive": false,
            "initComplete": function( settings, json ) {
                $('#tbl_loader').fadeOut(function(){
                    $("#other_activities_table_container").fadeIn();
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
                    $("#other_activities_table #"+active).addClass('success');
                }
            },
            // 'rowGroup': {
            //     'dataSrc': 'mill_district'
            // },
            "order": [[ 1, "asc" ], [0, 'asc']]
        })




        style_datatable("#other_activities_table");


        //Search Bar Styling
        $('#other_activities_table_filter input').css("width","300px");
        $("#other_activities_table_filter input").attr("placeholder","Press enter to search");

        //Need to press enter to search
        $('#other_activities_table_filter input').unbind();
        $('#other_activities_table_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                other_activities_tbl.search(this.value).draw();
            }
        });


        $("body").on("change",".filters",function(){
            filter_dt();
        })

        //STORE
        $("#add_activity_form").submit(function (e) {
            e.preventDefault();
            form = $(this);

            //wait_button("#add_activity_form");
            loading_btn(form);
            $.ajax({
                url : "{{ route('dashboard.other_activities.store') }}",
                data : $(this).serialize(),
                type: 'POST',
                dataType: 'json',
                success: function(response){
                    notify("Scholar has been added successfully","success");
                    active = response.slug;
                    other_activities_tbl.draw(false);
                    succeed(form, true ,false);
                },
                error: function(response){
                    errored(form,response);

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

        $("body").on("click",".edit_other_btn", function(){

            id = $(this).attr('data');
            load_modal('#edit_other_modal');

            uri = " {{ route('dashboard.other_activities.edit', 'slug') }} ";
            uri = uri.replace('slug',id);

            $.ajax({
                url : uri,
                type: 'GET',
                success: function(response){
                    console.log(response)
                    populate_modal("#edit_other_modal",response);

                },
                error: function(response){
                    notify('Error occurred','danger');
                    console.log(response);
                }
            })

        });

        $("body").on("submit","#edit_other_form", function(e){
            e.preventDefault();
            id = $(this).attr('data');
            form = $(this);
            loading_btn(form);
            uri = "{{ route('dashboard.other_activities.update','slug') }}";
            uri = uri.replace('slug',id);

            $.ajax({
                url: uri,
                data: $(this).serialize(),
                type: 'PUT',
                dataType: 'json',
                success: function(response){
                    succeed(form,true,true);
                    notify("Activity successfully updated",'success');
                    active = response.slug
                    other_activities_tbl.draw(false);
                },
                error: function(response){
                    console.log(response);
                    errored(form ,response);
                }

            })
        })



        $("body").on("click",".delete_other_btn", function(){
            id = $(this).attr('data');
            confirm("{{ route('dashboard.other_activities.destroy', 'slug') }}", id);
        })


    </script>
@endsection