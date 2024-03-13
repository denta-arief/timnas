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
                              {{-- <td>
                                {{ $dev }}
                              </td> --}}
                              @if ($dev == 'UP')
                                <td><i class="fa-solid fa-check"></i></td>
                              @elseif ($dev== 'DOWN')
                                <td><i class="fa-solid fa-circle-xmark"></i></i></td>
                              @else
                                <td>NODATA</td>
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

@section('style')

    <!-- iCheck -->
    <link href="/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

@endsection