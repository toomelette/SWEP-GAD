@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Add Seminar</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.menu.store') }}">

        <div class="box-body">

          <div class="col-md-11">
                  
            @csrf    

            {!! __form::textbox(
              '4', 'name', 'text', 'Name *', 'Name', old('name'), $errors->has('name'), $errors->first('name'), ''
            ) !!}

          </div>


        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection





@section('modals')

  @if(Session::has('MENU_CREATE_SUCCESS'))

    {!! __html::modal(
      'menu_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('MENU_CREATE_SUCCESS')
    ) !!}
  
  @endif

@endsection 






@section('scripts')

  <script type="text/javascript">

    @if(Session::has('MENU_CREATE_SUCCESS'))
      $('#menu_create').modal('show');
    @endif

  </script>
    
@endsection