@extends("layouts.mainlayout")
@section("title","Department All Member")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{$dept->dept_name}} Member</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{url("department")}}">Department</a></li>
                            <li class="breadcrumb-item active">Member</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <button type="button" class="btn btn-outline-secondary mr-2" data-toggle="modal" data-target="#importEmployee">
                            <i class="fa fa-upload mr-2"></i>Import
                        </button>
                        <div class="modal fade" id="importEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Employee</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url("/ticket/import")}}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="file" name="file" >
                                            <br>
                                            <button class="btn btn-outline-success float-right"><i class="fa fa-upload mr-2"></i>Import Ticket</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row staff-grid-row">
                @foreach($members as $member)
                    <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                        <div class="profile-widget">
                            <div class="profile-img">
                                @php
                                    $pp=App\userprofile::where("user_id",$member->emp_id)->first();
                                @endphp
                                @if($pp!=null)
                                            <a href="{{url("/emp/profile/$member->emp_id")}}" ><img src="{{asset("/profile/$pp->profile")}}" alt=""class="avatar"></a>
                                        @else
                                    <a href="{{url("/emp/profile/$member->emp_id")}}" class="avatar"><img src="{{url(asset("img/profiles/avatar-02.jpg"))}}" alt=""></a>
                                @endif
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{url("/emp/profile/$member->emp_id")}}">{{$member->employee_user->name}}</a></h4>
                            <div class="small text-muted">{{$member->position->emp_position}}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection