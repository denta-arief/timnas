@extends('layouts.app')

@section('content')
<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>LIST ALL DEVICE</h3>
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


      @foreach ($type as $tipe )
        <div class="row">
          <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
              <div class="x_title">
                <h2>{{ $tipe->type_name }} Unit</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Settings 1</a>
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
                  <table class="table table-striped projects">
                    <thead>
                      <tr>
                        <th style="width: 1%">ID</th>
                        <th style="width: 20%">DEVICE NAME</th>
                        <th>TIPE</th>
                        <th>SITE</th>
                        <th>STATUS</th>
                        <th style="width: 20%">#Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($device as $alat )
                        @if ($alat->device_jenis == $tipe->type_name )
                          <tr>
                            <td>
                              {{ $alat->id  }}
                            </td>
                            <td>
                              <a> {{ $alat->device_name }}</a>
                              <br />
                              <small>{{ $alat->device_ip }}</small>
                            </td>
                            <td>
                              <a>{{ $alat->device_jenis }}</a>
                            </td>
                            <td>
                              <a>{{ $alat->device_site_kode }} </a>
                            </td>
                            <td>
                              <button type="button" class="btn  @if($alat->device_status=="AKTIF")
                                btn-success
                              @else
                              btn-danger
                              @endif btn-xs">{{ $alat->device_status }}</button>
                            </td>
                            <td>
                              <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                              <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              {{-- <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a> --}}
                            </td>
                          </tr>  
                        @endif               
                      @endforeach

                    </tbody>
                  </table>
                  <!-- end project list -->
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
</div>
@endsection('content')