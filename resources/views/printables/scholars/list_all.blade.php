
@extends('printables.print_layout')

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
        <b>LIST OF ALL SCHOLARS</b>

        <div class="row">
          <br>
          <div class="col-md-12">
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

                      {{-- <td>{{$scholar->scholarship_applied}}</td>
                      <td>{{$scholar->birth}}</td>
                      <td>{{$scholar->sex}}</td>
                      <td>{{$scholar->course_applied}}</td>
                      <td>{{$scholar->school}}</td> --}}
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
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