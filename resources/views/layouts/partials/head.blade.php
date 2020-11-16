<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield("title")</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{url(asset("css/bootstrap.min.css"))}}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{url(asset("/css/font-awesome.min.css"))}}">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{url("css/line-awesome.min.css")}}">
		
        	<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset("css/select2.min.css")}}">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{url(asset("css/bootstrap-datetimepicker.min.css"))}}">
		
		<!-- Calendar CSS -->
		<link rel="stylesheet" href="{{url(asset("css/fullcalendar.min.css"))}}">

        <!-- Tagsinput CSS -->
		<link rel="stylesheet" href="{{url(asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css"))}}">

		<!-- Datatable CSS -->
		<link rel="stylesheet" href="{{url(asset("css/dataTables.bootstrap4.min.css"))}}">
        
		<!-- Chart CSS -->
		<link rel="stylesheet" href="{{url(asset("plugins/morris/morris.css"))}}">
		<!-- Summernote CSS -->
		<link rel="stylesheet" href="{{url(asset("plugins/summernote/dist/summernote-bs4.css"))}}">
        <script type="text/javascript"src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Jrp9PtHe0WapppUzxbIpMDWMAcV3qE4"></script>
        <script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Main CSS -->
        <link rel="stylesheet" href="{{url(asset("css/style.css"))}}">
        <script src="{{url(asset("js/jquery-3.2.1.min.js"))}}"></script>
        <style>
            .dataTables_filter{
                display: none;
            }
            div.dt-button-collection {
                position: absolute;
                width: 150px;
                margin-left: 20px;
                margin-top: 8px;
                /*padding: 8px 8px 4px 8px;*/
                /*border:solid darkgrey;*/
                background-color: white;
                z-index: 2002;
                border-radius: 5px;
                box-shadow: 5px 3px 5px rgba(0,0,0,0.3);
            }
            .buttons-collection{
                background-color: white;
                width: 120px;
                color: black;
                border-radius: 6px;
                padding: 8px 20px;
                border: 2px solid #4CAF50; /* Green */
                transition-duration: 0.4s;
                cursor: pointer;

            }
            .buttons-copy{
                background-color: white;
                width: 130px;
                margin-left: 10px;
                margin-top: 5px;
                color: black;
                border-radius: 6px;
                padding: 8px 20px;
                border: 2px solid #4CAF50; /* Green */
                transition-duration: 0.4s;
                cursor: pointer;
            }
            .buttons-csv{
                width: 130px;
                margin-left: 10px;
                margin-top: 5px;
                background-color: white;
                color: black;
                border-radius: 6px;
                padding: 8px 20px;
                border: 2px solid #555555;
                transition-duration: 0.4s;
                cursor: pointer;
            }
            .buttons-pdf{
                width: 130px;
                margin-left: 10px;
                margin-top: 5px;
                background-color: white;
                border-radius: 6px;
                color: black;
                padding: 8px 20px;
                border: 2px solid #e70c0c;
                transition-duration: 0.4s;
                cursor: pointer;
            }
            .buttons-excel{
                width: 130px;
                margin-left: 10px;
                margin-top: 5px;
                background-color: white;
                border-radius: 6px;
                color: black;
                padding: 8px 20px;
                border-color: #9c27b0;
                transition-duration: 0.4s;
                cursor: pointer;
            }
            .buttons-print{
                width: 130px;
                margin-left: 10px;
                margin-top: 5px;
                margin-bottom: 5px;
                background-color: white;
                border-radius: 6px;
                color: black;
                padding: 8px 20px;
                border: 2px solid #d0d5d0;
                transition-duration: 0.4s;
                cursor: pointer;
            }
        </style>

    </head>
