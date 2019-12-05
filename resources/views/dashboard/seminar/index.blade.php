<?php

  $table_sessions = [ Session::get('SEMINAR_UPDATE_SUCCESS_SLUG') ];

?>





@extends('layouts.admin-master')

@section('content')
                                                                                                                                                                                                                            
  <section class="content-header">
      <h1>Manage Seminars</h1>
  </section>

  <section class="content">
    

      {{-- Table Grid --}}        
      <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Seminars</h3>
              <div class="pull-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_seminar_modal"><i class="fa fa-plus"></i> New Seminar</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover" id="seminars_table" style="width: 100% !important; display: none">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>SLUG</th>
                    <th>SEMINAR ID</th>
                    <th>Title</th>
                    <th>Sponsor</th>
                    <th>Venue</th>
                    <th>Date From</th>
                    <th>Date To</th>
                    <th class="action">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>

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

  {!! __html::modal_delete('seminar_delete') !!}

  <!-- Add Seminar Modal -->
  <div class="modal fade" id="add_seminar_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">New Seminar</h4>
        </div>
        <form autocomplete="off" id="form_add_seminar">  
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                 
                    <div class="box-body">
                      <div class="col-md-12">
                              
                        @csrf    

                        <div class="row">
                          <div class="col-md-7">
                            <div class="row">
                              {!! __form::textbox(
                                '12 title', 'title', 'text', 'Title *', 'Title', old('title'), $errors->has('title'), $errors->first('title'), ''
                              ) !!}
                            </div>
                            <div class="row">
                              {!! __form::textbox(
                                '6 sponsor', 'sponsor', 'text', 'Sponsor *', 'Sponsor', old('sponsor'), $errors->has('sponsor'), $errors->first('sponsor'), ''
                              ) !!}

                              {!! __form::textbox(
                                '6 venue', 'venue', 'text', 'Venue *', 'Venue', old('venue'), $errors->has('venue'), $errors->first('venue'), ''
                              ) !!}
                            </div>
                            <div class="row">
                              {!! __form::datepicker(
                                '6 date_from', 'date_covered_from',  'Date From *', old('date_covered_from') ? old('date_covered_from') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_from'), $errors->first('date_covered_from')
                              ) !!}

                              {!! __form::datepicker(
                                '6 date_to', 'date_covered_to',  'Date To *', old('date_covered_to') ? old('date_covered_to') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_to'), $errors->first('date_covered_to')
                              ) !!}
                            </div>
                          </div>
                          <div class="col-md-5">
                            {!! __form::file(
                             '12', 'doc_file', 'Attendance Sheet', $errors->has('doc_file'), $errors->first('doc_file'), ''
                            ) !!}   
                          </div>
                        </div>
                      </div>

                      

                      {{-- SPEAKERS DYNAMIC TABLE GRID --}}
                      <div class="col-md-12" style="padding-top:30px;">
                        <div class="box box-solid">
                          <div class="box-header with-border">
                            <h3 class="box-title">Add Speakers</h3>
                            <button id="add_row" type="button" class="btn btn-sm bg-green pull-right">Add Speaker &nbsp;<i class="fa fw fa-plus"></i></button>
                          </div>    
                          <div class="box-body no-padding">
                            <table class="table table-bordered">
                              
                              <tr>
                                <th>Fullname *</th>
                                <th>Topic</th>
                                <th style="width: 40px"></th>
                              </tr>

                              <tbody id="table_body">
                              </tbody>
                            </table>
                          </div>
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

  <!-- Edit modal -->
  <div class="modal fade" id="edit_seminar_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Edit</h4>
        </div>
        <div class="modal-body">
          <div id="edit_seminar_modal_loader">
            <center>
              <img style="width: 70px; margin: 40px 0;" src="{{ asset('images/loader.gif') }}">
            </center>
          </div>
        </div>
        </div>
    </div>
  </div>


  <div class="modal fade" id="view_seminar_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          
        </div>
        </div>
    </div>
  </div>

@endsection 





@section('scripts')

