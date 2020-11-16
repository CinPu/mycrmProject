@extends("layouts.mainlayout")
@section("content")
    <div class="page-wrapper">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header mt-3">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{url("employee")}}">Employee</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="card">
            <div class="col-md-12 col-12">
                <div class="row mt-5">
                    <div class="col-md-3 mr-4 ml-4">
                        @php
                            $pp=App\userprofile::where("user_id",$emp_details->emp_id)->first();
                        @endphp
                        @if($pp!=null)
                            <a href="{{url("/emp/profile/$emp_details->emp_id")}}" ><img src="{{asset("/profile/$pp->profile")}}" alt=""></a>
                        @else
                            <a href="{{url("/emp/profile/$emp_details->emp_id")}}"><img src="{{url(asset("img/profiles/avatar-02.jpg"))}}" alt="" width="200px;" height="200px;"></a>
                        @endif
                    </div>
                    <div class="ml-4"></div>
                    <div class="col-md-6 offset-md-2">
                        <div class="jumbotron">
                            <div class="row mb-2">
                                <div class="col-md-4 col-6 offset-0 offset-md-2">
                                    Company
                                </div>
                                <div class="col-md-6 col-6">
                                    : {{$emp_details->company->company_name}}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 col-6 offset-0 offset-md-2">
                                    Employee ID
                                </div>
                                <div class="col-md-6 col-6">
                                    : {{$emp_details->employee_id}}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 col-6 offset-0 offset-md-2">
                                    Employee Name
                                </div>
                                <div class="col-md-6 col-6">
                                    : {{$emp_details->employee_user->name}}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 col-6 offset-0 offset-md-2">
                                    Department
                                </div>
                                <div class="col-md-6 col-6">
                                    : {{$emp_details->dept->dept_name}}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 col-6 offset-0 offset-md-2">
                                    Employee Position
                                </div>
                                <div class="col-md-6 col-6">
                                    : {{$emp_details->position->emp_position}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="jumbotron">
                <div class="row mb-2 mt-3">
                    <div class="col-md-6 col-12">
                        <div class="row">
                        <div class="col-md-4 col-6 offset-0 offset-md-2">Date Of Birth</div>
                        <div class="col-md-6 col-6">
                            @if($emp_details->dob!=null)
                            :{{$emp_details->dob}}
                            @else
                                : Does Not Exist Now! <a href="" ><i class="fa fa-edit"></i></a>
                            @endif
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="row">
                            <div class="col-md-4 col-6 offset-0 offset-md-2">Join Of Date</div>
                            <div class="col-md-6 col-6">: {{$emp_details->join_date}}</div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6 col-12">
                        <div class="row">
                            <div class="col-md-4 col-6 offset-0 offset-md-2">Email</div>
                            <div class="col-md-6 col-6">: {{$emp_details->employee_user->email}}</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="row">
                            <div class="col-md-4 col-6 offset-0 offset-md-2">Report To</div>
                            <div class="col-md-6 col-6">: {{$emp_details->report_to_user->name}}</div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-12">
                        <div class="row">
                            <div class="col-md-4 col-6 offset-0 offset-md-2">Address</div>
                            <div class="col-md-6 col-6">
                                @if($emp_details->address!=null)
                                :{{$emp_details->address}}
                                @else
                                : Does Not Exist Now! <a href="" ><i class="fa fa-edit"></i></a>
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="row">
                            <div class="col-md-4 col-6 offset-0 offset-md-2">Contact Phone</div>
                            <div class="col-md-6 col-6">: {{$emp_details->phone}}</div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection