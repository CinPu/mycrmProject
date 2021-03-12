@extends("layouts.mainlayout")
@section("title","Admin Dashboard")
@section("content")
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome {{\Illuminate\Support\Facades\Auth::user()->name}}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <a href="{{url("employee/tag/tickets")}}">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-ticket"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{count($followingTickets)}}</h3>
                                <span>Ticket</span>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <a href="{{url("client")}}">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{$allclients}}</h3>
                                    <span>Clients</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <a href="{{url("engaged/company")}}">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{count($customer_company)}}</h3>
                                <span>Company</span>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <a href="{{url("employee")}}">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                                <div class="dash-widget-info">
                                    <h3>{{count($allemp)}}</h3>
                                    <span>Employees</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <a href="{{url("deal")}}">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-handshake-o"></i></span>
                            <div class="dash-widget-info">
                                <h3>112</h3>
                                <span>Deal</span>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <a href="{{url("leads")}}">
                        <div class="card dash-widget">
                            <div class="card-body">
                                <span class="dash-widget-icon"><i class="la la-user-secret"></i></span>
                                <div class="dash-widget-info">
                                    {{--                                    <h3>{{$allclients}}</h3>--}}
                                    <span>Lead</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- /Page Header -->
        </div>
    </div>
@endsection
