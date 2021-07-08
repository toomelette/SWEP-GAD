<form id="edit_project_form" autocomplete="off" data="{{$project->slug}}">
    @csrf
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="add_project_modalLabel">{{$project->project_code}}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            {!! __form::textbox(
              '4 project_code', 'project_code', 'text', 'Project Code *', 'Project Code', $project->project_code, '', '', ''
            ) !!}

            {!! __form::textbox(
              '5 budget', 'budget', 'text', 'GAD Budget *', 'GAD Budget', $project->budget, '', '', '','autonum'
            ) !!}

            {!! __form::select_year('3','Year','year','',$project->year,'') !!}


            {!! __form::textbox(
              '12 activity', 'activity', 'text', 'GAD Activity *', 'GAD Activity', $project->activity, '', '', ''
            ) !!}
        </div>
        <p class="page-header-sm text-info">
            Project Details
        </p>

        <div class="row">
            {!! __form::textbox(
              '6 issue_mandate', 'issue_mandate', 'text', 'Gender Issue/GAD Mandate', 'Gender Issue/GAD Mandate', $project->issue_mandate, '', '', ''
            ) !!}

            {!! __form::textbox(
              '6 cause', 'cause', 'text', 'Cause of Gender Issue', 'Cause of Gender Issue', $project->cause, '', '', ''
            ) !!}

            {!! __form::textbox(
              '6 result_statement', 'result_statement', 'text', 'GAD Result Statement/GAD Objective', 'GAD Result Statement/GAD Objective', $project->result_statement, '', '', ''
            ) !!}

            {!! __form::textbox(
              '6 relevant_org', 'relevant_org', 'text', 'Relevant Oraganization MFO/PAP or PPA', 'Relevant Oraganization MFO/PAP or PPA', $project->relevant_org, '', '', ''
            ) !!}

            {!! __form::textbox(
              '6 performance_indicators', 'performance_indicators', 'text', 'Performance Indicators/Targets', 'Performance Indicators/Targets', $project->performance_indicators, '', '', ''
            ) !!}

            {!! __form::textbox(
              '6 source_budget', 'source_budget', 'text', 'Source of Budget', 'Source of Budget', $project->source_budget, '', '', ''
            ) !!}

            {!! __form::textbox(
              '6 responsible', 'responsible', 'text', 'Responsible Unit/Office', 'Responsible Unit/Office', $project->responsible, '', '', ''
            ) !!}
        </div>
    </div>
    <div class="modal-footer">

        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save changes</button>
    </div>
</form>

<script type="text/javascript">
    autonum_settings = {
        currencySymbol : ' ₱',
        decimalCharacter : '.',
        digitGroupSeparator : ',',
    };

    $("#edit_project_form .autonum").each(function(){
        new AutoNumeric(this, autonum_settings);
    })

    $('#edit_other_form .select2').select2();
</script>