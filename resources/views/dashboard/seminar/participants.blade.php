<?php

  $table_sessions = [ 
                      Session::get('SEMINAR_PTCPT_UPDATE_SUCCESS_SLUG'),
                      Session::get('SEMINAR_PTCPT_CREATE_SUCCESS_SLUG'),
                    ];

?>

@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Manage Seminar Participants</h1>
      <div class="pull-right" style="margin-top: -25px;">
        {!! __html::back_button(['dashboard.seminar.index']) !!}
      </div>
  </section>

  <section class="content" id="pjax-container">


    {{-- Form --}}
    <div class="col-md-4">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add Form</h3>
          <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
          </div> 
        </div>

        <form data-pjax role="form" method="POST" autocomplete="off" action="{{ route('dashboard.seminar.participant_store', $seminar->slug) }}">

          @csrf

          <div class="box-body">

            {!! __form::textbox(
               '12', 'fullname', 'text', 'Fullname *', 'Fullname', old('fullname'), $errors->has('fullname'), $errors->first('fullname'), ''
            ) !!}

            {!! __form::textbox(
               '12', 'address', 'text', 'Address *', 'Address', old('address'), $errors->has('address'), $errors->first('address'), ''
            ) !!}

            {!! __form::select_static(
              '12', 'sex', 'Sex *', old('sex'), ['MALE' => 'MALE', 'FEMALE' => 'FEMALE'], $errors->has('sex'), $errors->first('sex'), '', ''
            ) !!}

            {!! __form::textbox(
               '12', 'cellphone_no', 'text', 'Cellphone No.', 'Cellphone No.', old('cellphone_no'), $errors->has('cellphone_no'), $errors->first('cellphone_no'), ''
            ) !!}

            {!! __form::textbox(
               '12', 'email', 'text', 'Email', 'Cellphone No.', old('email'), $errors->has('email'), $errors->first('email'), ''
            ) !!}

          </div>

          <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
          </div>

        </form>
      </div>
    </div>






    {{-- Table --}}
    <div class="col-md-8">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List of Participants</h3>
        </div>

        <div class="box-body">
          @if($errors->all())
            <ul style="line-height: 10px;">
              @foreach ($errors->all() as $data)
                <li><p class="text-danger">{{ $data }}</p></li>
              @endforeach
            </ul>
          @endif
          <table class="table table-hover">
            <tr>
              <th>Fullname</th>
              <th>Address</th>
              <th>Sex</th>
              <th>Cellphone No.</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
            @foreach($seminar_participants as $data) 
              <tr 
                {!! __html::table_highlighter( $data->slug, $table_sessions) !!} 
                {!! old('e_slug') == $data->slug ? 'style="background-color: #F5B7B1;"' : '' !!}
              >
                <td>{{ $data->fullname }}</td>
                <td>{{ $data->address }}</td>
                <td>{{ $data->sex }}</td>
                <td>{{ $data->cellphone_no }}</td>
                <td>{{ $data->email }}</td>
                <td>
                  <div class="btn-group">
                    <a href="#" id="ptcpt_update_btn" es="{{ $data->slug }}" data-url="{{ route('dashboard.seminar.participant_update', [$seminar->slug, $data->slug]) }}" class="btn btn-sm btn-default">
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a href="#" id="ptcpt_delete_btn" data-url="{{ route('dashboard.seminar.participant_destroy', $data->slug) }}" class="btn btn-sm btn-default">
                      <i class="fa  fa-trash-o"></i>
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
          </table>

          @if($seminar->seminarParticipant->isEmpty())
            <div style="padding :5px;">
              <center><h4>No Records found!</h4></center>
            </div>
          @endif

        </div>

      </div>
    </div>

    

  </section>

@endsection





@section('modals')
  

  {{-- Delete --}}
  {!! __html::modal_delete('ptcpt_delete') !!}


  {{-- Update --}}
  <div class="modal fade bs-example-modal-lg" id="ptcpt_update" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body" id="ptcpt_update_body">
          <form data-pjax id="ptcpt_update_form" method="POST" autocomplete="off">

            <div class="row">
                
              @csrf

              <input name="_method" value="PUT" type="hidden">

              <input name="e_slug" id="e_slug"  type="hidden">

              {!! __form::textbox(
                 '6', 'e_fullname', 'text', 'Fullname *', 'Fullname', old('e_fullname'), $errors->has('e_fullname'), $errors->first('e_fullname'), ''
              ) !!}

              {!! __form::textbox(
                 '6', 'e_address', 'text', 'Address *', 'Address', old('e_address'), $errors->has('e_address'), $errors->first('e_address'), ''
              ) !!}

              <div class="col-md-12"></div>

              {!! __form::select_static(
                '6', 'e_sex', 'Sex *', old('e_sex'), ['MALE' => 'MALE', 'FEMALE' => 'FEMALE'], $errors->has('e_sex'), $errors->first('e_sex'), '', ''
              ) !!}

              {!! __form::textbox(
                 '6', 'e_cellphone_no', 'text', 'Cellphone No.', 'Cellphone No.', old('e_cellphone_no'), $errors->has('e_cellphone_no'), $errors->first('e_cellphone_no'), ''
              ) !!}

              <div class="col-md-12"></div>

              {!! __form::textbox(
                 '6', 'e_email', 'text', 'Email', 'Cellphone No.', old('e_email'), $errors->has('e_email'), $errors->first('e_email'), ''
              ) !!}

            </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>
        </form>
      </div>
    </div>
  </div>


@endsection 





@section('scripts')

  <script type="text/javascript">

    // Delete Button Action
    $(document).on("click", "#ptcpt_delete_btn", function () {
      $("#ptcpt_delete").modal("show");
      $("#delete_body #form").attr("action", $(this).data("url"));
      $("#delete_body #form").attr("data-pjax", '');
      $(this).val("");
    });


    // Delete Form Action
    $(document).on("submit", "#delete_body #form", function () {
        $('#ptcpt_delete').delay(100).fadeOut(100);
       setTimeout(function(){
          $('#ptcpt_delete').modal("hide");
       }, 200);
    });


    // Update Button Action
    $(document).on("click", "#ptcpt_update_btn", function () {

      var slug = $(this).attr("es");

      $("#ptcpt_update").modal("show");
      $("#ptcpt_update_body #ptcpt_update_form").attr("action", $(this).data("url"));


      $.ajax({
        headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
        url: "/api/seminar/participant/"+slug+"/edit",
        type: "GET",
        dataType: "json",
        success:function(data) {       
            
          $.each(data, function(key, value) {
            $("#ptcpt_update_form #e_slug").val(value.slug);
            $("#ptcpt_update_form #e_fullname").val(value.fullname);
            $("#ptcpt_update_form #e_address").val(value.address);
            $("#ptcpt_update_form #e_cellphone_no").val(value.cellphone_no);
            $("#ptcpt_update_form #e_email").val(value.email);

            if(value.sex == "MALE"){
              $("#ptcpt_update_form #e_sex").val("MALE");
            }else if(value.sex == "FEMALE"){
              $("#ptcpt_update_form #e_sex").val("FEMALE");
            }

            
          });

        }
      });

    });


    // Update Form Action
    $(document).on("submit", "#ptcpt_update_body #ptcpt_update_form", function () {
      $('#ptcpt_update').delay(50).fadeOut(50);
      setTimeout(function(){
        $('#ptcpt_update').modal("hide");  
      }, 100);
    });


  </script> 
    
@endsection