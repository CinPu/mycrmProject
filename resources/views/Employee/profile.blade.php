@extends('layouts.mainlayout')
@section("title","Employee Profile")
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
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

            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        @if($emp_details->emp_profile!=null)
                                            <a href="#"><img alt="" src="{{url(asset("profile/$emp_details->emp_profile"))}}"></a>
                                        @else
                                            <a href="#" ><img src="{{asset("img/profiles/avatar-01.jpg")}}" alt=""class="avatar"></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{$emp_details->name}}</h3>
                                                <small class="text-muted">{{$emp_details->position->emp_position}}</small>
                                                <div class="staff-id">Employee ID : {{$emp_details->employee_id}}</div>
                                                <div class="small doj text-muted">Date of Join : {{$emp_details->join_date}}</div>
                                                <div class="staff-msg"><a class="btn btn-custom" href="{{url("chat")}}">Send Message</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Phone:</div>
                                                    <div class="text"><a href="">{{$emp_details->phone}}</a></div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text"><a href="">{{$emp_details->email}}</a></div>
                                                </li>
                                                <li>
                                                    <div class="title">Department:</div>
                                                    <div class="text">
                                                        {{$emp_details->dept->dept_name}}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Address:</div>
                                                    <div class="text">
                                                        @if($emp_details->address==null)
                                                            No address has been added yet !
                                                        @else
                                                        {{$emp_details->address}}
                                                    @endif</div>
                                                </li>
                                                <li>
                                                    <div class="title">Reports to:</div>
                                                    <div class="text">
                                                        <div class="avatar-box">
                                                            <div>
                                                                @if($pp==null)
                                                                <img src="{{url(asset("img/profiles/avatar-16.jpg"))}}" class="avatar avatar-xs" alt="">
                                                                @else
                                                                    <img src="{{url(asset("profile/$pp"))}}" class="avatar avatar-xs" alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if($emp_details->report_to_user->hasAnyRole("Admin"))
                                                            {{$emp_details->report_to_user->name}}
                                                        @else
                                                            @php
                                                            $emp_user=\App\user_employee::where("user_id",$emp_details->report_to_user->id)->first();
                                                            @endphp
                                                        <a href="{{url("/emp/profile/$emp_user->emp_id")}}">
                                                            {{$emp_details->report_to_user->name}}
                                                        </a>
                                                            @endif
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
                            <li class="nav-item"><a href="#emp_projects" data-toggle="tab" class="nav-link">Projects</a></li>
                            <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Bank & Statutory <small class="text-danger">(Admin Only)</small></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content">

                <!-- Profile Info Tab -->
                <div id="emp_profile" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Personal Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a></h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">NRC No.</div>
                                            <div class="text">{{$emp_details->nrc}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Gender</div>
                                            <div class="text">{{$emp_details->gender}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Birth Date</div>
                                            <div class="text">{{$emp_details->dob}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Nationality</div>
                                            <div class="text">{{$emp_details->nationality}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Religion</div>
                                            <div class="text">{{$emp_details->religion}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Marital status</div>
                                            <div class="text">{{$emp_details->marital_status}}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Profile Info Tab -->

                <!-- Projects Tab -->
                <div class="tab-pane fade" id="emp_projects">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown profile-action">
                                        <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="project-title"><a href="project-view">Office Management</a></h4>
                                    <small class="block text-ellipsis m-b-15">
                                        <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                                        <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                                    </small>
                                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. When an unknown printer took a galley of type and
                                        scrambled it...
                                    </p>
                                    <div class="pro-deadline m-b-15">
                                        <div class="sub-title">
                                            Deadline:
                                        </div>
                                        <div class="text-muted">
                                            17 Apr 2019
                                        </div>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Project Leader :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="img/profiles/avatar-16.jpg"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Team :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="img/profiles/avatar-02.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="img/profiles/avatar-09.jpg"></a></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="img/profiles/avatar-10.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="img/profiles/avatar-05.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" class="all-users">+15</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                                    <div class="progress progress-xs mb-0">
                                        <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown profile-action">
                                        <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="project-title"><a href="project-view">Project Management</a></h4>
                                    <small class="block text-ellipsis m-b-15">
                                        <span class="text-xs">2</span> <span class="text-muted">open tasks, </span>
                                        <span class="text-xs">5</span> <span class="text-muted">tasks completed</span>
                                    </small>
                                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. When an unknown printer took a galley of type and
                                        scrambled it...
                                    </p>
                                    <div class="pro-deadline m-b-15">
                                        <div class="sub-title">
                                            Deadline:
                                        </div>
                                        <div class="text-muted">
                                            17 Apr 2019
                                        </div>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Project Leader :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="img/profiles/avatar-16.jpg"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Team :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="img/profiles/avatar-02.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="img/profiles/avatar-09.jpg"></a></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="img/profiles/avatar-10.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="img/profiles/avatar-05.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" class="all-users">+15</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                                    <div class="progress progress-xs mb-0">
                                        <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown profile-action">
                                        <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="project-title"><a href="project-view">Video Calling App</a></h4>
                                    <small class="block text-ellipsis m-b-15">
                                        <span class="text-xs">3</span> <span class="text-muted">open tasks, </span>
                                        <span class="text-xs">3</span> <span class="text-muted">tasks completed</span>
                                    </small>
                                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. When an unknown printer took a galley of type and
                                        scrambled it...
                                    </p>
                                    <div class="pro-deadline m-b-15">
                                        <div class="sub-title">
                                            Deadline:
                                        </div>
                                        <div class="text-muted">
                                            17 Apr 2019
                                        </div>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Project Leader :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="img/profiles/avatar-16.jpg"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Team :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="img/profiles/avatar-02.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="img/profiles/avatar-09.jpg"></a></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="img/profiles/avatar-10.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="img/profiles/avatar-05.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" class="all-users">+15</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                                    <div class="progress progress-xs mb-0">
                                        <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown profile-action">
                                        <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="project-title"><a href="project-view">Hospital Administration</a></h4>
                                    <small class="block text-ellipsis m-b-15">
                                        <span class="text-xs">12</span> <span class="text-muted">open tasks, </span>
                                        <span class="text-xs">4</span> <span class="text-muted">tasks completed</span>
                                    </small>
                                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. When an unknown printer took a galley of type and
                                        scrambled it...
                                    </p>
                                    <div class="pro-deadline m-b-15">
                                        <div class="sub-title">
                                            Deadline:
                                        </div>
                                        <div class="text-muted">
                                            17 Apr 2019
                                        </div>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Project Leader :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="img/profiles/avatar-16.jpg"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="project-members m-b-15">
                                        <div>Team :</div>
                                        <ul class="team-members">
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="img/profiles/avatar-02.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="img/profiles/avatar-09.jpg"></a></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="img/profiles/avatar-10.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="img/profiles/avatar-05.jpg"></a>
                                            </li>
                                            <li>
                                                <a href="#" class="all-users">+15</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                                    <div class="progress progress-xs mb-0">
                                        <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Projects Tab -->

                <!-- Bank Statutory Tab -->
                <div class="tab-pane fade" id="bank_statutory">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"> Basic Salary Information</h3>
                            <form>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Salary basis <span class="text-danger">*</span></label>
                                            <select class="select">
                                                <option>Select salary basis type</option>
                                                <option>Hourly</option>
                                                <option>Daily</option>
                                                <option>Weekly</option>
                                                <option>Monthly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Salary amount <small class="text-muted">per month</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Type your salary amount" value="0.00">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Payment type</label>
                                            <select class="select">
                                                <option>Select payment type</option>
                                                <option>Bank transfer</option>
                                                <option>Check</option>
                                                <option>Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h3 class="card-title"> PF Information</h3>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">PF contribution</label>
                                            <select class="select">
                                                <option>Select PF contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">PF No. <span class="text-danger">*</span></label>
                                            <select class="select">
                                                <option>Select PF contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee PF rate</label>
                                            <select class="select">
                                                <option>Select PF contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                                            <select class="select">
                                                <option>Select additional rate</option>
                                                <option>0%</option>
                                                <option>1%</option>
                                                <option>2%</option>
                                                <option>3%</option>
                                                <option>4%</option>
                                                <option>5%</option>
                                                <option>6%</option>
                                                <option>7%</option>
                                                <option>8%</option>
                                                <option>9%</option>
                                                <option>10%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Total rate</label>
                                            <input type="text" class="form-control" placeholder="N/A" value="11%">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee PF rate</label>
                                            <select class="select">
                                                <option>Select PF contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                                            <select class="select">
                                                <option>Select additional rate</option>
                                                <option>0%</option>
                                                <option>1%</option>
                                                <option>2%</option>
                                                <option>3%</option>
                                                <option>4%</option>
                                                <option>5%</option>
                                                <option>6%</option>
                                                <option>7%</option>
                                                <option>8%</option>
                                                <option>9%</option>
                                                <option>10%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Total rate</label>
                                            <input type="text" class="form-control" placeholder="N/A" value="11%">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h3 class="card-title"> ESI Information</h3>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">ESI contribution</label>
                                            <select class="select">
                                                <option>Select ESI contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">ESI No. <span class="text-danger">*</span></label>
                                            <select class="select">
                                                <option>Select ESI contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Employee ESI rate</label>
                                            <select class="select">
                                                <option>Select ESI contribution</option>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                                            <select class="select">
                                                <option>Select additional rate</option>
                                                <option>0%</option>
                                                <option>1%</option>
                                                <option>2%</option>
                                                <option>3%</option>
                                                <option>4%</option>
                                                <option>5%</option>
                                                <option>6%</option>
                                                <option>7%</option>
                                                <option>8%</option>
                                                <option>9%</option>
                                                <option>10%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Total rate</label>
                                            <input type="text" class="form-control" placeholder="N/A" value="11%">
                                        </div>
                                    </div>
                                </div>

                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bank Statutory Tab -->

            </div>
        </div>
        <!-- /Page Content -->

        <!-- Profile Modal -->
        <div id="profile_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Profile Information Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url("employee/update/profile/$emp_details->id")}}" method="POST" enctype="multipart/form-data">
                           {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 align="center">Profile Picture</h4>
                                        <div>
                                            <div class="text-center" >
                                                <img id="output" class="rounded-circle" src="{{url(asset("/img/profiles/avatar-01.jpg"))}}" width="100px" height="100px;"><br><br>
                                                <input type="file" accept="image/*" name="profile"  class="offset-md-1" onchange="loadFile(event)">
                                            </div>
                                        </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Employee ID</label>
                                                <input type="text" class="form-control" name="emp_id" value="{{$emp_details->employee_id}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" id="name" name="name" class="form-control" value="{{$emp_details->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email" class="form-control" value="{{$emp_details->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" name="phone" class="form-control" value="{{$emp_details->phone}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Join Date</label>
                                                    <input class="form-control" name="join_date" id="join_date" type="date">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Department <span class="text-danger">*</span></label>
                                                <select class="select" name="dept">
                                                    @foreach($depts as $dept)
                                                        @if($dept->id==$emp_details->dept->id)
                                                            <option value="{{$dept->id}}" selected>{{$dept->dept_name}}</option>
                                                        @else
                                                            <option value="{{$dept->id}}">{{$dept->dept_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Designation <span class="text-danger">*</span></label>
                                                <select class="select" name="position">
                                                @foreach($positions as $post)
                                                    @if($post->id==$emp_details->emp_post)
                                                        <option value="{{$post->id}}" selected>{{$post->emp_position}}</option>
                                                        @else
                                                        <option value="{{$post->id}}">{{$post->emp_position}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Reports To <span class="text-danger">*</span></label>
                                                <select class="select" name="report_to">
                                                    <option value="{{\Illuminate\Support\Facades\Auth::user()->id}}">{{\Illuminate\Support\Facades\Auth::user()->name}}</option>
                                                    @foreach($report_to as $report)
                                                        @if($report->report_to==$emp_details->report_to)
                                                    <option value="{{$report->user->id}}" selected>{{$report->user->name}}</option>
                                                        @else
                                                            <option value="{{$report->user->id}}">{{$report->user->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" value="{{$emp_details->address}}">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Profile Modal -->

        <!-- Personal Info Modal -->
        <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Personal Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url("employee/update/personal/$emp_details->id")}}" method="POST">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NRC No</label>
                                        <input type="text" name="nrc" class="form-control" value="{{$emp_details->nrc}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nationality <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="nationality" value="{{$emp_details->nationality}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control" name="gender" id="gendet">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <input class="form-control" name="dob" id="dob" type="date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Religion</label>
                                        <input class="form-control" type="text" name="religion">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Marital status <span class="text-danger">*</span></label>
                                        <select class="select form-control" name="marital_status">
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Separated">Separated</option>
                                            <option value="Divorced">Divorced</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Personal Info Modal -->

        <!-- Family Info Modal -->
        <div id="family_info_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Family Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Family Member <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of birth <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of birth <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Family Info Modal -->

        <!-- Emergency Contact Modal -->
        <div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Personal Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Primary Contact</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Relationship <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone 2</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Primary Contact</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Relationship <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone 2</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Emergency Contact Modal -->

        <!-- Education Modal -->
        <div id="education_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Education Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Oxford University" class="form-control floating">
                                                    <label class="focus-label">Institution</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Computer Science" class="form-control floating">
                                                    <label class="focus-label">Subject</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="01/06/2002" class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Starting Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="31/05/2006" class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Complete Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="BE Computer Science" class="form-control floating">
                                                    <label class="focus-label">Degree</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Grade A" class="form-control floating">
                                                    <label class="focus-label">Grade</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Oxford University" class="form-control floating">
                                                    <label class="focus-label">Institution</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Computer Science" class="form-control floating">
                                                    <label class="focus-label">Subject</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="01/06/2002" class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Starting Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="31/05/2006" class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Complete Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="BE Computer Science" class="form-control floating">
                                                    <label class="focus-label">Degree</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Grade A" class="form-control floating">
                                                    <label class="focus-label">Grade</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Education Modal -->

        <!-- Experience Modal -->
        <div id="experience_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Experience Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="Digital Devlopment Inc">
                                                    <label class="focus-label">Company Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="United States">
                                                    <label class="focus-label">Location</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="Web Developer">
                                                    <label class="focus-label">Job Position</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" value="01/07/2007">
                                                    </div>
                                                    <label class="focus-label">Period From</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" value="08/06/2018">
                                                    </div>
                                                    <label class="focus-label">Period To</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="Digital Devlopment Inc">
                                                    <label class="focus-label">Company Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="United States">
                                                    <label class="focus-label">Location</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="Web Developer">
                                                    <label class="focus-label">Job Position</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" value="01/07/2007">
                                                    </div>
                                                    <label class="focus-label">Period From</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" value="08/06/2018">
                                                    </div>
                                                    <label class="focus-label">Period To</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Experience Modal -->

    </div>
    <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
    <!-- /Page Wrapper -->
@endsection