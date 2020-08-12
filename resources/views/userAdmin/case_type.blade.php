@extends("layouts.app")
@section("title","Category")
@section("content")
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#case_type" data-whatever="@getbootstrap"><i class="fa fa-plus mr-3"></i>New Case</button>

    <div class="modal fade" id="case_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">New Case</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="case_create" action="{{url("/case_type/create")}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="dept_name">Case Name:</label><br>
                            <input type="text" id="dept_name" class="form-control mb-3"  name="case_name">
                        </div>
                        <button type="submit" class="btn btn-success float-right mr-2">Save</button>
                        <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal">Close</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <h3 class="ml-3"><i class="fa fa-user mr-2"></i>Cases</h3>
        <div class="col-md-12">
            <table class="table" id="case">
            <thead>
            <tr>
                <th scope="col">Case Name
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($case_types as $case)
                <tr>
                    <td><i class="fa fa-bars mr-3"></i> {{$case->name}}
                        <a href="{{url("case_type/delete/$case->id")}}" class="btn btn-danger float-right ml-3"><i class="fa fa-trash"></i></a>
                        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#{{$case->id}}" data-whatever="@getbootstrap"><i class="fa fa-edit"></i></button>

                        <div class="modal fade" id="{{$case->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered ">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New Case</h5>
                                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="case_create" action="{{url("/case_type/update/$case->id")}}" method="POST">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="dept_name">Case Name:</label><br>
                                                <input type="text" id="dept_name" class="form-control mb-3"  name="case_name" value="{{$case->name}}">
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
@endsection
