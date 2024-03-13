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
                        <a class="dropdown-item" href="#"><i class="fa-regular fa-file-pdf"></i> Export PDF</a>
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
    </div>
</div>
@endsection


@section('script')

  <!-- jQuery -->
  <script src="{{ url('/vendors/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ url('/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ url('/vendors/fastclick/lib/fastclick.js') }}"></script>
  <!-- NProgress -->
  <script src="{{ url('/vendors/nprogress/nprogress.js') }}"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="{{ url('/vendors/moment/min/moment.min.js') }}"></script>
  <script src="{{ url('/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <!-- bootstrap-datetimepicker -->    
  <script src="{{ url('/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
  <!-- Ion.RangeSlider -->
  <script src="{{ url('/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js') }}"></script>
  <!-- Bootstrap Colorpicker -->
  <script src="{{ url('/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
  <!-- jquery.inputmask -->
  <script src="{{ url('/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
  <!-- jQuery Knob -->
  <script src="{{ url('/vendors/jquery-knob/dist/jquery.knob.min.js') }}"></script>
  <!-- Cropper -->
  <script src="{{ url('/vendors/cropper/dist/cropper.min.js') }}"></script>

  <!-- Custom Theme Scripts -->
  <script src="{{ url('/build/js/custom.min.js') }}"></script>
@endsection

@section('style')
  <!-- Bootstrap -->
  <link href="{{ url('/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ url('/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{ url('/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
  <!-- bootstrap-daterangepicker -->
  <link href="{{ url('/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
  <!-- bootstrap-datetimepicker -->
  <link href="{{ url('/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
  <!-- Ion.RangeSlider -->
  <link href="{{ url('/vendors/normalize-css/normalize.css') }}" rel="stylesheet">
  <link href="{{ url('/vendors/ion.rangeSlider/css/ion.rangeSlider.css') }}" rel="stylesheet">
  <link href=" {{ url('/vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet">
  <!-- Bootstrap Colorpicker -->
  <link href=" {{ url('/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">

  <link href=" {{ url('/vendors/cropper/dist/cropper.min.css') }}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{ url('/build/css/custom.min.css') }}" rel="stylesheet">
@endsection