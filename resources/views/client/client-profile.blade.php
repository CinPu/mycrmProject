@extends('layouts.mainlayout')
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
                                <li class="breadcrumb-item"><a href="{{url("home")}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{url("client")}}">Client</a></li>
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
                                            @if($customer->profile==null)
                                                <a href=""><img src="{{url(asset("img/profiles/avatar-16.jpg"))}}" class="avatar avatar-xs" alt=""></a>
                                           @else
                                            <a href="">
                                                <img src="{{url(asset("/profile/$customer->profile"))}}" alt="">
                                            </a>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="profile-info-left">
                                                    <h3 class="user-name m-t-0">{{$customer->customer_company->name}}</h3>
                                                    <h5 class="company-role m-t-0 mb-0">{{$customer->customer_name}}</h5>
                                                    <h5 class="company-role mt-2 mb-0 text-muted">{{$customer->department}}</h5>
                                                    <small class="text-muted">{{$customer->customer_position->emp_position}}</small>
                                                    <div class="staff-id">{{$customer->customer_id}}</div>
                                                    <div class="staff-msg"><a href="chat" class="btn btn-custom">Send Message</a></div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <ul class="personal-info">
                                                    <li>
                                                        <span class="title">Phone:</span>
                                                        <span class="text"><a href="">{{$customer->phone}}</a></span>
                                                    </li>
                                                    <li>
                                                        <span class="title">Email:</span>
                                                        <span class="text"><a href="">{{$customer->email}}</a></span>
                                                    </li>
                                                    <li>
                                                        <span class="title">Address:</span>
                                                        <span class="text">{{$customer->address}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="title">Report To:</span>
                                                        <span class="text">{{$customer->report_to}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="title">Customer Creator</span>
                                                        <span class="text">
                                                                   <div class="avatar-box">
                                                            <div>
                                                                @if($customer_creator->emp_profile==null)
                                                                    <img src="{{url(asset("img/profiles/avatar-16.jpg"))}}" class="avatar avatar-xs" alt="">
                                                                @else
                                                                    <img src="{{url(asset("profile/".$customer_creator->employee->emp_profile))}}" class="avatar avatar-xs" alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                            {{$customer_creator->employee->name}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pro-edit"><a data-target="#edit_client" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card tab-box">
                    <div class="row user-tabs">
                        <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                            <ul class="nav nav-tabs nav-tabs-bottom">
                                <li class="nav-item col-sm-3"><a class="nav-link active" data-toggle="tab" href="#myprojects">Projects</a></li>
                                <li class="nav-item col-sm-3"><a class="nav-link" data-toggle="tab" href="#tasks">Tasks</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12"> 
                        <div class="tab-content profile-tab-content">
                            
                            <!-- Projects Tab -->
                            <div id="myprojects" class="tab-pane fade show active">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">

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
                                                        <li class="dropdown avatar-dropdown">
                                                            <a href="#" class="all-users dropdown-toggle" data-toggle="dropdown" aria-expanded="false">+15</a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <div class="avatar-group">
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-02.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-09.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-10.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-05.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-11.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-12.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-13.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-01.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-16.jpg">
                                                                    </a>
                                                                </div>
                                                                <div class="avatar-pagination">
                                                                    <ul class="pagination">
                                                                        <li class="page-item">
                                                                            <a class="page-link" href="#" aria-label="Previous">
                                                                                <span aria-hidden="true">«</span>
                                                                                <span class="sr-only">Previous</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                        <li class="page-item">
                                                                            <a class="page-link" href="#" aria-label="Next">
                                                                                <span aria-hidden="true">»</span>
                                                                            <span class="sr-only">Next</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li> 
                                                    </ul>
                                                </div>
                                                <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                                                <div class="progress progress-xs mb-0">
                                                    <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="40%" style="width: 40%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dropdown profile-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
                                                        <li class="dropdown avatar-dropdown">
                                                            <a href="#" class="all-users dropdown-toggle" data-toggle="dropdown" aria-expanded="false">+15</a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <div class="avatar-group">
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-02.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-09.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-10.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-05.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-11.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-12.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-01.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-16.jpg">
                                                                    </a>
                                                                </div>
                                                                <div class="avatar-pagination">
                                                                    <ul class="pagination">
                                                                        <li class="page-item">
                                                                            <a class="page-link" href="#" aria-label="Previous">
                                                                                <span aria-hidden="true">«</span>
                                                                                <span class="sr-only">Previous</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                        <li class="page-item">
                                                                            <a class="page-link" href="#" aria-label="Next">
                                                                                <span aria-hidden="true">»</span>
                                                                            <span class="sr-only">Next</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                                                <div class="progress progress-xs mb-0">
                                                    <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="40%" style="width: 40%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dropdown profile-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
                                                        <li class="dropdown avatar-dropdown">
                                                            <a href="#" class="all-users dropdown-toggle" data-toggle="dropdown" aria-expanded="false">+15</a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <div class="avatar-group">
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-02.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-09.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-10.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-05.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-11.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-12.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-13.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-01.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-16.jpg">
                                                                    </a>
                                                                </div>
                                                                <div class="avatar-pagination">
                                                                    <ul class="pagination">
                                                                        <li class="page-item">
                                                                            <a class="page-link" href="#" aria-label="Previous">
                                                                                <span aria-hidden="true">«</span>
                                                                                <span class="sr-only">Previous</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                        <li class="page-item">
                                                                            <a class="page-link" href="#" aria-label="Next">
                                                                                <span aria-hidden="true">»</span>
                                                                            <span class="sr-only">Next</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                                                <div class="progress progress-xs mb-0">
                                                    <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="40%" style="width: 40%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="dropdown profile-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
                                                        <li class="dropdown avatar-dropdown">
                                                            <a href="#" class="all-users dropdown-toggle" data-toggle="dropdown" aria-expanded="false">+15</a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <div class="avatar-group">
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-02.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-09.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-10.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-05.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-11.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-12.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-13.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-01.jpg">
                                                                    </a>
                                                                    <a class="avatar avatar-xs" href="#">
                                                                        <img alt="" src="img/profiles/avatar-16.jpg">
                                                                    </a>
                                                                </div>
                                                                <div class="avatar-pagination">
                                                                    <ul class="pagination">
                                                                        <li class="page-item">
                                                                            <a class="page-link" href="#" aria-label="Previous">
                                                                                <span aria-hidden="true">«</span>
                                                                                <span class="sr-only">Previous</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                        <li class="page-item">
                                                                            <a class="page-link" href="#" aria-label="Next">
                                                                                <span aria-hidden="true">»</span>
                                                                            <span class="sr-only">Next</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                                                <div class="progress progress-xs mb-0">
                                                    <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="40%" style="width: 40%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Projects Tab -->
                            
                            <!-- Task Tab -->
                            <div id="tasks" class="tab-pane fade">
                                <div class="project-task">
                                    <ul class="nav nav-tabs nav-tabs-top nav-justified mb-0">
                                        <li class="nav-item"><a class="nav-link active" href="#all_tasks" data-toggle="tab" aria-expanded="true">All Tasks</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#pending_tasks" data-toggle="tab" aria-expanded="false">Pending Tasks</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#completed_tasks" data-toggle="tab" aria-expanded="false">Completed Tasks</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="all_tasks">
                                            <div class="task-wrapper">
                                                <div class="task-list-container">
                                                    <div class="task-list-body">
                                                        <ul id="task-list">
                                                            <li class="task">
                                                                <div class="task-container">
                                                                    <span class="task-action-btn task-check">
                                                                        <span class="action-circle large complete-btn" title="Mark Complete">
                                                                            <i class="material-icons">check</i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="task-label" contenteditable="true">Patient appointment booking</span>
                                                                    <span class="task-action-btn task-btn-right">
                                                                        <span class="action-circle large" title="Assign">
                                                                            <i class="material-icons">person_add</i>
                                                                        </span>
                                                                        <span class="action-circle large delete-btn" title="Delete Task">
                                                                            <i class="material-icons">delete</i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </li>
                                                            <li class="task">
                                                                <div class="task-container">
                                                                    <span class="task-action-btn task-check">
                                                                        <span class="action-circle large complete-btn" title="Mark Complete">
                                                                            <i class="material-icons">check</i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="task-label" contenteditable="true">Appointment booking with payment gateway</span>
                                                                    <span class="task-action-btn task-btn-right">
                                                                        <span class="action-circle large" title="Assign">
                                                                            <i class="material-icons">person_add</i>
                                                                        </span>
                                                                        <span class="action-circle large delete-btn" title="Delete Task">
                                                                            <i class="material-icons">delete</i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </li>
                                                            <li class="completed task">
                                                                <div class="task-container">
                                                                    <span class="task-action-btn task-check">
                                                                        <span class="action-circle large complete-btn" title="Mark Complete">
                                                                            <i class="material-icons">check</i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="task-label">Doctor available module</span>
                                                                    <span class="task-action-btn task-btn-right">
                                                                        <span class="action-circle large" title="Assign">
                                                                            <i class="material-icons">person_add</i>
                                                                        </span>
                                                                        <span class="action-circle large delete-btn" title="Delete Task">
                                                                            <i class="material-icons">delete</i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </li>
                                                            <li class="task">
                                                                <div class="task-container">
                                                                    <span class="task-action-btn task-check">
                                                                        <span class="action-circle large complete-btn" title="Mark Complete">
                                                                            <i class="material-icons">check</i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="task-label" contenteditable="true">Patient and Doctor video conferencing</span>
                                                                    <span class="task-action-btn task-btn-right">
                                                                        <span class="action-circle large" title="Assign">
                                                                            <i class="material-icons">person_add</i>
                                                                        </span>
                                                                        <span class="action-circle large delete-btn" title="Delete Task">
                                                                            <i class="material-icons">delete</i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </li>
                                                            <li class="task">
                                                                <div class="task-container">
                                                                    <span class="task-action-btn task-check">
                                                                        <span class="action-circle large complete-btn" title="Mark Complete">
                                                                            <i class="material-icons">check</i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="task-label" contenteditable="true">Private chat module</span>
                                                                    <span class="task-action-btn task-btn-right">
                                                                        <span class="action-circle large" title="Assign">
                                                                            <i class="material-icons">person_add</i>
                                                                        </span>
                                                                        <span class="action-circle large delete-btn" title="Delete Task">
                                                                            <i class="material-icons">delete</i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </li>
                                                            <li class="task">
                                                                <div class="task-container">
                                                                    <span class="task-action-btn task-check">
                                                                        <span class="action-circle large complete-btn" title="Mark Complete">
                                                                            <i class="material-icons">check</i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="task-label" contenteditable="true">Patient Profile add</span>
                                                                    <span class="task-action-btn task-btn-right">
                                                                        <span class="action-circle large" title="Assign">
                                                                            <i class="material-icons">person_add</i>
                                                                        </span>
                                                                        <span class="action-circle large delete-btn" title="Delete Task">
                                                                            <i class="material-icons">delete</i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="task-list-footer">
                                                        <div class="new-task-wrapper">
                                                            <textarea  id="new-task" placeholder="Enter new task here. . ."></textarea>
                                                            <span class="error-message hidden">You need to enter a task first</span>
                                                            <span class="add-new-task-btn btn" id="add-task">Add Task</span>
                                                            <span class="btn" id="close-task-panel">Close</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pending_tasks"></div>
                                        <div class="tab-pane" id="completed_tasks"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Task Tab -->
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
        <!-- Edit Client Modal -->
        <div id="edit_client" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Client</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url("client/customer/update/$customer->id")}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div>
                                <div class="text-center" >
                                    <h3>Profile Picture</h3>
                                    @if($customer->profile==null)
                                        <a href=""> <img id="output" class="rounded-circle mt-2 mb-4" src="{{url(asset("/img/profiles/avatar-01.jpg"))}}" width="100px" height="100px;"><br></a>
                                    @else
                                        <a href="">
                                            <img id="output" class="rounded-circle mt-2 mb-4" src="{{url(asset("/profile/$customer->profile"))}}" width="100px" height="100px;"><br>
                                        </a>
                                    @endif

                                    <input type="file" accept="image/*" name="profile"  class="offset-md-1" onchange="loadFile(event)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Customer ID <span class="text-danger">*</span></label>
                                        <input class="form-control" name="customer_id" type="text" value="{{$customer->customer_id}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Customer Name</label>
                                        <input class="form-control" name="name" type="text" value="{{$customer->customer_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone <span class="text-danger">*</span></label>
                                        <input class="form-control" name="phone" type="number" value="{{$customer->phone}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control floating" name="email" type="email" value="{{$customer->email}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group input-group">
                                        <label class="col-form-label">Company</label>
                                        <select name="company_id" data-show-content="true" class="select" id="company">
                                            <option selected disabled>Choose Company</option>
                                            @foreach($companies as $company)
                                                @if($company->id==$customer->company_id)
                                                <option value="{{$company->id}}" selected>{{$company->name}}</option>
                                                @else
                                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Position</label>
                                        <select name="position" class="select" id="">
                                            @foreach($position as $post)
                                                @if($post->id==$customer->customer_position->id)
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
                                        <label class="col-form-label">Department<span class="text-danger">*</span></label>
                                        <input class="form-control floating" name="department" type="text" value="{{$customer->department}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Report To </label>
                                        <input type="text" class="form-control" name="report_to" value="{{$customer->report_to}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Address</label>
                                        <input class="form-control" name="address" type="text" value="{{$customer->address}}">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Client Modal -->
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
@endsection