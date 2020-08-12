@extends("layouts.app")
@section("title","Department")
@section("content")
    <div class="container-fluid">
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
            <th>Action</th>
            </thead>
            <tbody>
            @foreach($depts as $dept)
                <tr>
                    <td>{{$dept->dept_name}}</td>
                    <td>
                        <a href="{{url("/dept/edit/$dept->id")}}" class="btn btn-success" data-toggle="modal" data-target="#{{$dept->dept_name}}" data-whatever="@getbootstrap"><i class="fa fa-edit"></i></a>
                        <a href="{{url("/dept/delete/$dept->id")}}" CLASS="btn btn-danger"><i class="fa fa-trash"></i></a>
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
