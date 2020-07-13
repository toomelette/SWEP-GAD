
@extends('printables.print_layout_no_header')

@section('body')
<style type="text/css">
  .school{
    width: 15% !important
  }
  .course_applied{
    width: 15% !important
  }

  .scholarship_applied{
    width: 50px !important;
    text-align: center;
  }
  .resolution_no{
    width: 105px ;
    text-align: center
  }
  .mill_district{
    width: 10%
  }

  .numbering{
    width: 10px;
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
          @if(!empty($scholars_group))
            @foreach($scholars_group as $key => $scholars)
              @if(count($scholars) > 0)
                <div class="col-md-12" style="break-after: page;">
                

                  @include('printables.header_sra')

                  <p><b>{{strtoupper($key) }} Scholars</b></p>
                  <p class="text-left" style="font-weight: bold">Total: {{count($scholars)}} {{ ucfirst($key) }} scholars
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
                        
                        <th>Full name</th>
                        
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
                      @if(!empty($scholars))
                          @php
                            $num = 0;
                          @endphp
                        @foreach($scholars as $key=> $scholar)
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
                              {{$scholar->lastname}}, {{$scholar->firstname}} {{$scholar->middlename}}
                            </td>

                            @if(!empty($columns_chosen))
                              @foreach($columns_chosen as $column_chosen)
                                @switch($column_chosen)
                                  @case("birth")
                                    <td class=" {{$column_chosen}}">{{ date("M. d, Y",strtotime($scholar->$column_chosen)) }}</td>
                                    @break

                                  @case("mill_district")
                                    <td class="text-left {{$column_chosen}}">{{ $scholar->millDistrict->mill_district or $scholar->mill_district }}</td>
                                    @break
                                  @case('address')
                                    <td class="text-left {{$column_chosen}}">
                                      @if($scholar->address_specific != "")
                                        {{ $scholar->address_specific }},
                                      @endif

                                      @if($scholar->address_city != "")
                                        {{$scholar->address_city}},
                                      @endif

                                      {{$scholar->address_province}}

                                    </td>
                                    @break
                                  @case("numbering")
                                    @break
                                  @default
                                    <td class="text-left {{$column_chosen}}">{{ $scholar->$column_chosen }}</td>
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