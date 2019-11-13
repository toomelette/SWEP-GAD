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
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.seminar.store') }}" enctype="multipart/form-data">

        <div class="box-body">

          <div class="col-md-12">
                  
            @csrf    

            {!! __form::file(
             '4', 'doc_file', 'Attendance Sheet', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 

            {!! __form::textbox(
              '8', 'title', 'text', 'Title *', 'Title', old('title'), $errors->has('title'), $errors->first('title'), ''
            ) !!}

            {!! __form::textbox(
              '4', 'sponsor', 'text', 'Sponsor *', 'Sponsor', old('sponsor'), $errors->has('sponsor'), $errors->first('sponsor'), ''
            ) !!}

            {!! __form::textbox(
              '4', 'venue', 'text', 'Venue *', 'Venue', old('venue'), $errors->has('venue'), $errors->first('venue'), ''
            ) !!}

            {!! __form::datepicker(
              '4', 'date_covered_from',  'Date From *', old('date_covered_from') ? old('date_covered_from') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_from'), $errors->first('date_covered_from')
            ) !!}

            {!! __form::datepicker(
              '4', 'date_covered_to',  'Date To *', old('date_covered_to') ? old('date_covered_to') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_to'), $errors->first('date_covered_to')
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

    {!! __js::pdf_upload('doc_file', 'fa', '') !!}

  </script>
    
@endsection