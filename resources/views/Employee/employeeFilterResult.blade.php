@extends("layouts.mainlayout")
@section("title","Employee")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                         <div class="view-icons">
                            <ul class="nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="grid-view btn btn-link nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-th"></i></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a  id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" class="list-view btn btn-link nav-link"><i class="fa fa-bars"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row staff-grid-row">
                        @foreach($employees as $emp)
                            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                <div class="profile-widget">
                                    <div class="profile-img">
                                        @php
                                            $pp=App\userprofile::where("user_id",$emp->emp_id)->first();
                                        @endphp
                                        @if($pp!=null)
                                            <a href="{{url("/emp/profile/$emp->emp_id")}}" ><img src="{{asset("/profile/$pp->profile")}}" alt=""class="avatar"></a>
                                        @else
                                            <a href="{{url("/emp/profile/$emp->emp_id")}}" class="avatar"><img src="img/profiles/avatar-02.jpg" alt=""></a>
                                        @endif

                                    </div>
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{url("emp/edit/$emp->emp_id")}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="{{url("/emp/delete/$emp->emp_id")}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{url("/emp/profile/$emp->emp_id")}}">{{$emp->employee_user->name}}</a></h4>
                                    <div class="small text-muted">{{$emp->position->emp_position}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="overflow-x: auto">
                    <table class="table" id="emp">
                        <thead>
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Join Date</th>
                            <th scope="col">Position</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $emp)
                            <tr>
                                <th>#{{$emp->employee_id}}</th>
                                <td>{{$emp->employee_user->name}}</td>
                                <td>{{$emp->employee_user->email}}</td>
                                <td>{{$emp->phone}}</td>
                                <td>{{$emp->join_date}}</td>
                                <td>{{$emp->position->emp_position}}</td>
                                <td>
                                    <a href="#"class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-th-list ml-2 mt-2" style="font-size: 18px;"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="{{url("/emp/profile/$emp->emp_id")}}" class="dropdown-item"><i class="fa fa-user mr-2"></i>Profile</a>
                                        <a href="{{url("/emp/edit/$emp->emp_id")}}" class="dropdown-item"><i class="fa fa-edit mr-2"></i>Edit</a>
                                        <a href="{{url("/emp/delete/$emp->emp_id")}}" class="dropdown-item"><i class="fa fa-trash-o mr-2"></i>Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->
        <script>
            $(document).ready(function (){
                $("#emp").DataTable({
                    dom: 'Bfrtip',
                    buttons: [

                        {
                            extend: 'collection',
                            text: '<i class="fa fa-download mr-2"></i>Export',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        }
                    ],
                });
            });
        </script>

@endsection