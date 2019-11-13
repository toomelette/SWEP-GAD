@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Edit Seminar</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button(['dashboard.seminar.index', 'dashboard.seminar.show']) !!}
    </div>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.seminar.update', $seminar->slug) }}" enctype="multipart/form-data">

        <div class="box-body">

          <div class="col-md-12">
                    
            @csrf    

            <input name="_method" value="PUT" type="hidden">

            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!}

            {!! __form::textbox(
              '8', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $seminar->title, $errors->has('title'), $errors->first('title'), ''
            ) !!}

            {!! __form::textbox(
              '4', 'sponsor', 'text', 'Sponsor *', 'Sponsor', old('sponsor') ? old('sponsor') : $seminar->sponsor, $errors->has('sponsor'), $errors->first('sponsor'), ''
            ) !!}

            {!! __form::textbox(
              '4', 'venue', 'text', 'Venue *', 'Venue', old('venue') ? old('venue') : $seminar->venue, $errors->has('venue'), $errors->first('venue'), ''
            ) !!}

            {!! __form::datepicker(
              '4', 'date_covered_from',  'Date From *', old('date_covered_from') ? old('date_covered_from') : __dataType::date_parse($seminar->date_covered_from), $errors->has('date_covered_from'), $errors->first('date_covered_from')
            ) !!}

            {!! __form::datepicker(
              '4', 'date_covered_to',  'Date To *', old('date_covered_to') ? old('date_covered_to') : __dataType::date_parse($seminar->date_covered_to), $errors->has('date_covered_to'), $errors->first('date_covered_to')
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





@section('scripts')

  <script type="text/javascript">

    {!! __js::pdf_upload(
      'doc_file', 'fa', route('dashboard.seminar.view_attendance_sheet', $seminar->slug)
    ) !!}

  </script> 
    
@endsection