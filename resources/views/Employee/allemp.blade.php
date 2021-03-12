@extends("layouts.mainlayout")
@section("title","Employee")
@section("content")
    <style>
        a[aria-expanded=true] .fa-chevron-circle-right {
            display: none;
        }
        a[aria-expanded=false] .fa-chevron-circle-down {
            display: none;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <div class="page-wrapper">
        <!-- Page Content -->
        @if($errors)
            @foreach($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show">
                    <strong>Warning!</strong>{{$error}}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endforeach
        @endif
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

            <!-- Search Filter -->
            <form action="{{url("/employee/filter")}}" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-4 col-lg-2">
                        <div class="form-group form-focus">
                            <input type="text" name="employee_id" class="form-control floating">
                            <label class="focus-label">Employee ID</label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-2">
                        <div class="form-group form-focus">
                            <input type="text" name="employee_name" class="form-control floating">
                            <label class="focus-label">Employee Name</label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-2">
                        <div class="form-group form-focus select-focus focused">
                            <input type="date" class=" form-control" name="start_date"  />
                            <label class="focus-label">From Date</label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-2">
                        <div class="form-group form-focus select-focus focused">
                            <input type="date" class=" form-control" name="end_date"  />
                            <label class="focus-label">To Date</label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-3">
                        <div class="form-group form-focus select-focus focused">
                            <div class="form-group form-focus select-focus">
                                <select class="form-control floating" id="position" name="position">
                                    <option value="empty">Select Designation</option>
                                    @foreach($positions as $position)
                                        <option value="{{$position->id}}">{{$position->emp_position}}</option>
                                    @endforeach
                                </select>
                                <label class="focus-label">Designation</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-search mr-2"></i></button>
                    </div>
                </div>

            </form>
            <!-- Search Filter -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row staff-grid-row">
                        @foreach($employees as $emp)
                            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                <div class="profile-widget">
                                    <div class="profile-img">
                                        @if($emp->emp_profile!=null)
                                            <a href="{{url("/emp/profile/$emp->id")}}" ><img src="{{asset("/profile/$emp->emp_profile")}}" alt=""class="avatar"></a>
                                        @else

                                            <a href="{{url("/emp/profile/$emp->id")}}" ><img src="{{asset("img/profiles/avatar-01.jpg")}}" alt=""class="avatar"></a>
                                        @endif
                                    </div>
                                    <div class="dropdown profile-action">
                                        <div class="pro-edit">
                                            <button class="edit-icon"  href="#" data-toggle="modal" data-target="#delete{{$emp->id}}"><i class="fa fa-trash-o"></i></button>
                                        </div>
                                    </div>
                                    <div id="delete{{$emp->id}}" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    Are you sure delete <b>{{$emp->name}}</b>?
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <a href="#" class=" btn btn-outline-warning text-center" data-dismiss="modal" aria-label="Close">No</a>
                                                        <a href="{{url("/emp/delete/$emp->id")}}" class="btn btn-outline-danger text-center">Yes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{url("/emp/profile/$emp->id")}}">{{$emp->name}}</a></h4>
                                    @php
                                        $empuser=\App\user_employee::with("user")->where("emp_id",$emp->id)->first();
                                        $roles=\Spatie\Permission\Models\Role::all();
                                    @endphp
                                    @if($empuser!=null)
                                        @if(count($empuser->user->roles->pluck("name"))>0)
                                            @foreach($roles as $role)
                                                @if($empuser->user->hasRole($role->name))
                                                    <h5 class="text-muted">{{$role->name}}</h5>
                                                @endif
                                            @endforeach
                                        @else
                                            <h5 class="text-muted">No Role</h5>
                                        @endif
                                    @endif
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
                                <td>{{$emp->name}}</td>
                                <td>{{$emp->email}}</td>
                                <td>{{$emp->phone}}</td>
                                <td>{{$emp->join_date}}</td>
                                <td>{{$emp->position->emp_position}}</td>
                                <td>
                                    <a href="#"class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-th-list ml-2 mt-2" style="font-size: 18px;"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="{{url("/emp/profile/$emp->id")}}" class="dropdown-item"><i class="fa fa-user mr-2"></i>Profile</a>
                                        <a href="{{url("/emp/delete/$emp->id")}}" class="dropdown-item"><i class="fa fa-trash-o mr-2"></i>Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Page Content -->

        </div>
        <!-- /Page Wrapper -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
            $(document).ready(function() {
                $('#position').select2({
                        "language": {
                        },
                        escapeMarkup: function (markup) {
                            return markup;
                        }
                    }

                );

            });
            var loadFile = function(event) {
                var reader = new FileReader();
                reader.onload = function(){
                    var output = document.getElementById('output');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };
            // document.getElementById("search_join_date").innerHTML = Date();
                $('.search_join_date').daterangepicker();
        </script>

@endsection