<script type="text/javascript">
function confirm(slug){
  $.confirm({
          title: 'Confirm!',
          content: 'Are you sure you want to delete this item?',
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm:{
                  btnClass: 'btn-danger',
                 action: function(){
                  $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  })

                  uri = "{{ route('dashboard.seminar.destroy', 'slug') }}";
                  uri = uri.replace('slug', slug);
                  $.ajax({
                      url : uri,
                      type: 'DELETE',
                      success: function(response){
                        notify("Item successfully deleted.", "success");
                        seminars_table.draw(false);
                      },
                      error: function(response){
                        notify("An error occured while deteling the item.", "danger");
                        console.log(response)
                      }

                  })
                   
                 }

              },
              cancel: function () {
                  
              }
          }
      }); 
  }
</script>

<script type="text/javascript">
    function rows_add(element){
      start = 0;
        $(element+" tr .speaker").each(function(){
          $(this).attr('name','row['+start+'][spkr_fullname]');
          $(this).parent('div').addClass('row-'+start+'-spkr_fullname');
          start++;
        })

        start = 0;
        $(element+" tr .topic").each(function(){
          $(this).attr('name','row['+start+'][spkr_topic]');
          $(this).parent('div').addClass('row-'+start+'-spkr_topic');
          start++;
        })
    }
    function append_speakers(element){

      if(element == '#form_add_seminar #table_body'){
        btn = 'delete_row';
      }else{
        btn = 'delete_row_edit';
      }
      var i = $(element).children().length;
        var content ='<tr>' +
                        '<td>' +
                          '<div class="form-group row-'+i+'-spkr_fullname">' +
                              '<input type="text" name="row[' + i + '][spkr_fullname]" class="form-control speaker" placeholder="Fullname">' +
                          '</div>' +
                        '</td>' +
                        '<td>' +
                            '<input type="text" name="row[' + i + '][spkr_topic]" class="form-control topic" placeholder="Topic">' +
                        '</td>' +

                        '<td>' +
                            '<button type="button" class="btn btn-sm bg-red '+btn+'"><i class="fa fa-times"></i></button>' +
                        '</td>' +
                      '</tr>';
        $(element).append($(content));
    }

    $(document).ready(function(){
      active = '';
      edit_loader = $("#edit_seminar_modal .modal-body").html();

      //Submit Add Seminar Form
      $("#form_add_seminar").submit(function(e){
        e.preventDefault();

        $(".submit_add_seminar").html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
        $(".submit_add_seminar").attr('disabled','disabled');

        $.ajax({
          url: "{{ route('dashboard.seminar.store') }}",
          data: $(this).serialize(),
          type: "POST",
          dataType: 'json',
          success: function(response){
            console.log(response);
            notify("Your data was successfully saved", "success");
            $("#form_add_seminar").get(0).reset();
            seminars_table.draw(false);
            $(".submit_add_seminar").html('<i class="fa fa-save"></i> Save changes');
            $(".submit_add_seminar").removeAttr('disabled');
            active = response.slug;
          },
          error: function(response){
            parsed = JSON.parse(response.responseText);
            //console.log(parsed.errors);

            $("#form_add_seminar .has-error").each(function(){
              $(this).removeClass("has-error");
              $(this).children("span").remove();
            });

            //console.log(parsed);
            $.each(parsed.errors, function(i, item){
              i = i.replace('.','-');
              i = i.replace('.','-');
              parent = $("#form_add_seminar ."+i);
              parent.addClass("has-error");
              parent.append('<span class="help-block">'+item+'</span>');
            });

            $(".submit_add_seminar").html('<i class="fa fa-save"></i> Save changes');
            $(".submit_add_seminar").removeAttr('disabled');
          }
        })
      })

      //Initialize DataTable
      seminars_table = $("#seminars_table").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax" : '{{ route("dashboard.seminar.index") }}',
        "columns": [
            { "data": "id" },
            { "data": "slug" },
            { "data": "seminar_id" },
            { "data": "title" },
            { "data": "sponsor" },
            { "data": "venue" },
            { "data": "date_covered_from" },
            { "data": "date_covered_to" },
            { "data": "action" }
        ],
        "columnDefs":[
          {
            "targets" : [ 0 , 1 , 2],
            "visible" : false
          },
          {
            "targets" : 8,
            "orderable" : false,
            "class" : 'action'
          },
          {
            "targets": [6,7], 
            "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
          }
        ],
        "responsive": false,
        "initComplete": function( settings, json ) {
            $('#tbl_loader').fadeOut(function(){
              $("#seminars_table").fadeIn();
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
             $("#seminars_table #"+active).addClass('success');
          }
        }
      })
      
      //Search Bar Styling
      $('#seminars_table_filter input').css("width","300px");
      $("#seminars_table_filter input").attr("placeholder","Press enter to search");

      //Need to press enter to search
      $('#seminars_table_filter input').unbind();
      $('#seminars_table_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
              seminars_table.search(this.value).draw();
          }
      });

      //Add speaker button
      $("#add_row").click(function(){
        append_speakers('#form_add_seminar #table_body');
        rows_add('#form_add_seminar #table_body');
      });

      //Delete speaker button
      $("body").on("click",".delete_row",function(){
        $(this).parent('td').parent('tr').remove();
        rows_add('#form_add_seminar #table_body');
      });

      //Delete seminar button
      $("body").on("click", ".delete_seminar_btn", function(){
        confirm($(this).attr('data') ,'dashboard.seminar.destroy',$('meta[name="csrf-token"]').attr('content'));
      })

      //Edit seminar button
      $("body").on("click", ".edit_seminar_btn", function(){
        $("#edit_seminar_modal .modal-body").html(edit_loader);
        id = $(this).attr('data');
        uri = "{{ route('dashboard.seminar.edit', 'slug') }}";
        uri = uri.replace('slug',id);
        $.ajax({
          url : uri ,
          type : 'GET',
          success: function(response){
            $("#edit_seminar_modal_loader").fadeOut(function(){
              $("#edit_seminar_modal .modal-body").html(response);

              //Initialize datepicker for Edit Modal
              $('.datepicker').each(function(){
                $(this).datepicker({
                    autoclose: true,
                    dateFormat: "mm/dd/yy",
                    orientation: "bottom"
                });
              });

              //Add row button from edit modal
              $("#add_row_edit").click(function(){
                append_speakers('#edit_seminar_form #table_body');
                rows_add('#edit_seminar_form #table_body');
              })

              //delete row button from edit modal
              $("body").on("click", ".delete_row_edit", function(){
                $(this).parent('td').parent('tr').remove();
                rows_add('#edit_seminar_form #table_body');
              })

              //Submit Edit Seminar Form
              $("#edit_seminar_form").submit(function(e){
                e.preventDefault();
                uri = "{{ route('dashboard.seminar.update', 'slug') }}",
                uri = uri.replace('slug',id);
                $.ajax({
                  url: uri,
                  data: $(this).serialize(),
                  type: 'PUT',
                  dataType: 'json',
                  success: function(response){
                    if(response.result == 1){
                      notify("Changes were successfully saved.", "success");
                      seminars_table.draw(false);
                      active = response.slug;
                      $("#edit_seminar_modal").modal('hide');
                    }
                  },
                  error: function(response){
                    parsed = JSON.parse(response.responseText);
                    $("#edit_seminar_form .has-error").each(function(){
                      $(this).removeClass("has-error");
                      $(this).children("span").remove();
                    });

                    $.each(parsed.errors, function(i, item){
                      i = i.replace('.','-');
                      i = i.replace('.','-');
                      parent = $("#edit_seminar_form ."+i);
                      parent.addClass("has-error");
                      parent.append('<span class="help-block">'+item+'</span>');
                    });
                  }
                })
              })

            })
          },error: function(response){
            notify("Error: "+JSON.stringify(response), 'danger');
          }
        })
      })

      $("body").on("click", ".view_seminar_btn", function(){
        $("#view_seminar_modal .modal-content").html(edit_loader);
        id = $(this).attr("data");
        uri = '{{ route("dashboard.seminar.view_seminar_details", "slug") }}';
        uri = uri.replace('slug',id);

        $.ajax({
          url : uri,
          type : 'GET',
          success: function(response){
            $("#view_seminar_modal #edit_seminar_modal_loader").fadeOut(function(){
              $("#view_seminar_modal .modal-content").html(response);
            })
          }
        })
      })

    })


    

    
  </script>
    
@endsection