




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


    
@endsection