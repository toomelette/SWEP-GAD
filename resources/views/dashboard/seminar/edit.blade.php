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
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.seminar.update', $seminar->slug) }}">

        <div class="box-body">

          <div class="col-md-12">
                    
            @csrf    

            <input name="_method" value="PUT" type="hidden">

            {!! __form::textbox(
              '6', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $seminar->title, $errors->has('title'), $errors->first('title'), ''
            ) !!}

            {!! __form::datepicker(
              '3', 'date_covered_from',  'Date From *', old('date_covered_from') ? old('date_covered_from') : __dataType::date_parse($seminar->date_covered_from), $errors->has('date_covered_from'), $errors->first('date_covered_from')
            ) !!}

            {!! __form::datepicker(
              '3', 'date_covered_to',  'Date To *', old('date_covered_to') ? old('date_covered_to') : __dataType::date_parse($seminar->date_covered_to), $errors->has('date_covered_to'), $errors->first('date_covered_to')
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