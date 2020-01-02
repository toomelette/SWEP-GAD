




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
        <div id="users_table_container">
          <table class="table table-bordered table-striped table-hover" id="users_table" style="width: 100% !important">
            <thead>
              <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Online</th>
                <th>Active</th>
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
      <form>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New User</h4>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>

  </div>
</div>

@endsection 






@section('scripts')
<script type="text/javascript">
  //-----DATATABLES-----//
      //Initialize DataTable
      users_table = $("#users_table").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax" : '{{ route("dashboard.seminar.index") }}',
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
</script>

    
@endsection