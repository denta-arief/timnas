@extends('layouts.report')

@section('content')

   
        <div class="row">
          <div class="col-md-12 col-sm-12  ">
            <div class="x_panel" >
              <div class="x_content">
                  <!-- start project list -->
                  @include('report.header')
                  <div>
                    <a>Tanggal : {{ $valueTanggal }}</a>
                    <table class="table table-striped projects">
                      <thead>
                        <tr align="center">
                          <th rowspan="2" style="width: 1%">ID</th>
                          <th rowspan="2" style="width: 20%">SITE</th>
                          <th rowspan="2">IP ADDRESS</th>
                          <th colspan="{{ $jml }}">Waktu</th>
                        </tr>
                        <tr>
                          @foreach ($hour as $jam )
                            <th> {{ $jam->rpt_daily_hours }}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($device as $item)
                          <tr>
                            <td>
                              {{ $item->id }}
                            </td>
                            <td>
                              {{ $item->device_site_kode }}
                            </td>
                            <td>
                              {{ $item->device_ip }}
                            </td>

                            @foreach ($arr_status[$item->id] as $dev)
                            @if ($dev == 'UP')
                              <td style="text-align: center"><i class='fa fa-check-square-o'></i></td>
                            @elseif ($dev== 'DOWN')
                              <td style="text-align: center"><i class='fa fa-times-circle'></i></td>
                            @else
                              <td style="text-align: center">NODATA</td>
                            @endif
                            @endforeach

                          </tr>
                        @endforeach

                      </tbody>
                    </table>
                  </div>
                  
                  <!-- end project list -->
              </div>
            </div>
          </div>
        </div>
   
@endsection
