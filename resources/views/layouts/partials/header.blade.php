
<div class="header">

@php
    use Illuminate\Support\Facades\Auth;if (Auth::user()->hasAnyRole("Admin"))
    $company=\App\company::where("admin_id",Auth::user()->id)->first();
    elseif (Auth::user()->hasAnyRole("Agent")){
    $admin=\App\agent::where("agent_id",\Illuminate\Support\Facades\Auth::user()->id)->first();
    $company=\App\company::where("admin_id",$admin->admin_id)->first();
    }elseif(Auth::user()->hasAnyRole("Employee")){
       $employee_admin=\App\employee::where("emp_id",\Illuminate\Support\Facades\Auth::user()->id)->first();
        $company=\App\company::where("admin_id",$employee_admin->admin_id)->first();
    }
    $profile=\App\userprofile::where("user_id",\Illuminate\Support\Facades\Auth::user()->id)->first();
@endphp
            <!-- Logo -->
            <div class="header-left">
                @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole("SuperAdmin"))
                    <a href="{{url("/home")}}" class="simple-text text-dark logo-normal">
                        Support Ticket
                    </a>
                @else
                    @if($company!=null)
                        <a href="{{url("/home")}}" class="logo">
                                <img src="{{asset("/companylogo/$company->company_logo")}}" alt="Logo" width="40px" height="40px;" class="rounded-circle mr-2">
                       <span class="text-white"> {{strtoupper($company->company_name)}}</span>
                        </a>
                    @else
                        <a href="{{url("/home")}}" class="simple-text text-dark logo-normal">
                            Support Ticket
                        </a>
                    @endif
                @endif

            </div>
            <!-- /Logo -->

            <a id="toggle_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            
            <!-- Header Title -->
            <div class="page-title-box">

            </div>
            <!-- /Header Title -->
            
            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
            
            <!-- Header Menu -->
            <ul class="nav user-menu">
            
                <!-- Search -->
                <li class="nav-item">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                       </a>
                        <form action="search">
                            <input class="form-control" type="text" placeholder="Search here">
                            <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </li>
                <!-- /Search -->
            
                <!-- Flag -->
                <li class="nav-item dropdown has-arrow flag-nav">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                        <img src="{{url(asset("img/flags/us.png"))}}" alt="" height="20"> <span>English</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{url(asset("img/flags/us.png"))}}" alt="" height="16"> English
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{url(asset("img/flags/fr.png"))}}" alt="" height="16"> French
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{url(asset("img/flags/es.png"))}}" alt="" height="16"> Spanish
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{url(asset("img/flags/de.png"))}}" alt="" height="16"> German
                        </a>
                    </div>
                </li>
                <!-- /Flag -->
            
                <!-- Notifications -->
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i> <span class="badge badge-pill">3</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="" src="{{url(asset("img/profiles/avatar-02.jpg"))}}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="" src="{{url(asset("img/profiles/avatar-03.jpg"))}}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="" src="{{url(asset("img/profiles/avatar-06.jpg"))}}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="" src="{{url(asset("img/profiles/avatar-17.jpg"))}}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="" src="{{url(asset("img/profiles/avatar-13.jpg"))}}">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
                                                <p class="noti-time"><span class="notification-time">2 days ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <!-- /Notifications -->
                
                <!-- Message Notifications -->
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-comment-o"></i> <span class="badge badge-pill">8</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Messages</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="chat">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar">
                                                    <img alt="" src="{{url(asset("img/profiles/avatar-09.jpg"))}}">
                                                </span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author">Richard Miles </span>
                                                <span class="message-time">12:28 AM</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="chat">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar">
                                                    <img alt="" src="{{url(asset("img/profiles/avatar-02.jpg"))}}">
                                                </span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author">John Doe</span>
                                                <span class="message-time">6 Mar</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="chat">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar">
                                                    <img alt="" src="{{url(asset("img/profiles/avatar-03.jpg"))}}">
                                                </span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author"> Tarah Shropshire </span>
                                                <span class="message-time">5 Mar</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="chat">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar">
                                                    <img alt="" src="{{url(asset("img/profiles/avatar-05.jpg"))}}">
                                                </span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author">Mike Litorus</span>
                                                <span class="message-time">3 Mar</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="chat">
                                        <div class="list-item">
                                            <div class="list-left">
                                                <span class="avatar">
                                                    <img alt="" src="{{url(asset("img/profiles/avatar-08.jpg"))}}">
                                                </span>
                                            </div>
                                            <div class="list-body">
                                                <span class="message-author"> Catherine Manseau </span>
                                                <span class="message-time">27 Feb</span>
                                                <div class="clearfix"></div>
                                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="chat">View all Messages</a>
                        </div>
                    </div>
                </li>
                <!-- /Message Notifications -->

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            @if($profile==null)
                                <span class="status online"></span>
                                <span class="user-img"><img src="{{asset("profile/back.jpg")}}" alt="ggg"  width="20px;" height="20px"></span>
                            <span></span>
                            @else
                                <img src="{{asset("/profile/$profile->profile")}}" width="30px;" height="30px" class="rounded-circle">
                            @endif

                            @endif
                    </a>
                    <div class="dropdown-menu">
                        @if($profile==null)
                            <span class="user-img text-center offset-md-2 mt-2">
                                <img src="{{asset("profile/back.jpg")}}" alt="ggg"  width="40px;" height="30px">
                            </span>
                           <h4 align="center"> {{\Illuminate\Support\Facades\Auth::user()->name}}</h4>
                                @else
                            <span class="user-img text-center offset-2 mt-2">
                                    <img src="{{asset("/profile/$profile->profile")}}" width="40px;" height="40px" class="rounded-circle">
                           <h4 align="center"> {{\Illuminate\Support\Facades\Auth::user()->name}}</h4>
                            </span>
                                @endif

                        <a class="dropdown-item" href="{{url("/pp/change")}}"><i class="fa fa-image mr-2"></i>Change Profile Picture</a>
                        <a class="dropdown-item" href="{{url("/user/setting")}}"><i class="fa fa-cogs mr-2"></i>Password Change</a>
                        <a class="dropdown-item" href="{{url("/logout")}}"><i class="fa fa-sign-out mr-2"></i>Logout</a>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->
            
            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{url("/pp/change")}}"><i class="fa fa-user mr-2"></i>My Profile</a>
                    <a class="dropdown-item" href="{{url("/user/setting")}}"><i class="fa fa-cogs mr-2"></i>Password Change</a>
                    <a class="dropdown-item" href="{{url("/logout")}}"><i class="fa fa-sign-out mr-2"></i>Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->
    <div class="col-md-4 offset-md-3 mt-1">
        @if(session('message'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {!! session('message') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!!session('delete')!!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
        </div>