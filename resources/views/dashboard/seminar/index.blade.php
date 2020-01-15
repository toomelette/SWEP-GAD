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
                <button type="button" class="btn bg-purple" data-toggle="modal" data-target="#add_seminar_modal"><i class="fa fa-plus"></i> New Seminar</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="seminars_table_container" style="display: none">
                <table class="table table-bordered table-striped table-hover" id="seminars_table" style="width: 100% !important">
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
        <form autocomplete="off" id="form_add_seminar" enctype="multipart/form-data">  
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
                             '12', 'doc_file','doc_file', 'Attendance Sheet', $errors->has('doc_file'), $errors->first('doc_file'), ''
                            ) !!}   
                          </div>
                        </div>
                      </div>

                      

                      {{-- SPEAKERS DYNAMIC TABLE GRID --}}
                      <div class="col-md-12" style="padding-top:30px;">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="no-margin">
                              <b>Add Speakers</b>
                            </p>
                              </div>
                              <div class="col-md-6">
                                <button id="add_row" type="button" class="btn btn-xs btn-success pull-right">Add Speaker &nbsp;<i class="fa fw fa-plus"></i></button>
                              </div>
                            </div>

                          </div>    
                          <div class="panel-body">
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
        
          <div id="edit_seminar_modal_loader">
            <center>
              <img style="width: 70px; margin: 40px 0;" src="{{ asset('images/loader.gif') }}">
            </center>
          </div>
        </div>
    </div>
  </div>

{!! __html::blank_modal('view_seminar_modal','') !!}
{!! __html::blank_modal('participant_modal','lg') !!}


@endsection 


@section('scripts')

