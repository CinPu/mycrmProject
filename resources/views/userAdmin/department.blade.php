@extends("layouts.mainlayout")
@section("title","Department")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Department</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Department</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_dept"><i class="fa fa-plus"></i> Add Department</a>
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
                                        <form action="{{url("/dept/import")}}" method="POST" enctype="multipart/form-data">
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
            <div class="modal fade" id="add_dept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{url("/dept/create")}}" method="POST">
                            {{csrf_field()}}
                                <div class="form-group">
                                <label for="dept_id" >Depatment ID:</label>
                                <select name="dept_id" id="dept_id" class="form-control mb-3">
                                    <option value="{{$dept_id}}">{{$dept_id}}</option>
                                </select>
                            </div>
                                <div class="form-group">
                                <label for="dept_name" > Depatment Name:</label><br>
                                <input type="text" id="dept_name" class="form-control mb-3"  name="dept_name">
                            </div>
                                <div class="form-group">
                                <label for="dept_head" > Depatment Head:</label><br>
                                <div class="row" data-toggle="collapse" data-target="#dept_head_info" >
                                <input type="text" class="form-control dept_head mr-3  ml-3">
                                </div>
                            </div>
                                <div class="sub-menu collapse border mt-3" id="dept_head_info">
                                <h5 align="center" class="mt-3">Head Of Department </h5>
                                    <div class="col-12 form-group row mt-3">
                                    <div class="col-md-6">
                                        <label for="">Employee ID</label>
                                        <input type="text" name="emp_id" class="form-control" value="{{$emp_id}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Department Head Name</label>
                                        <input type="text" name="dept_headName" class="dept_head form-control" required>
                                    </div>
                                </div>
                                    <div class="col-12 form-group row mt-3">
                                        <div class="col-6">
                                        <label for="">Gender</label><br>
                                        <input type="radio"name="gender" class="mr-3" value="Male"><label for="">Male</label>
                                        <input type="radio"name="gender" class="mr-2 ml-2" value="Female"><label for="">Female</label>
                                    </div>
                                        <div class="col-md-6">
                                        <label for="">NRC No.</label>
                                        <input type="text" name="nrc" class="form-control">
                                    </div>
                                    </div>
                                    <div class="col-12 form-group row mt-3">
                                    <div class="col-md-6">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control">
                                    </div>
                                </div>
                                    <div class="col-12 form-group row mt-3">

                                    <div class="col-md-6">
                                        <label for="">Phone</label>
                                        <input type="number" name="phone" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>
                                    <div class="col-12 form-group row mt-3">
                                    <div class="col-md-6">
                                    <label for="">Position</label>
                                    <select name="position" class="form-control" id="">
                                        @foreach($positions as $position)
                                            <option value="{{$position->id}}">{{$position->emp_position}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                    <div class="col-md-6">
                                        <label for="">Join Date</label>
                                        <input type="date" name="join_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                                <input type="hidden" value="{{$company->id}}" name="company">
                                <input type="hidden" name="uuid" value="{{Str::uuid()->toString()}}">
                                <button type="submit" class="btn btn-success float-right mr-2">Save</button>
                                <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive" style="overflow-x:auto;">
                <table class="table" id="dept">
                    <thead>
                        <th>Department ID</th>
                        <th>Department Name</th>
                        <th>Department Head</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($depts as $dept)
                        <tr>
                            <th>#{{$dept->dept_id}}</th>
                            <td>{{$dept->dept_name}}</td>
                            <td>
                                {{$dept->department_head->name}}
                                <div class="modal fade" id="{{$dept->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Set {{$dept->dept_name}} Head</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url("/dept/head/$dept->id")}}" method="POST">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <label for="dept_name">Choose Department Head:</label><br>
                                                    <select name="dept_head" id="" class="form-control">

                                                        @foreach($agents as $agent)
                                                            @if($agent->dept_id==$dept->id)
                                                        <option value="{{$agent->user->id}}">{{$agent->user->name}}</option>
                                                            @else
                                                                <option value="0">Doesn't have Agent</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-success float-right mr-2">Set</button>
                                                <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal">Close</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown ">
                                    <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-th-list"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{url("/dept/edit/$dept->id")}}" class="dropdown-item" data-toggle="modal" data-target="#edit{{$dept->id}}" data-whatever="@getbootstrap"><i class="fa fa-edit mr-2"></i>Edit</a>
                                        <a href="{{url("/dept/delete/$dept->id")}} "class=" dropdown-item" ><i class="fa fa-trash mr-2"></i>Delete</a>
                                        <a href="{{url("/dept/showmember/$dept->id")}}" class="dropdown-item"><i class="fa fa-users mr-2" ></i>Member</a>
                                    </div>
                                </div>
                        <div class="modal fade" id="edit{{$dept->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form  id="edit_dept" action="{{url("/dept/edit/$dept->id")}}" method="POST">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="dept_name">Depatment Name:</label><br>
                                                <input type="text" id="dept_name" class="form-control mb-3"  name="dept_name" value="{{$dept->dept_name}}">
                                            </div>
                                            <button type="submit" class="btn btn-success float-right mr-2">Save</button>
                                            <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal">Close</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".dept_head").keyup(function() {
                $(".dept_head").val($(this).val());
            });
        });
        $(document).ready(function() {
            $('#dept').DataTable();
        });
    </script>
@endsection