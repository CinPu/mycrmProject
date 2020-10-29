@extends("layouts.app")
@section("title","Agent")
@section("content")
        <a href="{{url("/agent/create")}}" class="btn btn-success" data-toggle="modal" data-target="#agentcreate" data-whatever="@getbootstrap"><i class="fa fa-plus mr-4"></i>Agent create</a>
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
                                    <option value="item0">Choose Department</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->employee_user->id}}">{{$employee->employee_user->name}}</option>
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
            <h3 class="ml-3"><i class="fa fa-user mr-2"></i>Agent</h3>
            <div class="col-md-12">
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
                    <td> <i class="fa fa-user mr-3"></i><span class="col-6"> {{$agent->user->name}}</span></td>
                    <td>
                        <a href="{{url("/department")}}">{{$agent->dept->dept_name}}</a>
                        <a href="#" data-toggle="modal" data-target="#{{$agent->user->id}}">
                           <i class="fa fa-edit ml-3">Change</i>
                        </a>
                    </td>
                    <td>
                        <a href="{{url("/delete/agent/$agent->id")}}"class="mr-2"><i class="fa fa-trash" style="font-size: 18px;"></i></a>
                        <a href="{{url("/agent/detail/$agent->id")}}" class="mr-2"><i class="fa fa-eye" style="font-size: 18px;"></i></a>
                    </td>
                </tr>
                <div class="modal fade" id="{{$agent->user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                    <div class="modal-dialog" role="document" >
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-close"></i>
                                </button>
                                <h3 >Change Department</h3>
                                <form id="change_dept" action="{{url("/department/change/$agent->agent_id")}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                    <select class="custom-select col-8" name="dept_change">
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
@endsection
@section("scriptcode")
    <script>
        $(document).ready(function() {
            $('#agent').DataTable();
        });
        $(document).ready(function () {
            $("#agent_name").change(function () {
                var val = $(this).val();
                @foreach($employees as $emp)
                if (val =={{$emp->emp_id}} ) {
                    $("#dept_id").html("<option value='{{$emp->dept_id}}'>{{$emp->department->dept_name}}</option>");
                }else if(val=="item0") {
                    $("#dept_id").html( "<option></option>");
                }
                @endforeach
            });
        });
    </script>
@endsection

