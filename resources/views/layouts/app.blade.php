<!--
=========================================================
* Material Dashboard Dark Edition - v2.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard-dark
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{url(asset("/assets/img/apple-icon.png"))}}">
    <link rel="icon" type="image/png" href="{{url(asset("/assets/img/favicon.png"))}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield("title")
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    <!-- CSS Files -->
    <link href="{{url(asset("assets/css/material-dashboard.css?v=2.1.0"))}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{url(asset("/assets/demo/demo.css"))}}" rel="stylesheet" />
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="{{url(asset("/assets/js/core/jquery.min.js"))}}"></script>
    @yield("csscode")
    <style>
        @font-face {
            font-family: 'Zawgyi-One';
            src: url('https://cdn.rawgit.com/LeonarAung/MyanmarFont/6cf1262f/zawgyi.ttf') format('woff'), url('https://cdn.rawgit.com/LeonarAung/MyanmarFont/6cf1262f/zawgyi.ttf') format('ttf');
        }

        @font-face {
            font-family: 'Unicode';
            src: url('https://cdn.rawgit.com/LeonarAung/MyanmarFont/6cf1262f/mon3.woff') format('woff'), url('https://cdn.rawgit.com/LeonarAung/MyanmarFont/6cf1262f/mon3.ttf') format('ttf');
        }
        input[type="radio"] {
            -ms-transform: scale(1.5); /* IE 9 */
            -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
            transform: scale(1.5);
        }
        .mm-font {
            font-family:Unicode;
        }
        .buttons-copy{
            margin-left: 20px;
            border-radius: 5px;
            color:#fff;background-color:#007bff;border-color:#007bff
        }
        .buttons-csv{
            border-radius: 5px;
            color:#fff;
            background-color:#28a745;
            border-color:#28a745;
        }
        .buttons-pdf{
            border-radius: 5px;
            color:#fff;
            background-color:#dc3545;
            border-color:#dc3545;
        }
        .buttons-excel{
            border-radius: 5px;
            color:#fff;
            background-color:#38c172;
            border-color:#38c172;
        }
        .buttons-print{
            border-radius: 5px;
            color:#000;
            /*background-color:#ffffff;*/
            border-color:#ffffff;
        }
    </style>
