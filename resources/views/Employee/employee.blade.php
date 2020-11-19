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
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
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
                                        <form action="{{url("/employee/import")}}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="file" name="file" >
                                            <br>
                                            <button class="btn btn-outline-success float-right"><i class="fa fa-upload mr-2"></i>Import Ticket</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus focused">
                        <select class="select floating select2-hidden-accessible form-control" name="employee_id" data-select2-id="3" tabindex="-1" aria-hidden="true">
                            <option data-select2-id="3">Select Employee ID</option>
                            @foreach($employees as $emp)
                                <option value="{{$emp->employee_id}}">{{$emp->employee_id}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus focused">
                        <select class="select floating select2-hidden-accessible form-control" name="employee_name" data-select2-id="2" tabindex="-1" aria-hidden="true">
                            <option data-select2-id="2">Select Designation</option>
                            @foreach($employees as $emp)
                                <option value="{{$emp->emp_id}}">{{$emp->employee_user->name}}</option>
                            @endforeach
                        </select>
                        {{--               --}}
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus focused">
                        <select class="select floating select2-hidden-accessible form-control" name="position" data-select2-id="1" tabindex="-1" aria-hidden="true">
                            <option data-select2-id="3">Select Designation</option>
                            @foreach($positions as $position)
                                <option value="{{$position->id}}">{{$position->emp_position}}</option>
                            @endforeach
                        </select>
                        {{--               --}}
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="submit" class="btn btn-success btn-block"><i class="fa fa-search mr-2"></i> Search </button>
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

        <!-- Add Employee Modal -->
        <div id="add_employee" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url("/employee/create")}}" method="POST">
                            {{csrf_field()}}
                                <div class="form-group row mt-3">
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="col-md-6">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="col-md-6">
                                        <label for="">Employee ID</label>
                                        <input type="text" name="emp_id" class="form-control" value="{{$emp_id}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Phone</label>
                                        <input type="number" name="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="col-md-6">
                                        <label for="">Company</label>
                                        <select name="company" id="company" class="form-control">
                                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Join Date</label>
                                        <input type="date" name="join_date" class="form-control">
                                    </div>

                                </div>
                                <div class="form-group row mt-3">
                                    <div class="col-md-6">
                                        <label for="type">Department</label>
                                        <select class="form-control" id="type" name="department">
                                            <option value="item0">Choose Department</option>
                                            @foreach($depts as $dept)
                                                <option value="{{$dept->id}}">{{$dept->dept_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Position</label>
                                        <select name="position" class="form-control" id="">
                                            @foreach($positions as $position)
                                                <option value="{{$position->id}}">{{$position->emp_position}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="col-md-6">
                                        <label for="">Report To</label>
                                        <select name="report_to" class="form-control" id="">
                                            <option value="{{\Illuminate\Support\Facades\Auth::user()->id}}">{{\Illuminate\Support\Facades\Auth::user()->name}} (Admin)</option>
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->employee_user->id}}">{{$employee->employee_user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="size">Department Head</label>
                                        <select class="form-control " name="dept_head" id="size">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <input type="hidden" name="uuid" value="{{Str::uuid()->toString()}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Employee Modal -->
        <!-- Delete Employee Modal -->
        <div class="modal custom-modal fade" id="delete_employee" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Employee</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Employee Modal -->

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
        $(document).ready(function () {
            $("#type").change(function () {
                var val = $(this).val();
                @foreach($depts as $dept)
                if (val =={{$dept->id}} ) {
                    $("#size").html("<option value='{{$dept->dept_head}}'>{{$dept->department_head->name}}</option>");
                }else if(val=="item0") {
                    $("#size").html( "<option></option>");
                }
                @endforeach
            });
        });
    </script>

@endsection