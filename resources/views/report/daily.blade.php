@extends('layouts.app')

@section('content')

<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Report Harian</h3>
        </div>

        <div class="title_right">
          <form method="POST" action="{{ url('/report/daily') }}" class="col-md-5 col-sm-5 form-group pull-right top_search">
              @csrf
              
              <div class='input-group date' id='myDatepicker2'>
                <input type='date' class="form-control" id="frm_tanggal" name="frm_tanggal" placeholder="Pilih Tanggal.." />
                
                <span class="input-group-btn">
                  <button class="btn btn-default" type="submit"">Go!</button>
                </span>
                
              </div>
              @error('frm_tanggal')
              
              <div class="alert alert-danger">Silahkan isi tanggal</div>
              @enderror
            </form>        
        </div>
        
      </div>
    </div>

      <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
              <div class="x_title">
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/report/daily/TRUE"><i class="fa-regular fa-file-pdf"></i> Export PDF</a>
                        <a class="dropdown-item" href="#">Settings 2</a>
                      </div>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                
              </div>
             
              <div class="x_content">
                  <!-- start project list -->
                 @include('report.header')
                  <div>
                    <a>Tanggal : {{ $valueTanggal }}</a>
                    <table class="table table-striped projects">
                      <thead>
                        <tr align="center">
                          <th rowspan="2" style="width: 1%">NO</th>
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
                      @php
                           $i=1; 
                      @endphp
                      <tbody>
                        @foreach ($device as $item)
                          <tr>
                            <td>
                              {{ $i ++ }}
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
                                <td style="background-color:red ; text-align: center"><i class='fa fa-times-circle'></i></td>
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
    </div>
</div>
@endsection

