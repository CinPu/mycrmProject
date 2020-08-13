@extends("layouts.app")
@section("title","Priority")
@section("csscode")
    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}
    </style>
@endsection
@section("content")
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#priority" data-whatever="@getbootstrap"><i class="fa fa-plus mr-3"></i>New Priority</button>

    <div class="modal fade" id="priority" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">New Case</h5>
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
                        <div class="form-group">
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
    <div class="card" style="overflow-x:auto;">
        <h3 class="ml-3"><i class="fa fa-user mr-2"></i>Prioirity</h3>
        <table class="table my-3">
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
                    <th scope="row"><i class="fa fa-bars mr-3"></i> {{$priority->priority}}</th>
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
@endsection
