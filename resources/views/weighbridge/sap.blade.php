@extends('layouts.app')
@section('content')

<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Syncronize SAP - DFARM & CMS</h3>
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
        <div class="col-md-12 col-sm-12  ">
          <div class="x_panel">
            <div class="x_title">
              {{-- <h2>Plain Page</h2> --}}
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
                <?php
                    $api_response = '';
                    $selected_date = '';
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $selected_date = isset($_POST['selected_date']) ? $_POST['selected_date'] : '';
                        if ($selected_date) {
                            // Format tanggal menjadi YYYYMMDD
                            $formatted_date = date('Ymd', strtotime($selected_date));
                            $api_url = "https://apis.holding-perkebunan.com/dfarm/sap_api_get_by_date_weighbridge.php?trdate=%27$formatted_date%27";
            
                        }
                    }
                ?>
                <form
                    method="POST" 
                    tanggal = "$selected_date"
                    action="https://apis.holding-perkebunan.com/dfarm/sap_api_get_by_date_weighbridge.php?trdate=%27tanggal%27">
                    
                        <label for="datepicker">Select a date: </label>
                        <input 
                            type="text" id="datepicker" name="selected_date" placeholder="Select a date"
                            echo tanggal
                        >
                    <button type="submit">Submit</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection

@section('script')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true,
                //minDate: new Date(),
                // maxDate: "+1Y"
            });
        });
    </script>
@endsection