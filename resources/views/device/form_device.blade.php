@extends('layouts.app')

@section('content')

<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Tambah Device</h3>
        </div>

        <div class="title_right">
          <div class="col-md-5 col-sm-5   form-group pull-right top_search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Form Device <small>silahkan isi lengkap data device yang akan ditambahkan </small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class="dropdown-item" href="#">Settings 1</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    @if( @isset( $device->device_name))
                        <form method="POST" action="{{ url('/devices/update') }}/{{ $device->id }}" data-parsley-validate class="form-horizontal form-label-left">
                            <input hidden type="text" id="device_id" class="form-control" name="device_id" value="{{ $device->id}}">
                    @else
                        <form method="POST" action="{{ url('/devices/store') }}" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    @endif
                        @csrf
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="device_name">Nama Device <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="device_name" required="required" class="form-control" name="device_name" @if( @isset( $device->device_name))
                                    value="{{ $device->device_name}}"
                                @endif >
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="device_type">Jenis Device <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <select name="device_type" id="device_type" class="form-control">
                                    <option value="default_device"> <small>Pilih jenis device..</small></option>
                                    @if (@isset( $device->id))
                                        @foreach ($type as $key => $value)
                                            <option value="{{ $key }}" {{ $device->device_jenis == $value ? 'selected' : ''}}> 
                                                {{ $value }} 
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($type as $key => $value)
                                            <option value="{{ $key }} "> {{ $value }} </option>
                                        @endforeach
                                    @endif
                                    
                                   
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="device_ip" class="col-form-label col-md-3 col-sm-3 label-align">IP Address<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="device_ip" class="form-control" type="text" required="required" name="device_ip" @if ( @isset( $device->device_ip))
                                    value="{{ $device->device_ip }}"
                                @endif>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="site" class="col-form-label col-md-3 col-sm-3 label-align">Site <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <select name="site" id="site" class="form-control">
                                    <option value="default_site"> <small>Pilih letak site..</small></option>
                                    @if (@isset( $device->id))
                                        @foreach ($site as $key => $value)
                                            <option value="{{ $key }}" {{ $device->device_site_kode == $key ? 'selected' : ''}}> 
                                                {{ $value }} 
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($site as $key => $value)
                                            <option value="{{ $key }} "> {{ $value }} </option>
                                        @endforeach
                                    @endif
                            </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="swstatus" class="col-form-label col-md-3 col-sm-3 label-align">Status </label>
                            <div class="col-md-6 col-sm-6 ">
                                <div class="">
                                    <label>
                                    @if (@isset( $device->id))
                                        @if ( $device->device_status == "AKTIF" )
                                            <input type="checkbox" name="swstatus" id="swstatus" checked/>
                                            <b id="lblstatus" name="lblstatus">Aktif</b>
                                        @else
                                            <input type="checkbox" name="swstatus" id="swstatus" /> 
                                            <b id="lblstatus" name="lblstatus">Non Aktif</b>
                                        @endif
                                    @else
                                        <input type="checkbox" name="swstatus" id="swstatus" checked/>
                                        <b id="lblstatus" name="lblstatus">Aktif</b>
                                    @endif
                                           
                                        
                                    </label>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <a href="{{ url('/devices') }}" class="btn btn-primary" type="button">Cancel</a>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
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

    @section('script')
    <!-- bootstrap-progressbar -->
    <script src="/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="/vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/vendors/moment/min/moment.min.js"></script>
    <script src="/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="/vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="/vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="/vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="/vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="/vendors/starrr/dist/starrr.js"></script>

    <script>
        // Initialize Switchery after the page has loaded
        document.addEventListener('DOMContentLoaded', function () {
            var switchButton = document.getElementById('swstatus');
            var switchLabel = document.getElementById('lblstatus');
            var switchery = new Switchery(switchButton);

            // Add event listener to handle switch changes
            switchButton.addEventListener('change', function() {
                var status = switchButton.checked ? 'Aktif' : 'Non Aktif';
                switchLabel.textContent = status;
            });
        });
    </script>
@endsection