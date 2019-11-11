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
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.seminar.store') }}">

        <div class="box-body">

          <div class="col-md-12">
                  
            @csrf    

            {!! __form::textbox(
              '6', 'title', 'text', 'Title *', 'Title', old('title'), $errors->has('title'), $errors->first('title'), ''
            ) !!}

            {!! __form::datepicker(
              '3', 'date_covered_from',  'Date From *', old('date_covered_from') ? old('date_covered_from') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_from'), $errors->first('date_covered_from')
            ) !!}

            {!! __form::datepicker(
              '3', 'date_covered_to',  'Date To *', old('date_covered_to') ? old('date_covered_to') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_to'), $errors->first('date_covered_to')
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

  @if(Session::has('SEMINAR_CREATE_SUCCESS'))

    {!! __html::modal(
      'seminar_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('SEMINAR_CREATE_SUCCESS')
    ) !!}
  
  @endif

@endsection 






@section('scripts')

  <script type="text/javascript">

    @if(Session::has('SEMINAR_CREATE_SUCCESS'))
      $('#seminar_create').modal('show');
    @endif

  </script>
    
@endsection