<script type="text/javascript">


  
function delete_participant(slug){
  $.confirm({
    title: 'Confirm!',
    content: 'Are you sure you want to remove this participant?',
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

            uri = "{{ route('dashboard.seminar.participant_destroy', 'slug') }}";
            uri = uri.replace('slug', slug);
            Pace.restart();
            $.ajax({
                url : uri,
                type: 'DELETE',
                success: function(response){
                  notify("Item successfully deleted.", "success");
                  participant_tbl.row("#"+slug).remove().draw();
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

function dt_draw(){
  seminars_table.draw(false);
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
      edit_loader = $("#edit_seminar_modal .modal-content").html();

      $('#seminars_table')
        .on('preXhr.dt', function ( e, settings, data ) {
            Pace.restart();
        } )


    //-----DATATABLES-----//
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
        buttons: [
            'copy', 'excel', 'pdf'
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
              $("#seminars_table_container").fadeIn();
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

    //-----SEMINAR-----//
      //Submit Add Seminar Form
      $("#form_add_seminar").submit(function(e){
        e.preventDefault();
        wait_button('#form_add_seminar');
        formData = new FormData(this);
        Pace.restart();
        $.ajax({
          url: "{{ route('dashboard.seminar.store') }}",
          data: formData,
          type: "POST",
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function(response){

            console.log(response);
            notify("Your data was successfully saved", "success");

            seminars_table.draw(false);
            active = response.slug;

            succeed("#form_add_seminar","save",true);
            $("#form_add_seminar input[name='title']").focus();
            $("#table_body").html('');
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
            $(".submit_add_seminar").html('<i class="fa fa-save"></i> Save');
            $(".submit_add_seminar").removeAttr('disabled');
          }
        })
      })
      
      //Edit seminar button
      $("body").on("click", ".edit_seminar_btn", function(){
        $("#edit_seminar_modal .modal-content").html(edit_loader);
        id = $(this).attr('data');
        uri = "{{ route('dashboard.seminar.edit', 'slug') }}";
        uri = uri.replace('slug',id);
        Pace.restart();
        $.ajax({
          url : uri ,
          type : 'GET',
          success: function(response){

            $("#edit_seminar_modal_loader").fadeOut(function(){
              $("#edit_seminar_modal .modal-content").html(response);

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
                default_update_seminar_btn = $("#edit_seminar_form .update_seminar_btn").html();
                update_seminar_btn = $("#edit_seminar_form .update_seminar_btn");
                update_seminar_btn.html("<i class='fa fa-spinner fa-spin'> </i> Please wait");
                update_seminar_btn.attr("disabled","disabled");

                e.preventDefault();
                uri = "{{ route('dashboard.seminar.update', 'slug') }}";
                uri = uri.replace('slug',id);
                formData = new FormData(this);
                Pace.restart();
                $.ajax({
                  url: uri,
                  data: formData,
                  type: 'POST',
                  dataType: 'json',
                  processData: false,
                  contentType: false, 
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response){
                    //console.log(response)
                    if(response.result == 1){
                      notify("Changes were successfully saved.", "success");
                      seminars_table.draw(false);
                      active = response.slug;
                      $("#edit_seminar_modal").modal('hide');
                      update_seminar_btn.html(default_update_seminar_btn);
                      update_seminar_btn.removeAttr("disabled");
                    
                    }
                  },
                  error: function(response){
                    //console.log(response);
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

                    update_seminar_btn.html(default_update_seminar_btn);
                    update_seminar_btn.removeAttr("disabled");
                  }
                })
              })

            })
          },error: function(response){
            notify("Error: "+JSON.stringify(response), 'danger');
          }
        })
      })
      
       //Delete seminar button
      $("body").on("click", ".delete_seminar_btn", function(){
        id = $(this).attr('data');
        confirm("{{ route('dashboard.seminar.destroy', 'slug') }}", id);
      })

      //Show seminar button
      $("body").on("click", ".view_seminar_btn", function(){
        $("#view_seminar_modal .modal-content").html(edit_loader);
        id = $(this).attr("data");
        uri = '{{ route("dashboard.seminar.show", "slug") }}';
        uri = uri.replace('slug',id);
        Pace.restart();
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

    //-----SEMINAR SPEAKERS-----//
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

     

      
    //-----SEMINAR PARTICIPANTS-----//
      //Participants
      seminar_slug = '';
      //On Click of Participant Button
      $("body").on("click", ".participant_btn",function(){
        id = $(this).attr('data');
        uri = "{{ route('dashboard.seminar.participant', 'slug') }}";
        uri = uri.replace('slug',id);
        $("#participant_modal .modal-content").html(edit_loader);
        Pace.restart();
        $.ajax({
          url: uri,
          type: "GET",
          success: function(response){
            seminar_slug = id;
            $("#participant_modal #edit_seminar_modal_loader").fadeOut(function(){
              $("#participant_modal .modal-content").html(response);      
              participant_tbl = $("#participant_tbl").DataTable({

                "columnDefs":[
                  {
                    "targets" : 5,
                    "orderable" : false
                  }  
                ]
              });      
            });
            
          }
        })
      });


      //Add Participants
      $("body").on("submit","#add_participant_form", function(e){
          default_add_participant_btn = $("#add_participant_form .add_participant_btn").html();
          add_participant_btn = $("#add_participant_form .add_participant_btn");
          add_participant_btn.html("<i class='fa fa-spin fa-spinner'> </i> Please wait ");
          add_participant_btn.attr("disabled","disabled");

          e.preventDefault();
          uri = "{{ route('dashboard.seminar.participant_store' ,'slug') }}";
          uri = uri.replace('slug',seminar_slug);
          Pace.restart();
          $.ajax({
            url : uri,
            type: 'POST',
            data: $(this).serialize()+"&slug="+seminar_slug,
            dataType: 'json',
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){

              console.log(response);
              if(response.result == 1){
                $("#add_participant_form").get(0).reset();
                notify("Participant successfully added.","success");
                $("#add_participant_form .has-error").each(function(){
                  $(this).removeClass('has-error');
                  $(this).children('span').remove();
                });
                participant_tbl.row.add([
                  response.fullname,
                  response.address,
                  response.sex,
                  response.contact_no,
                  response.email,
                  '<div class="btn-group">'+
                  '<button  data="'+response.inserted_participant+'" class="btn btn-sm btn-default edit_participant_btn">'+
                    '<i class="fa fa-pencil-square-o"></i>'+
                  '</button>'+
                  '<button data="'+response.inserted_participant+'" class="btn btn-sm btn-danger delete_participant_btn">'+
                    '<i class="fa  fa-trash-o"></i>'+
                  '</button>'+
                '</div>'
                ]).node().id= response.inserted_participant;
                participant_tbl.draw();

                $("#participant_tbl .success").each(function(){
                  $(this).removeClass('success');
                })
                $("#"+response.inserted_participant).addClass('success');

                add_participant_btn.html(default_add_participant_btn);
                add_participant_btn.removeAttr("disabled");

                $("#add_participant_form input[name='fullname']").focus();
              }else{
                console.log(response);
              }
            },
            error: function(response){
              console.log(response);
              $("#add_participant_form .has-error").each(function(){
                $(this).removeClass('has-error');
                $(this).children('span').remove();
              })
              $.each(response.responseJSON.errors, function(i, item){
                $("#add_participant_form ."+i).addClass('has-error');
                $("#add_participant_form ."+i).addClass('has-error');
                $("#add_participant_form ."+i).append('<span class="help-block">'+item+'</span>');
              });
              add_participant_btn.html(default_add_participant_btn);
              add_participant_btn.removeAttr("disabled");
            }
          })
      })

      //Delete participant button
      $("body").on("click",".delete_participant_btn", function(e){
        id = $(this).attr('data');
        delete_participant(id);
      })
      //Edit Participants
      $("body").on("click",".edit_participant_btn", function(){
        t = $(this);
        default_edit_btn = t.html();
        t.html("<i class='fa fa-spinner fa-spin'> </i>");
        t.attr("disabled","disabled");
        slug = $(this).attr("data");
        uri = "{{ route('dashboard.seminar.participant_edit', 'slug') }}";
        uri = uri.replace('slug',slug);
        Pace.restart();
        $.ajax({
          url : uri,
          type: 'GET',
          success: function(response){
            t.html(default_edit_btn);
            t.removeAttr("disabled");
            r = response;

            if(r.contact_no == null){
              r.contact_no = "";
            }

            if(r.email == null){
              r.email = "";
            }
            if(r.address == null){
              r.address = "";
            }

            if(r.sex == 'FEMALE'){
              options = '<option value="">Select</option>'+
                        '<option value="MALE">MALE</option>'+
                        '<option value="FEMALE" selected>FEMALE</option>';
            }else{
              options = '<option value="">Select</option>'+
                        '<option value="MALE" selected>MALE</option>'+
                        '<option value="FEMALE" >FEMALE</option>';
            }
            participant_slug = r.slug;

            edit_dialog = $.dialog({
              title: 'Edit',
              content: '' +
              '<form id="edit_participant_form" autocomplete="off">' +
                '<div class="form-group e_fullname">' +
                  '<label>Fullname *</label>' +
                    '<input type="text" placeholder="Fullname" name="e_fullname" class="form-control" value= "'+r.fullname+'"/>' +
                '</div>' +
                '<div class="form-group e_address">' +
                  '<label>Address</label>' +
                    '<input type="text" placeholder="Address" name="e_address" class="form-control" value= "'+r.address+'"/>' +
                '</div>' +
                '<div class="form-group e_sex">' +
                  '<label>Sex *</label>' +
                    '<select id="e_sex" name="e_sex" class="form-control " style="font-size:15px;">'+
                        options+
                      '</select>'+
                '</div>' +
                '<div class="form-group e_contact_no">' +
                  '<label>Contact number</label>' +
                    '<input type="text" placeholder="Contact number" name="e_contact_no" class="form-control" value= "'+r.contact_no+'"/>' +
                '</div>' +
                '<div class="form-group e_email">' +
                  '<label>Email address</label>' +
                    '<input type="text" placeholder="Email address" name="e_email" class="form-control" value= "'+r.email+'"/>' +
                '</div>' +
                '<div class="jconfirm-buttons">'+
                '<button type="submit" class="btn btn-blue update_participant_btn"><i class="fa fa-save"> </i> Save</button></div>'+
              '</form>'
            });

          },
          error: function(response){

          }
        })
      })

      //Update Participant
      participant_slug = '';
      $("body").on("submit","#edit_participant_form", function(e){
        e.preventDefault();
        ptcpt_btn = $("#edit_participant_form .update_participant_btn");
        default_edit_ptcpt_btn = $("#edit_participant_form .update_participant_btn").html();

        ptcpt_btn.html("<i class='fa fa-spinner fa-spin'> </i> Please wait");
        ptcpt_btn.attr("disabled","disabled");
        uri = "{{ route('dashboard.seminar.participant_update' , 'slug') }}";
        uri = uri.replace('slug',participant_slug);
        Pace.restart();
        $.ajax({
          url: uri,
          data: $(this).serialize(),
          type: 'PUT',
          dataType: 'json',
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response){
            r = response;
            if(r.result == 1){
              notify("Participant successfully updated.",'success');
              edit_dialog.close();
              tbl = $("#participant_tbl").dataTable();
              tbl.fnUpdate(r.e_fullname,'#'+r.slug, 0,false);
              tbl.fnUpdate(r.e_address,'#'+r.slug, 1, false);
              tbl.fnUpdate(r.e_sex,'#'+r.slug, 2, false);
              tbl.fnUpdate(r.e_contact_no,'#'+r.slug, 3, false);
              tbl.fnUpdate(r.e_email,'#'+r.slug, 4, false);
              $("#participant_tbl .success").each(function(){
                $(this).removeClass('success');
              });
              $("#participant_tbl #"+r.slug).addClass('success');

              ptcpt_btn.html(default_edit_ptcpt_btn);
              ptcpt_btn.removeAttr("disabled");
            }
          },
          error: function(response){
            console.log(response);
            ptcpt_btn.html(default_edit_ptcpt_btn);
            ptcpt_btn.removeAttr("disabled");

            $("#edit_participant_form .has-error").each(function(){
              $(this).removeClass("has-error");
              $(this).children("span").remove();
            })

            $.each(response.responseJSON.errors, function(i, item){
              $("#edit_participant_form ."+i).addClass('has-error');
              $("#edit_participant_form ."+i).append('<span class="help-block">'+item+'</span>')
            })
          }
        })
      })


    })
    
  </script>
    
@endsection