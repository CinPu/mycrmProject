@extends("layouts.mainlayout")
@section("title","Cases Type")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Complain Type</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Complain Type</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn"  data-toggle="modal" data-target="#case_type" data-whatever="@getbootstrap"><i class="fa fa-plus"></i> Add Complain Type</a>
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
        <div class="card-header card-header-danger">
        <h4 class="text-dark"><i class="fa fa-list-alt mr-2"></i>Cases</h4>
        </div>
        <div class="col-12" style="overflow-x: auto">
        <table class="table " id="case">
            <thead>
            <tr>
                <th scope="col">Case Name</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($case_types as $case)
                <tr>
                    <td><i class="fa fa-bars mr-3"></i>{{$case->name}}
                    </td>
                    <td>
                        <a href="{{url("case_type/delete/$case->id")}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        <a href="" class="btn btn-success " data-toggle="modal" data-target="#{{$case->id}}" data-whatever="@getbootstrap"><i class="fa fa-edit"></i></a>

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
        </div>
    </div>
    <script>
        $(document).ready(function (){
           $("#case").DataTable();
        });
    </script>
@endsection
