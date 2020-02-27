@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Profile</h1>
</section>

<section class="content">

  <div class="row">
    <div class="col-md-4">
      <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-aqua" style="background: url({{asset('images/sra.jpg')}}) center center; background-size: cover;">
          <h3 class="widget-user-username">{{ Auth::check() ? Auth::user()->fullname : '' }}</h3>
          <h5 class="widget-user-desc">{{ Auth::check() ? Auth::user()->position : '' }}</h5>
        </div>
        <div class="widget-user-image">
          <img class="img-circle" src="{{asset('images/avatar.jpeg')}}" alt="User Avatar">
        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-6 border-right">
              <div class="description-block">
                <h5 class="description-header">{{number_format($total_encoded)}}</h5>
                <span class="description-text">Entries you encoded</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-6 border-right">
              <div class="description-block">
                <h5 class="description-header">{{number_format($total_updated) }}</h5>
                <span class="description-text">Entries last updated by you</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <div class="box-footer no-padding">
          <ul class="nav nav-stacked">
            <li class="bg-teal">
              <a href="#"  class="no-hover">
                <center>Account details</center>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-user margin-r-5"></i> Firstname 
                <span class="pull-right text-strong">
                  {{ Auth::user()->firstname }}
                </span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-user margin-r-5"></i> Middlename 
                <span class="pull-right text-strong">
                  {{ Auth::user()->middlename }}
                </span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-user margin-r-5"></i> Lastname
                <span class="pull-right text-strong">
                  {{ Auth::user()->lastname }}
                </span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-male margin-r-5"></i> Position 
                <span class="pull-right text-strong">
                  {{ Auth::user()->position }}
                </span>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-key margin-r-5"></i> Username
                <span class="pull-right text-strong" for="username">
                  {{ Auth::user()->username }}
                </span>
              </a>
            </li>


            <li>
              <a href="#">
                <i class="fa fa-envelope margin-r-5"></i> Email
                <span class="pull-right text-strong">
                  {{ Auth::user()->email }}
                </span>
              </a>
            </li>
            <li class="bg-teal">
              <a href="#"  class="no-hover ">
                <center>Account activity</center>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-clock-o "></i> Last Login Time
                <span class="pull-right text-strong">
                  {{ __dataType::date_parse(Auth::user()->last_login_time, 'M d, Y h:i A') }}
                </span>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa  fa-desktop margin-r-5"></i> Last Login Machine
                <span class="pull-right text-strong">
                  {{ Auth::user()->last_login_machine }}
                </span>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa  fa-asterisk margin-r-5"></i> Last Login Local IP
                <span class="pull-right text-strong">
                  {{ Auth::user()->last_login_ip }}
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>



    <div class="col-md-8">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#activity_logs" data-toggle="tab" aria-expanded="true">
              <i class="fa fa-clock-o"></i> Activity
            </a>
            </li>
          <li class="">
            <a id="a_s" href="#settings" data-toggle="tab" aria-expanded="false">
             <i class="fa fa-gears"></i> Account Settings
            </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="activity_logs">
            {{-- <div class="callout bg-gray">
                <h4>On going update!</h4>

                <p>
                  All your activity will appear here soon. Try 
                  <a href="#" style="color: blue;" onclick="$('#a_s').click()">Account Settings</a> instead.
                </p>
            </div> --}}
            <h4>Your activities</h4>
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
                      <label>Module:</label>
                      <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm module filters">
                        <option value="">All</option>
                        @foreach($modules as $key => $module)
                          <option value="{{$module}}">{{$key}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-1 col-sm-2 col-lg-2">
                      <label>Event:</label>
                      <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm event filters">
                        <option value="">All</option>
                        @foreach($events as $key => $event)
                          <option value="{{$event}}">{{$key}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-2 col-sm-4 col-lg-4">
                      <div class="form-group">
                        <label>Date range:</label>

                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right filters" id="date_range" autocomplete="off">
                          <span class="input-group-btn">
                          <button type="button" class="btn btn-warning clearBtn" title="Clear dates" disabled="disabled">
                            <i class="fa fa-times"></i>
                          </button>
                        </span>

                        </div>
                        <!-- /.input group -->
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>


            <div id="activity_logs_container" style="display: none">
              <table class="table table-bordered table-striped" id="activity_logs_table" style="width: 100% !important">
                <thead>
                  <tr>
                    <th>Module</th>
                    <th>Event</th>
                    <th>Action</th>
                    <th>Timestamp</th>
                    <th>TimestampDefault</th>
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
          <!-- /.tab-pane -->
          <div class="tab-pane" id="settings">
            <div class="row">

              {{-- USERNAME SETTINGS --}}
              <div class="col-md-4">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Username
                  </div>
                  <div class="panel-body">
                    <form id="username_form" autocomplete="off" action="">

                      @csrf

                      <input name="_method" value="PATCH" type="hidden">

                      <div class="row">
                        {!! __form::textbox(
                          '12 username', 'username', 'text', 'Username *', 'Username', Auth::user()->username , 'username', '', ''
                        ) !!}

                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">
                          <i class="fa fa-save"></i> Save 
                        </button>
                      </div>

                    </form>
                  </div>
                </div>
              </div>

              {{-- PASSWORD SETTINGS --}}

              <div class="col-md-8">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Password
                  </div>
                  <div class="panel-body">
                    <form id="password_form" autocomplete="off" action="">
                      <div class="row">
                        {!! __form::textbox_password_btn(
                        '4 old_password', 'old_password', 'Old Password *', 'Old Password', '', 'password', '', ''
                        ) !!}

                        {!! __form::textbox_password_btn(
                            '4 password', 'password', 'Password *', 'Password', '', 'password', '', ''
                        ) !!}

                        {!! __form::textbox_password_btn(
                            '4 password_confirmation', 'password_confirmation', 'Confirm Password *', 'Confirm Password', '', 'password_confirmation', '', ''
                        ) !!}
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">
                          <i class="fa fa-save"></i> Save 
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>


          



          {{-- COLOR SETTINGS --}}
            <div class="panel panel-default">
              <div class="panel-heading">
                Color Scheme
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="scrolling-wrapper">
                      @php
                        $themes = __static::user_colors();
                        ksort($themes);
                      @endphp
                      @foreach($themes as $key => $color)
                        @if(Auth::user()->color == $color)
                          @php
                            $bg = 'bg-success';
                            $check = '<i class="fa fa-check"></i>';
                          @endphp
                        @else
                          @php
                            $bg = 'bg-none';
                            $check = '';
                          @endphp
                        @endif
                        <div class="scrolling-card" data="{{$color}}">
                          <ul class="mailbox-attachments clearfix">
                            <li class="scrolling-li {{$bg}}" data="{{$color}}">
                               <span class="mailbox-attachment-icon has-img"><img src="{{ asset('images/skins') }}/{{$color}}.jpg"></span>

                              <div class="mailbox-attachment-info">
                                <a href="#" class="mailbox-attachment-name">{{$key}}
                                  <span class="pull-right check text-green">
                                  @php echo $check;
                                  @endphp
                                  </span>
                                </a>
                              </div>
                            </li>
                          </ul>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->

        </div>
        <!-- /.tab-content -->
      </div>




  </div>

</section>
</div>
@endsection






@section('scripts')
  <script type="text/javascript">
    function filter_dt(){
      mod = $(".module").val();
      event = $(".event").val();
      date_range = $("#date_range").val();
      activity_tbl.ajax.url(
        "{{ route('dashboard.profile.details') }}?mod="+mod+"&event="+event+"&date_range="+date_range).load();

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

    activity_tbl = $("#activity_logs_table").DataTable({
      'dom' : 'lBfrtip',
      "processing": true,
      "serverSide": true,
      "ajax" : '{{ route("dashboard.profile.details") }}',
      "columns": [
          { "data": "module" },
          { "data": "event" },
          { "data": "remarks" },
          { "data": "created_at" },
          { "data": "created_at_raw" },
      ],
      'order': [[4, 'desc']],
      buttons: [
          {!! __js::dt_buttons() !!}
      ],
      "columnDefs":[
        {
          "targets" : 0,
          "class" : 'th-90'
        },
        {
          "targets" : 1,
          "class" : 'sex-th'
        },
        {
          "targets" : 3,
          "class" : 'time-th'
        },
        {
          "targets": 4, 
          "visible" :false
        }
      ],
      "responsive": false,
      "initComplete": function( settings, json ) {
          $('#tbl_loader').fadeOut(function(){
            $("#activity_logs_container").fadeIn();
          });
        },
      "language": 
        {          
          "processing": "<center><img style='width: 70px' src='{{ asset('images/loader.gif') }}'></center>",
        },
      "drawCallback": function(settings){
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="modal"]').tooltip();
      
      }
    })

    //Search Bar Styling
    style_datatable('#activity_logs_table');

    //Need to press enter to search
      $('#activity_logs_table_filter input').unbind();
      $('#activity_logs_table_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
              activity_tbl.search(this.value).draw();
          }
      });

    $("#date_range").daterangepicker({

    });
    $("#date_range").val('');

    $("body").on("click",".clearBtn", function(){
      $("#date_range").val('');
      $("#date_range").change();
      $(this).attr("disabled","disabled");
    })


    $(".filters").change(function(){
      filter_dt();
      if($("#date_range").val()!=""){
        $(".clearBtn").removeAttr('disabled');
      }
    })

    $(".scrolling-card").click(function(event) {
      color = $(this).attr('data');

      $.ajax({
        url: "{{ route('dashboard.profile.update_account_color') }}",
        data: {color:color},
        type: "PATCH",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
          $("body").attr("class","");
          $("body").addClass(response);
          $(".scrolling-li").each(function(index, el) {
            $(this).removeClass('bg-success');
            $(this).addClass('bg-none');
            $(this).find('.check').html('');
          });
          to_change = $(".scrolling-li[data='"+response+"']");
          to_change.removeClass('bg-none');
          to_change.addClass('bg-success');
          to_change.find('.check').html('<i class="fa fa-check"></i>');
          notify("Color scheme was changed.","success");
        },
        error: function(response){
          console.log(response);
          notify("Error: "+response, "danger");
        }
      })
    });
    
    $("#username_form").submit(function(e) {
      e.preventDefault();
      wait_button("#username_form");
      $.ajax({
        url : "{{ route('dashboard.profile.update_account_username') }}",
        data: $(this).serialize(),
        type: "PATCH",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
          succeed("#username_form","save",false);
          $("span[for='username']").html(response);
          notify("Username successfully updated.","success");
        },
        error: function(response){
          errored("#username_form","save",response);
        }
      })
    });

    $("#password_form").submit(function(e) {
      e.preventDefault();
      wait_button("#password_form");
      $.ajax({
        url: "{{ route('dashboard.profile.update_account_password') }}",
        data: $(this).serialize(),
        type: "PATCH",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
          console.log(response);

          $(".old_password").removeClass('has-error');
          $(".old_password span").remove();


          if(response == -1){
            succeed("#password_form","save", false);
            $(".old_password").addClass('has-error');
            $(".old_password").append('<span class="help-block">Incorrect password.</span>');
          }
          if(response == 1){
            succeed("#password_form","save", true);
            notify("Password updated.","success");
          }
        },
        error: function(response){
          console.log(response);
          errored("#password_form","save",response);
        }
      })
    });

    {!! __js::show_hide_password() !!}

  </script>
  
@endsection