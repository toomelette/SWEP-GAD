
@extends('printables.print_layout_no_header')

@section('body')
<style type="text/css">
  .date{
    text-align: left
  }
  .numbering{
    width: 10px;
  }

  .members, .male_members, .female_members{
    width: 8%
  }
  @media print{
    .noPrint{
      display: none
    }
  }
</style>
  <div style="">
    <div id="loader">
      <center>
        <img style="width: 300px; margin: 40px 0;" src="{!! __static::loader(Auth::user()->color) !!}">
      </center>
    </div>
  </div>

  <div style="" id="content">
    <div class="row">
      <div class="col-md-12">
        <div class="row" >
          <br>
          @if(!empty($block_farms_group))
            @foreach($block_farms_group as $key => $block_farms)
              @if(count($block_farms) > 0)
                <div class="col-md-12" style="break-after: page;">
                

                  @include('printables.header_sra')

                  <p><b>{{strtoupper($key) }} Block Farms</b></p>
                  <p class="text-left" style="font-weight: bold">Total: {{count($block_farms)}} {{ ucfirst($key) }} Block Farms
                    <span class="pull-right">

                      @if(count($filters) > 0 )
                        Filters:
                        <span style="color:red !important">
                          @php  
                            $last_element = end($filters);
                          @endphp
                          @foreach($filters as $key => $filter)
                            {{$filter}}@if($filter != $last_element),@endif
                          @endforeach
                        </span>
                      @endif
                      
                    </span>
                  </p>
                  <table class="table table-bordered">
                     <thead class="">
                      <tr class="text-strong">
                        @if(!empty($columns_chosen))
                          @if(in_array("numbering", $columns_chosen))
                            <th>#</th>
                          @endif
                        @endif
                        
                        <th>Block Farm</th>
                        
                        @if(!empty($columns_chosen))
                          @foreach($columns_chosen as $column_chosen)
                            @switch($column_chosen)
                              @case("numbering")
                                @break
                              @default
                                <th>{{ array_search($column_chosen, $columns) }}</th>
                                @break
                            @endswitch
                          @endforeach
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                      @if(!empty($block_farms))
                          @php
                            $num = 0;
                          @endphp
                        @foreach($block_farms as $key=> $block_farm)
                          @php
                            $num++;
                          @endphp
                          <tr>
                            @if(!empty($columns_chosen))
                              @if(in_array("numbering", $columns_chosen))
                                <td class="numbering text-left">{{$num}}</td>
                              @endif
                            @endif

                            <td class="text-left">
                              {{$block_farm->block_farm_name}}
                            </td>

                            @if(!empty($columns_chosen))
                              @foreach($columns_chosen as $column_chosen)
                                @switch($column_chosen)
                                  @case("date")
                                    <td class=" {{$column_chosen}}">{{ date("M. d, Y",strtotime($block_farm->$column_chosen)) }}</td>
                                    @break

                                  @case("mill_district")
                                    <td class="text-left {{$column_chosen}}">{{ $block_farm->millDistrict->mill_district or $block_farm->mill_district }}</td>
                                    @break
                                  @case('members')
                                    <td class="{{$column_chosen}}">
                                      {{
                                      count($block_farm->blockFarmMembers)
                                      }}
                                    </td>
                                    @break


                                  @case('male_members')
                                    <td class="{{$column_chosen}}">
                                      {{
                                      count($block_farm->blockFarmMembers->where('sex','=',"MALE"))
                                      }}
                                    </td>
                                    @break
                                  @case('female_members')
                                    <td class="{{$column_chosen}}">
                                      {{
                                      count($block_farm->blockFarmMembers->where('sex','=',"FEMALE"))
                                      }}
                                    </td>
                                    @break


                                  @case("numbering")
                                    @break
                                  @default
                                    <td class="text-left {{$column_chosen}}">{{ $block_farm->$column_chosen }}</td>
                                @endswitch
                              @endforeach
                            @endif
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                  <hr class="noPrint" style="border: 1px dashed blue !important">
                </div>

              @endif
            @endforeach
          @else
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> No data!</h4>
              We have not found any data based on your filters.
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $("#loader").fadeOut(function(){
        $("#content").fadeIn(1000);
      })
    })
  </script>
@endsection