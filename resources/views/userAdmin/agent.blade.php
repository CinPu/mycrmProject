@extends("layouts.mainlayout")
@section("title","Agent")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Agent</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Agent</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#agentcreate"><i class="fa fa-plus"></i> Add Agent</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
        <div class="modal fade" id="agentcreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create New Agent</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="agentCreate" action="{{url("/agent/create")}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="agent_name">Agent Name:</label><br>
                                <select class="form-control" id="agent_name" name="agent_name">
                                    <option value="item0">Choose Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->user_id}}">{{$employee->user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dept_id">Department</label><br>
                                <select class="form-control " name="dept_id" id="dept_id">
                                    <option></option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success float-right mr-2">Save</button>
                            <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal">Close</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="col-md-12 mt-3" style="overflow-x: auto">
            <table class="table" id="agent">
            <thead>
            <tr>
                <th scope="col">Agent</th>
                <th scope="col">Department</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody >
            @foreach($agents as $agent)
                <tr>
                    <td> <i class="fa fa-user mr-3"></i><span class="col-6"><a href="{{url("/agent/detail/$agent->id")}}"> {{$agent->user->name}}</a></span></td>
                    <td>
                       {{$agent->dept->dept_name}}

                    </td>
                    <td>
                        <div class="dropdown ">
                            <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-th-list"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#edit{{$agent->user->id}}">
                                    <i class="fa fa-edit mr-2"></i>Edit
                                </a>
                                <a href="{{url("/delete/agent/$agent->id")}}"class="dropdown-item "><i class="fa fa-trash mr-2" ></i>Delete</a>
                                <a href="{{url("/agent/detail/$agent->id")}}" class="dropdown-item mr-2"><i class="fa fa-eye mr-2" ></i>Agent Profile</a>
                            </div>
                        </div>

                    </td>
                </tr>
                <div class="modal fade" id="edit{{$agent->user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                    <div class="modal-dialog" role="document" >
                        <div class="modal-content col-md-8 offset-md-2">
                            <div class="model-header mt-2">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3 >Change Department</h3>
                                <form id="change_dept" action="{{url("/department/change/$agent->agent_id")}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                    <select class="custom-select " name="dept_change">
                                        @foreach($depts as $alldept)
                                            <option value="{{$alldept->id}}">{{$alldept->dept_name}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            </tbody>
        </table>
            </div>
        </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#agent').DataTable({
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
            $("#agent_name").change(function () {
                var val = $(this).val();
                @foreach($employees as $emp)
                if (val =={{$emp->user_id}} ) {
                    $("#dept_id").html("<option value='{{$emp->employee->dept_id}}'>{{$emp->employee->department->dept_name}}</option>");
                }else if(val=="item0") {
                    $("#dept_id").html( "<option></option>");
                }
                @endforeach
            });
        });
    </script>
@endsection

