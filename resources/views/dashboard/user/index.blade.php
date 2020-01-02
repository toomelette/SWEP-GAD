




@extends('layouts.admin-master')

@section('content')
    
<section class="content-header">
  <h1>Manage Users</h1>
</section>

<section class="content">
  {{-- Table Grid --}}        
  
   <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Users</h3>
        <div class="pull-right">
          <button type="button" class="btn bg-purple" data-toggle="modal" data-target="#add_user_modal"><i class="fa fa-plus"></i> New User</button>
        </div>
      </div>

      <div class="box-body">
        <div id="users_table_container" style="display: none">
          <table class="table table-bordered table-striped table-hover" id="users_table" style="width: 100% !important">
            <thead>
              <tr>
                <th class="th-20">Username</th>
                <th >Full Name</th>
                <th class="th-10">Status</th>
                <th class="th-10">Account</th>
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
    </div>




  </div>
</section>



@endsection






@section('modals')
<div id="add_user_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <form id="add_user_form">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New User</h4>
        </div>
        <div class="modal-body">
          <form id="user_create_form" class="form-horizontal">

        <div class="box-body">                  
              @csrf

              <div class="row">
                  {!! __form::textbox(
                    '4 firstname', 'firstname', 'text', 'Firstname *', 'Firstname', '', '', '', ''
                  ) !!}

                  {!! __form::textbox(
                    '4 middlename', 'middlename', 'text', 'Middlename *', 'Middlename', '', '', '', ''
                  ) !!}

                  {!! __form::textbox(
                    '4 lastname', 'lastname', 'text', 'Lastname *', 'Lastname', '', '', '', ''
                  ) !!}

              </div>
              <div class="row">
                  {!! __form::textbox(
                    '6 email', 'email', 'email', 'Email *', 'Email', '', '', '', ''
                  ) !!}

                  {!! __form::textbox(
                    '6 position', 'position', 'text', 'Position *', 'Position', '', '', '', ''
                  ) !!}
              </div>

              <div class="row">
                {!! __form::textbox(
                    '4 username', 'username', 'text', 'Username *', 'Username', '', '', '', ''
                ) !!}

                {!! __form::textbox_password_btn(
                    '4 password', 'password', 'Password *', 'Password', '', '', '', ''
                ) !!}

                {!! __form::textbox_password_btn(
                    '4 password_confirmation', 'password_confirmation', 'Confirm Password *', 'Confirm Password', '', '', '', ''
                ) !!}

              </div>
              <div class="row">
                <div class="col-sm-12">
                  <h4>User Menu 
                    <span class="pull-right ">
                      <small class="text-info">You can use CTRL & SHIFT keys for multiple selection. CTRL+A to select all.</small>
                    </span>
                   </h4>
                  <hr style="margin: 0 0 10px 0">
                </div>

                @foreach ($menus as $key => $sub)
                <div class="col-md-4">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <i class="fa {{ $sub->icon }}"></i>
                      {{ $sub->name }}
                      <div class="pull-right">
                        <button class="btn btn-xs btn-default clear_btn" type="button">Clear</button>
                      </div>
                    </div>
                    <div class="panel-body" style="min-height: 180px">
                      <div class="row">
                        <div class="col-sm-12">
                          @if($sub->submenu->isEmpty())
                          <center>
                            <label>No submenu found for this Menu</label>
                          </center>
                            
                          @else
                            <select multiple name="menu[{{$sub->menu_id}}][]" class="form-control select_multiple" size="6">                   
                                  @foreach($sub->submenu as $key2 => $submenu)
                                   <option value="{{$submenu->submenu_id}}">
                                    {{ str_replace($sub->name,'', $submenu->name) }}
                                  </option>                            
                                  @endforeach                               
                              
                            </select>
                            <span class="help-block">No module selected</span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              {{-- <div class="row">
                <div class="col-sm-12">
                  <div class="box-header with-border">
                    <h3 class="box-title">User Menu</h3>
                    <button type="button" class="btn btn-sm bg-green pull-right add_row"><i class="fa fw fa-plus"></i> Add Row</button>
                  </div>
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 120px">Menus *</th>
                      <th>Menu Modules</th>
                      <th style="width: 40px"></th>
                    </tr>

                    <tbody id="table_body">
                      @foreach ($menus as $key => $sub)
                        <tr>
                          <td>{{$sub->name}}</td>
                          <td>
                            <div class="row">
                              <select multiple name="menu[{{$sub->menu_id}}][]" class="form-control">
                                <option value=""></option>
                                @foreach($sub->submenu as $key2 => $submenu)
                                 <option value="{{$submenu->submenu_id}}">{{$submenu->name}}</option>
                              
                                @endforeach
               
                              </select>
                              
                            </div>
                          </td>
                          <td></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div> --}}
             

 

          {{-- USER MENU DYNAMIC TABLE GRID --}}
          <div class="col-md-12" style="padding-top:50px;">
            <div class="box box-solid">
              
              
              <div class="box-body no-padding">
                
      
               
              </div>

            </div>
          </div>

        </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary add_user_btn"><i class="fa fa-save fa-fw"></i> Save</button>
        </div>
      </form>
    </div>

  </div>
