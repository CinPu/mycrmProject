@extends("layouts.app")
@section("title","Department")
@section("content")
    <div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fa fa-plus mr-3"></i>New Department</button>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label for="dept_name">Depatment Name:</label><br>
                                <input type="text" id="dept_name" class="form-control mb-3"  name="dept_name">
                            </div>
                            <button type="submit" class="btn btn-success float-right mr-2">Save</button>
                            <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal">Close</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <h3 class="ml-3"><i class="fa fa-users mr-2"></i>Department</h3>
            <div class="col-md-12">
                <table class="table">
            <thead>
            <th>Department Name</th>
            <th>Department Head</th>
            <th>Action</th>
            </thead>
            <tbody>
            @foreach($depts as $dept)
                <tr>
                    <td>{{$dept->dept_name}}</td>
                    <td>
                        @if($dept->dept_head==\Illuminate\Support\Facades\Auth::user()->id)
                            <a href="" data-toggle="modal" data-target="#{{$dept->id}}"><i class="fa fa-plus-circle" style="font-size: 20px;"></i></a>
                            Set Department Head
                        @else
                       {{$dept->department_head->name}}
                            @endif
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
                        <a href="{{url("/dept/edit/$dept->id")}}" class="mr-2" data-toggle="modal" data-target="#{{$dept->dept_name}}" data-whatever="@getbootstrap"><i class="fa fa-edit" style="font-size: 18px;"></i></a>
                        <a href="{{url("/dept/delete/$dept->id")}} "class="mr-2" ><i class="fa fa-trash"style="font-size: 18px;"></i></a>
                        <a href="{{url("/dept/showmember/$dept->id")}}" class="mr-2"><i class="fa fa-users mr-2" style="font-size: 18px;"></i></a>

                        <div class="modal fade" id="{{$dept->dept_name}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
@endsection