</head>
{{--{!! Zawuni::includeFiles() !!}--}}
<body >
<div class="wrapper ">
    @if(\Illuminate\Support\Facades\Auth::check())
        @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole("SuperAdmin")||\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Admin")||\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Agent"))
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{url(asset("/assets/img/sidebar-1.jpg"))}}">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo"><a href="{{url("/home")}}" class="simple-text text-dark logo-normal">
                @php
                    if (Auth::user()->hasAnyRole("Admin"))
                    $company=\App\company::where("admin_id",Auth::user()->id)->first();
                    elseif (Auth::user()->hasAnyRole("Agent")){
                    $admin=\App\agent::where("agent_id",\Illuminate\Support\Facades\Auth::user()->id)->first();
                    $company=\App\company::where("admin_id",$admin->admin_id)->first();
                    }
                    $profile=\App\userprofile::where("user_id",\Illuminate\Support\Facades\Auth::user()->id)->first();
                @endphp
                    @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole("SuperAdmin"))
                    Support Ticket
                    @endif
                @if($company!=null)
                <img src="{{asset("/companylogo/$company->company_logo")}}" alt="Logo" width="40px" height="40px;" class="rounded-circle mr-2">{{$company->company_name}}
            </a>
            @else
                Support Ticket
                @endif
            @endif
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole("SuperAdmin"))
                    <li class="nav-item ">
                        <a class="nav-link text-dark active" href="{{url("/home")}}">
                            <i class="material-icons text-dark">dashboard</i>
                            <p>User Management</p>
                        </a>
                    </li>
                    @elseif(\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Admin"))
                    <li class="nav-item ">
                        <a class="nav-link text-dark " href="{{url("/home")}}">
                            <i class="material-icons text-dark">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                <li class="nav-item ">
                    <a class="nav-link text-dark" href="{{url("/department")}}">
                        <i class="fa fa-users text-gray"></i>
                        <p>Department</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-dark" href="{{url("/agent")}}">
                        <img src="{{url("assets/img/agentpp.png")}}" width="30px;" height="30px" alt="">
                        <span class="ml-3">Agent</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-dark" href="{{url("/case_type")}}">
                        <i class="material-icons text-success">library_books</i>
                        <p>Case Type</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-dark" href="{{url("/priority")}}">
                        <i class="material-icons text-primary">bubble_chart</i>
                        <p>Prority</p>
                    </a>
                </li>
                    <li class="nav-item ">
                        <a class="nav-link text-dark" href="{{url("/piechart")}}">
                            <i class="fa fa-pie-chart text-danger"></i>
                            <p>Pie Chart Report</p>
                        </a>
                    </li>
                <li class="nav-item ">
                    <a class="nav-link text-dark" href="{{url("/ticket/create/".\Illuminate\Support\Facades\Auth::user()->uuid)}}">
                        <i class="fa fa-paper-plane text-info"></i>
                        <p>Ticket Create</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{url("/guestUser")}}">
                        <img src="{{url(asset("/assets/img/guestuser.png"))}}" alt="" width="30px;" height="30px">
                        <span class="ml-3">User</span>
                    </a>
                </li>
                @else
                    <li class="nav-item active  ">
                        <a class="nav-link" href="{{url("/home")}}">
                           <i class="fa fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{url("/ticket/create/".\Illuminate\Support\Facades\Auth::user()->uuid)}}">
                            <i class="fa fa-paper-plane text-info"></i>
                            <p>Create Ticket</p>
                        </a>
                    </li>
                    @endif
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="javascript:void(0)">Support Ticket</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    @yield("search")
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                                @endif
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                @if(Auth::check())
                                    <div>

                                        <h5 align="center" class="my-3">
                                            @if($profile==null)
                                            <img src="{{asset("assets/img/user.png")}}" alt="">
                                                <a href="{{url("/pp/change")}}" style="text-decoration: none"><i class="fa fa-edit"></i></a><br>{{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                                            @else
                                                <img src="{{asset("/profile/$profile->profile")}}" width="80px;" height="80px" class="rounded-circle">
                                            <a href="{{url("/pp/change")}}" style="text-decoration: none"><i class="fa fa-edit"></i></a><br>{{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                                        @endif
                                    </div>
                                <a class="dropdown-item" href="{{url("/logout")}}"><span class="ml-4">Logout</span><i class="fa fa-sign-out mr-3 ml-3"></i></a>
                                    <a class="dropdown-item" href="{{url("/user/setting")}}"><span class="ml-4">Change Password</span><i class="fa fa-cog mr-3 ml-3"></i></a>
                                @else
                                <a class="dropdown-item" href="{{url("/login")}}">Login</a>
                                <a class="dropdown-item" href="{{url("/register")}}">Register</a>
                                    @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div >
                @yield("content")
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-left">
                    <ul>
{{--                        <li>--}}
{{--                            <a href="https://www.creative-tim.com">--}}
{{--                                Creative Tim--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li>
                            <a href="https://ticketing.cloudark.biz">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="https://ticketing.cloudark.biz">
                                Blog
                            </a>
                        </li>
{{--                        <li>--}}
{{--                            <a href="https://www.creative-tim.com/license">--}}
{{--                                Licenses--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </nav>
                <div class="copyright float-right" id="date">
                    , made with <i class="material-icons">favorite</i> by
                    <a href="https://www.facebook.com/cinsuandal.cinpu" target="_blank">CinPu</a> for a better web.
                </div>
            </div>
        </footer>
        <script>
            const x = new Date().getFullYear();
            let date = document.getElementById('date');
            date.innerHTML = '&copy; ' + x + date.innerHTML;
        </script>
    </div>
        @else
            <div class="main-panel">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-transparent  fixed-top " id="navigation-example">
                    <div class="container-fluid">
                        <div class="navbar-wrapper">
                            <a class="navbar-brand" href="javascript:void(0)">Support Ticket</a>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end">
                            @yield("search")
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            {{\Illuminate\Support\Facades\Auth::user()->name}}
                                        @endif
                                        <i class="material-icons">person</i>
                                        <p class="d-lg-none d-md-block">
                                        </p>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                        @if(Auth::check())
                                            <div>

                                                <h5 align="center" class="my-3"><img src="{{asset("assets/img/user.png")}}" alt=""><br>{{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                                            </div>
                                            <a class="dropdown-item" href="{{url("/logout")}}"><span class="ml-4">Logout</span><i class="fa fa-sign-out mr-3 ml-3"></i></a>
                                        @else
                                            <a class="dropdown-item" href="{{url("/login")}}">Login</a>
                                            <a class="dropdown-item" href="{{url("/register")}}">Register</a>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
                <div class="content">
                    <div class="container-fluid">
                        @yield("content")
                    </div>
                </div>
                <script>
                    const x = new Date().getFullYear();
                    let date = document.getElementById('date');
                    date.innerHTML = '&copy; ' + x + date.innerHTML;
                </script>
            </div>
        @endif
    @else
        <div class="content">
            <div class=" container-fluid">
                <div class="offset-md-1">
                @yield("content")
                </div>
            </div>
        </div>
    @endif
</div>
<!--   Core JS Files   -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.map"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"> </script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="{{url(asset("/assets/js/core/popper.min.js"))}}"></script>
<script src="{{url(asset("/assets/js/core/bootstrap-material-design.min.js"))}}"></script>
<script src="https://unpkg.com/default-passive-events"></script>
<script src="{{url(asset("/assets/js/plugins/perfect-scrollbar.jquery.min.js"))}}"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!--  Google Maps Plugin    -->
<!--  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->
<!-- Chartist JS -->
<script src="{{url(asset("/assets/js/plugins/chartist.min.js"))}}"></script>
<!--  Notifications Plugin    -->
<script src="{{url(asset("/assets/js/plugins/bootstrap-notify.js"))}}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{url(asset("/assets/js/material-dashboard.js?v=2.1.0"))}}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{url(asset("/assets/demo/demo.js"))}}"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
@yield("scriptcode")

<script>
    $(document).ready(function (){
            @if(session()->has('message'))
        {
            md.showNotification("top", "center","{{ session()->get('message') }}","info");
        }
            @elseif(session()->has('delete')){
            md.showNotification("top", "center","{{ session()->get('delete') }}","danger");
        }
        @endif
    });

    $(document).ready(function() {
        $().ready(function() {
            $sidebar = $('.sidebar');

            $sidebar_img_container = $sidebar.find('.sidebar-background');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');

            window_width = $(window).width();

            $('.fixed-plugin a').click(function(event) {
                // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .active-color span').click(function() {
                $full_page_background = $('.full-page-background');

                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                }
            });

            $('.fixed-plugin .background-color .badge').click(function() {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('background-color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-background-color', new_color);
                }
            });

            $('.fixed-plugin .img-holder').click(function() {
                $full_page_background = $('.full-page-background');

                $(this).parent('li').siblings().removeClass('active');
                $(this).parent('li').addClass('active');


                var new_image = $(this).find("img").attr('src');

                if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    $sidebar_img_container.fadeOut('fast', function() {
                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $sidebar_img_container.fadeIn('fast');
                    });
                }

                if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $full_page_background.fadeOut('fast', function() {
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                        $full_page_background.fadeIn('fast');
                    });
                }

                if ($('.switch-sidebar-image input:checked').length == 0) {
                    var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                }
            });

            $('.switch-sidebar-image input').change(function() {
                $full_page_background = $('.full-page-background');

                $input = $(this);

                if ($input.is(':checked')) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn('fast');
                        $sidebar.attr('data-image', '#');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn('fast');
                        $full_page.attr('data-image', '#');
                    }

                    background_image = true;
                } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr('data-image');
                        $sidebar_img_container.fadeOut('fast');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr('data-image', '#');
                        $full_page_background.fadeOut('fast');
                    }

                    background_image = false;
                }
            });

            $('.switch-sidebar-mini input').change(function() {
                $body = $('body');

                $input = $(this);

                if (md.misc.sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    md.misc.sidebar_mini_active = false;

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                } else {

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                    setTimeout(function() {
                        $('body').addClass('sidebar-mini');

                        md.misc.sidebar_mini_active = true;
                    }, 300);
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function() {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function() {
                    clearInterval(simulateWindowResize);
                }, 1000);

            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();

    });
</script>
</body>

</html>
