@extends("layouts.mainlayout")
@section("title","Priority")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Priority</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Priority</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn"  data-toggle="modal" data-target="#priority" data-whatever="@getbootstrap"><i class="fa fa-plus"></i> Add Priority</a>
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
            <div class="modal fade" id="priority" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title " id="exampleModalLabel">New Priority</h5>
                            <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="priority_create" action="{{url("/priority/create")}}" method="post" class="my-2">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="priority">Priority</label>
                                    <input type="text" class="form-control" id="priority" aria-describedby="emailHelp" name="priority">
                                </div>
                                <div class="form-group">
                                    <label for="priority">Color</label>
                                    <select class="form-control"name="color" id="">
                                        <option value="success">Green</option>
                                        <option value="danger">Red</option>
                                        <option value="facebook">Blue</option>
                                        <option value="primary">Pink</option>
                                    </select>
                                </div>
                                <label>Duration Time : </label>
                                <div class="form-group">
                                    <span >
		                     <select class="custom-select col-3 " name="hour" style="margin-left: 0px;">
                                @for($i=0;$i<24;$i++)
                                <option>{{$i}}</option>
                                 @endfor
                             </select>
                            </span>
                                    <span>h</span>
                                    <select name="min" class="custom-select col-3">
                                @for($i=0;$i<60;$i++)
                                    <option>{{$i}}</option>
                                @endfor
                            </select>
                                    <span>m</span>
                                    <select name="sec"  class="custom-select col-3">
                                        @for($i=0;$i<60;$i++)
                                            <option>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <span>s</span>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
        <div class="col-md-12 mt-5" style="overflow-x:auto;">
        <table class="table" id="ticket_priority">
            <thead>
            <tr>
                <th scope="col">Priority Name</th>
                <th scope="col">Color</th>
                <th scope="col">Duration Time</th>
                <th scope="col">Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($priorities as $priority)
                <tr>
                    <td><i class="fa fa-bars mr-3"></i> {{$priority->priority}}</td>
                    <td>@if($priority->color=="success")
                            <a href=""class="btn btn-success">Green</a>
                        @elseif($priority->color=="danger")
                            <a href=""class="btn btn-danger">Red</a>
                        @elseif($priority->color=="primary")
                            <a href=""class="btn btn-primary">Pink</a>
                        @elseif($priority->color=="facebook")
                            <a href=""class="btn btn-facebook">Blue</a>
                        @endif
                    </td>
                    <td>
                        <span>{{$priority->hours}} Hour {{$priority->minutes}} Minutes {{$priority->seconds}} Seconds</span>
                    </td>
                    <td>
                        <a href="{{url("priority/delete/$priority->id")}}" class="btn btn-danger "><i class="fa fa-trash"></i></a>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#{{$priority->id}}" data-whatever="@getbootstrap"><i class="fa fa-edit"></i></button>

                        <div class="modal fade" id="{{$priority->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Priority</h5>
                                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form  id="{{$priority->id}}" method="post" action="{{url("/priority/update/$priority->id")}}" class="my-2">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="priority_name">Priority Name</label>
                                                <input type="text" class="form-control" id="priority_name" aria-describedby="emailHelp" name="priority" value="{{$priority->priority}}" placeholder="Priority Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="priority">Color: <button type="button" class="btn btn-{{$priority->color}}"></button></label>
                                                <select class="form-control"name="color" id="">
                                                    <option></option>
                                                    <option value="success">Green</option>
                                                    <option value="danger">Red</option>
                                                    <option value="facebook">Blue</option>
                                                    <option value="primary">Pink</option>
                                                </select>
                                            </div>
                                            <span>Old Duration Time : </span> : {{$priority->hours}} Hours {{$priority->minutes}} Minutes {{$priority->seconds}} Seconds
                                            <div class="form-group ">
                                                <label for="duration_time" class="my-2">Select New Duration Time : </label><br>
                                                <select class="custom-select col-3 " name="hour" style="margin-left: 0px;">
                                                    @for($i=0;$i<24;$i++)
                                                        <option>{{$i}}</option>
                                                    @endfor
                                                </select>
                                                <span>h</span>
                                                <select name="min" class="custom-select col-3">
                                                    @for($i=0;$i<60;$i++)
                                                        <option>{{$i}}</option>
                                                    @endfor
                                                </select>
                                                <span>m</span>
                                                <select name="sec" class="custom-select col-3">
                                                    @for($i=0;$i<60;$i++)
                                                        <option>{{$i}}</option>
                                                    @endfor
                                                </select>
                                                <span>s</span>
                                            </div>
                                            <button type="submit" class="btn btn-primary float-right">Submit</button>
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
           $("#ticket_priority").DataTable();
        });
    </script>
@endsection