</div>

<div class="modal fade" id="view_user_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        
          
        </div>
    </div>
  </div>

<div style="display: none;">
  <div id="modal_loader">
    <center>
      <img style="width: 70px; margin: 40px 0;" src="{{ asset('images/loader.gif') }}">
    </center>
  </div>
</div>

@endsection 






@section('scripts')
<script type="text/javascript">

  modal_loader = $("#modal_loader").parent('div').html();
  active = '';
  //-----DATATABLES-----//
      //Initialize DataTable
      users_table = $("#users_table").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax" : '{{ route("dashboard.user.index") }}',
        "columns": [
            { "data": "username" },
            { "data": "fullname" },
            { "data": "online" },
            { "data": "active" },
            { "data": "action" }
        ],
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        "columnDefs":[
          {
            "targets" : 4,
            "orderable" : false,
            "class" : 'action'
          },
        ],
        "responsive": false,
        "initComplete": function( settings, json ) {
            $('#tbl_loader').fadeOut(function(){
              $("#users_table_container").fadeIn();
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
             $("#users_table #"+active).addClass('success');
          }
        }
      })

      $('#users_table_filter input').css("width","300px");
      $("#users_table_filter input").attr("placeholder","Press enter to search");

      //Need to press enter to search
      $('#users_table_filter input').unbind();
      $('#users_table_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
              users_table.search(this.value).draw();
          }
      });


      $("body").on("click",".show_pass", function(){
        t = $(this);
        input = $(this).parent("span").siblings('input');
        
        if(input.attr("type")=="password"){
          input.attr("type","text");
          t.html("<i class='fa fa-eye'></i>");
        }else{
          input.attr("type","password");
          t.html("<i class='fa fa-eye-slash'></i>");
        }

      })

      $("#add_user_form").submit(function(e){
        e.preventDefault();
        uri = "{{ route('dashboard.user.store') }}";
        add_user_btn = $(".add_user_btn");
        add_user_btn_html = add_user_btn.html();
        add_user_btn.html('<i class="fa fa-spinner fa-spin"></i> Please wait');
        add_user_btn.attr('disabled', 'disabled');
        $.ajax({
          url: uri,
          data: $(this).serialize(),
          type: 'POST',
          dataType: 'json',
          success: function(response) {
             $("#add_user_form .has-error").each(function(){
              $(this).removeClass("has-error");
              $(this).children("span").remove();
            });

            add_user_btn.html(add_user_btn_html);
            add_user_btn.removeAttr('disabled');
            users_table.draw(false);
            active = response.slug;
          },
          error: function (response) {
            console.log(response);
            parsed = JSON.parse(response.responseText);
            $("#add_user_form .has-error").each(function(){
              $(this).removeClass("has-error");
              $(this).children("span").remove();
            });

            //console.log(parsed);
            $.each(parsed.errors, function(i, item){
              i = i.replace('.','-');
              i = i.replace('.','-');
              parent = $("#add_user_form ."+i);
              parent.addClass("has-error");
              parent.append('<span class="help-block">'+item+'</span>');
            });
            add_user_btn.html(add_user_btn_html);
            add_user_btn.removeAttr('disabled');

          }
        })
      })

      $("body").on("change", ".select_multiple", function(e){
        selected = $(":selected",this).length;
        all = $(this).children('option').length;
        
        if(selected == 0){
          $(this).siblings('.help-block').html('No module selected');
        }else{
          was_were = 'were';
          module_s = 'modules';
          if(selected <= 1){
            was_were = 'was';
          }
          if(all <= 1){
            module_s = 'module';
          }
          $(this).siblings('.help-block').html( selected + ' out of ' + all +' '+module_s+' '+was_were+' selected.');
        }
      })

      $("body").on('click', '.clear_btn', function() {
      select_element = $(this).parent('div').parent('div').siblings('.panel-body').find('.select_multiple');

       select_element.children('option').prop("selected",false);
       select_element.change();
      });


      $("body").on('click', '.view_user_btn', function() {
        id = $(this).attr('data');
        $("#view_user_modal .modal-content").html(modal_loader);
        uri  =" {{ route('dashboard.user.show','slug') }}";
        uri = uri.replace('slug',id);
        $.ajax({
          url: uri,
          type: 'GET',
          success: function (response) {
            console.log(response);
            $("#view_user_modal #modal_loader").fadeOut(function() {
              $("#view_user_modal .modal-content").html(response);
            });
          },
          error: function (response) {
            console.log(response);
          }
        })

      });

</script>

    
@endsection