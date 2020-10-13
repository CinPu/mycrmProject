@extends("layouts.app")
@section("title","Ticket Dashboard")
@section("csscode")
    <style>
        /*#allticket_info,#new_info,#open_info,#close_info,#complete_info,#pending_info,#progress_info{*/
        /*    color: aliceblue;*/
        /*}*/
        .dt-buttons{
            position: relative;
            top: 2px;
        }
    </style>
@endsection
@section("content")
    <div>
    <div class="row" >
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <p class="card-category">All Agents</p>
                    <h3 class="card-title">{{$countAgent}}
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-info text-warning mt-1"></i>
                        <a href="{{url("/agent")}}" class="warning-link ml-2">More Detail ....</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-th"></i>
                    </div>
                    <p class="card-category">Total</p>
                    <h3 class="card-title">{{$countallticket}}
                        <small>Tickets</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-th text-warning mt-1"></i>
                        <a href="" class="warning-link ml-2">Total ticket ....</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-ticket"></i>
                    </div>
                    <p class="card-category">Assigned</p>
                    <h3 class="card-title">{{count($assigned)}}
                        <small>Tickets</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <a href="{{url("isassign/1")}}"><i class="fa fa-ticket mr-2"></i>Assign Ticket Detail...</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">info_outline</i>
                    </div>
                    <p class="card-category">Unassigned</p>
                    <h3 class="card-title">{{count($unassigned)}}
                        <small>Tickets</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <a href="{{url("isassign/2")}}"><i class="fa fa-ticket mr-2"></i>Unassign Ticket Detail...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="card">
    <ul class="nav nav-tabs bg-primary col-md-12 " id="myTab" role="tablist">
        <li class="nav-item my-2 ">
            <a class="nav-link active" id="pills-dashboard-tab" data-toggle="pill" href="#pills-dashboard" role="tab" aria-controls="pills-home" aria-selected="false">All Tickets
            </a>
        </li>
        <li class="nav-item my-2">
            <a class="nav-link" id="pills-new-tab" data-toggle="pill" href="#pills-new" role="tab" aria-controls="pills-profile" aria-selected="false">New
                <span class="badge badge-pill bg-white text-dark">{{$new}}</span>
            </a>
        </li>
        <li class="nav-item my-2">
            <a class="nav-link" id="pills-open-tab" data-toggle="pill" href="#pills-open" role="tab" aria-controls="pills-profile" aria-selected="false">Open Ticket
                <span class="badge badge-pill bg-white text-dark">{{$openticket}}</span>
            </a>
        </li>
        <li class="nav-item my-2">
            <a class="nav-link" id="pills-close-tab" data-toggle="pill" href="#pills-close" role="tab" aria-controls="pills-contact" aria-selected="false">Closed Ticket
                <span class="badge badge-pill bg-white text-dark ">{{$closeticket}}</span>
            </a>
        </li>
        <li class="nav-item my-2">
            <a class="nav-link" id="pills-complete-tab" data-toggle="pill" href="#pills-complete" role="tab" aria-controls="pills-contact" aria-selected="false">Completed Ticket
                <span class="badge badge-pill bg-white text-dark ">{{$complete}}</span>
            </a>
        </li>
        <li class="nav-item my-2">
            <a class="nav-link" id="pills-pending-tab" data-toggle="pill" href="#pills-pending" role="tab" aria-controls="pills-profile" aria-selected="false">Pending
                <span class="badge badge-pill bg-white text-dark">{{$pending}}</span>
            </a>
        </li>
        <li class="nav-item my-2">
            <a class="nav-link" id="pills-progress-tab" data-toggle="pill" href="#pills-progress" role="tab" aria-controls="pills-profile" aria-selected="false">Progress
                <span class="badge badge-pill bg-white text-dark">{{$progress}}</span>
            </a>
        </li>
{{--        <li class="nav-item my-2">--}}
{{--            <a href="{{url("/ticket/create/".\Illuminate\Support\Facades\Auth::user()->uuid)}}" class="nav-link float-right"  ><i class="fa fa-plus float-left mr-2 mt-1" ></i>New Ticket</a>--}}
{{--        </li>--}}
    </ul>

        <div class="tab-content" id="pills-tabContent"  >
            <div class="tab-pane fade show active col-md-12" id="pills-dashboard" role="tabpanel" aria-labelledby="pills-profile-tab" style="overflow-x:auto;">
                <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>All Tickets</h3>
                <table class="table" id="allticket">
                    <div class=" col-md-12">
                        <div class="row">
                            <label class="col-md-3 ">Search By</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-1 text-white">
                                <select class="custom-select"  id="casetype">
                                    <option value=""> All</option>
                                    @foreach($allcases as $case)
                                        <option value="{{$case->name}}"> {{$case->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="offset-md-0">
                                <span class=" mr-3 ">Start Date</span>
                            </div>
                            <div class="text-white">
                                <input type="text" class="form-control" id="min" name="min" >
                            </div>
                            <div class=" offset-md-1">
                                <span class=" mr-3 ">End Date</span>
                            </div>
                            <div class="text-white">
                                <input type="text" class="form-control" id="max" name="max" >
                            </div>

                        </div>
                    </div>
                    <thead>
                    {{--                        <input type="checkbox" name="select-all" id="select-all" /><span id="label_selectall" class="ml-2">All</span>--}}
                    {{--                        <button class="btn btn-info ml-3 "  type="button"  data-toggle="modal" data-target="#exampleModal">--}}
                    {{--                            <i class="fa fa-hand-o-right mr-2" aria-hidden="true"></i>Assign--}}
                    {{--                        </button>--}}
                    <tr>
                        <th scope="col">Ticket Title</th>
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Message</th>
                        <th scope="col">Assign/Unassign</th>
                        <th scope="col">Status</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Category</th>
                        <th scope="col">Created at</th>
                    </tr>
                    </thead>
                    <tbody >
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{$ticket->title}}</td>
                            <td>
                                <a href="{{ url("tickets/$ticket->ticket_id") }}" class="text-primary">
                                    #{{ $ticket->ticket_id }}
                                </a>
                            </td>
                            <td>{!!substr($ticket->message,0,150)!!}....</td>
                            <td>
                                @if($ticket->isassign==1)
                                    <a href="" class="btn btn-success"> Assigned <i class="fa fa-check-circle-o"></i></a>
                                @elseif($ticket->isassign==0)
                                    <a href="{{url("isassign/2")}}" class="btn btn-facebook">Unassigned </a> @endif
                            </td>
                            <td>{{$ticket->status_type->status}}</td>
                            <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}">{{$ticket->priority_type->priority}}</button></td>
                            <td>
                                {{$ticket->cases->name}}
                            </td>
                            <td>{{$ticket->created_at->toFormattedDateString()}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--                <!-- Ticket assign Modal -->--}}
                {{--                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                {{--                    <div class="modal-dialog" role="document">--}}
                {{--                        <div class="modal-content">--}}
                {{--                            <div class="modal-header">--}}
                {{--                                <h5 class="modal-title" id="exampleModalLabel">Assign Ticket</h5>--}}
                {{--                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                {{--                                    <span aria-hidden="true">&times;</span>--}}
                {{--                                </button>--}}
                {{--                            </div>--}}
                {{--                            <div class="modal-body">--}}

                {{--                                {{csrf_field()}}--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <label for="type">Assign Type :</label>--}}
                {{--                                    <select class="form-control col-md-6 offset-md-2" id="type" name="assignType">--}}
                {{--                                        <option value="item0">Choose Assign Type</option>--}}
                {{--                                        <option value="dept">Assign To Department</option>--}}
                {{--                                        <option value="agent">Assign To Agent</option>--}}
                {{--                                    </select>--}}
                {{--                                </div>--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <label for="size">Assign To :</label>--}}
                {{--                                    <select class="form-control col-md-6 offset-md-2" name="assign_id" id="size">--}}
                {{--                                        <option></option>--}}
                {{--                                    </select>--}}
                {{--                                </div>--}}
                {{--                                <button  id="ajax" data-dismiss="modal" class="btn btn-primary float-right">Assigned</button>--}}

                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

            </div>
            <div class="tab-pane fade col-md-12 " id="pills-new" role="tabpanel" aria-labelledby="pills-profile-tab" style="overflow-x:auto;">
                <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>New Tickets</h3>
                <table class="table" id="new">
                    <thead>
                    <div class=" col-md-12">
                        <div class="row">
                            <label class="col-md-3 ">Search By</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-1">
                                <select class="custom-select"  id="new_casetype">
                                    <option value=""> All</option>
                                    @foreach($allcases as $case)
                                        <option value="{{$case->name}}"> {{$case->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="offset-md-0">
                                <span class=" mr-3 ">Start Date</span>
                            </div>
                            <div>
                                <input type="text" class="form-control" id="new_min" name="new_min" >
                            </div>
                            <div class=" offset-md-1">
                                <span class=" mr-3 ">End Date</span>
                            </div>
                            <div >
                                <input type="text" class="form-control" id="new_max" name="new_max" >
                            </div>

                        </div>
                    </div>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Message</th>
                        <th scope="col">Status</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Category</th>
                        <th scope="col">Last Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        @if($ticket->status_type->status=="New")
                            <tr>
                                <th scope="row" >{{$ticket->title}}</th>
                                <td>
                                    <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                        #{{ $ticket->ticket_id }}
                                    </a>
                                </td>
                                <td>{!!substr($ticket->message,0,150)!!}...</td>
                                <td>{{$ticket->status_type->status}}</td>
                                <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}">{{$ticket->priority_type->priority}}</button></td>
                                {{--                                <td class="border"><img src="{{asset("/imgs/$photos[1]")}}" alt="" width="200px"height="200px"></td>--}}
                                <td>
                                    {{$ticket->cases->name}}
                                </td>
                                <td>{{$ticket->created_at->toFormattedDateString()}}</td>

                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade col-md-12" id="pills-open" role="tabpanel" aria-labelledby="pills-profile-tab" style="overflow-x:auto;">
                <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>Open Tickets</h3>
                <table class="table" id="open">
                    <thead>
                    <div class=" col-md-12">
                        <div class="row">
                            <label class="col-md-3 ">Search By</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-1 ">
                                <select class="custom-select"  id="open_casetype">
                                    <option value=""> All</option>
                                    @foreach($allcases as $case)
                                        <option value="{{$case->name}}"> {{$case->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" offset-md-0">
                                <span class=" mr-3 ">Start Date</span>
                            </div>
                            <div>
                                <input type="text" class="form-control" id="open_min" name="open_min" >
                            </div>
                            <div class=" offset-md-1">
                                <span class=" mr-3 ">End Date</span>
                            </div>
                            <div >
                                <input type="text" class="form-control" id="open_max" name="open_max" >
                            </div>

                        </div>
                    </div>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Message</th>
                        <th scope="col">Status</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Category</th>
                        <th scope="col">Last Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        @if($ticket->status_type->status=="Open")
                            <tr>
                                <th scope="row" >{{$ticket->title}}</th>
                                <td>
                                    <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                        #{{ $ticket->ticket_id }}
                                    </a>
                                </td>
                                <td>{!!substr($ticket->message,0,150)!!}...</td>
                                <td>{{$ticket->status}}</td>
                                <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}">{{$ticket->priority_type->priority}}</button></td>
                                {{--                                <td class="border"><img src="{{asset("/imgs/$photos[1]")}}" alt="" width="200px"height="200px"></td>--}}
                                <td>
                                    {{$ticket->cases->name}}
                                </td>
                                <td>{{$ticket->created_at->toFormattedDateString()}}</td>

                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade col-md-12" id="pills-close" role="tabpanel" aria-labelledby="pills-contact-tab"style="overflow-x:auto;">
                <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>Closed Tickets</h3>
                <table class="table " id="close">
                    <thead>
                    <div class=" col-md-12">
                        <div class="row">
                            <label class="col-md-3 ">Search By</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-1 ">
                                <select class="custom-select"  id="close_casetype">
                                    <option value=""> All</option>
                                    @foreach($allcases as $case)
                                        <option value="{{$case->name}}"> {{$case->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" offset-md-0">
                                <span class=" mr-3 ">Start Date</span>
                            </div>
                            <div >
                                <input type="text" class="form-control" id="close_min" name="close_min" >
                            </div>
                            <div class="offset-md-1">
                                <span class=" mr-3 ">End Date</span>
                            </div>
                            <div>
                                <input type="text" class="form-control" id="close_max" name="close_max" >
                            </div>

                        </div>
                    </div>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Message</th>
                        <th scope="col">Status</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Category</th>
                        <th scope="col">Last Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        @if($ticket->status_type->status=="Close")
                            <tr>
                                <th scope="row">{{$ticket->title}}</th>
                                <td>
                                    <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                        #{{ $ticket->ticket_id }}
                                    </a>
                                </td>
                                <td>{!!substr($ticket->message,0,150)!!}...</td>
                                <td>{{$ticket->status}}</td>
                                <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}">{{$ticket->priority_type->priority}}</button></td>

                                <td>
                                    {{$ticket->cases->name}}
                                </td>
                                <td>{{$ticket->created_at->toFormattedDateString()}}</td>

                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade col-md-12" id="pills-complete" role="tabpanel" aria-labelledby="pills-profile-tab" style="overflow-x:auto;">
                <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>Completed Tickets</h3>
                <table class="table" id="complete">
                    <thead>
                    <div class=" col-md-12">
                        <div class="row">
                            <label class="col-md-3 ">Search By</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-1">
                                <select class="custom-select"  id="complete_casetype">
                                    <option value=""> All</option>
                                    @foreach($allcases as $case)
                                        <option value="{{$case->name}}"> {{$case->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" offset-md-0">
                                <span class=" mr-3 ">Start Date</span>
                            </div>
                            <div>
                                <input type="text" class="form-control" id="complete_min" name="complete_min" >
                            </div>
                            <div class=" offset-md-1">
                                <span class="mr-3 ">End Date</span>
                            </div>
                            <div >
                                <input type="text" class="form-control" id="complete_max" name="complete_max" >
                            </div>

                        </div>
                    </div>

                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Message</th>
                        <th scope="col">Status</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Category</th>
                        <th scope="col">Last Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        @if($ticket->status_type->status=="Complete")
                            <tr>
                                <th scope="row">{{$ticket->title}}</th>
                                <td>
                                    <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                        #{{ $ticket->ticket_id }}
                                    </a>
                                </td>
                                <td>{!!substr($ticket->message,0,150)!!}...</td>
                                <td>{{$ticket->status}}</td>
                                <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}">{{$ticket->priority_type->priority}}</button></td>

                                <td>
                                    {{$ticket->cases->name}}
                                </td>
                                <td>{{$ticket->created_at->toformattedDateString()}}</td>

                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade col-md-12" id="pills-pending" role="tabpanel" aria-labelledby="pills-profile-tab" style="overflow-x:auto;">
                <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>Pending Tickets</h3>
                <table class="table" id="pending">
                    <thead>
                    <div class=" col-md-12">
                        <div class="row">
                            <label class="col-md-3 ">Search By</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-1">
                                <select class="custom-select"  id="pending_casetype">
                                    <option value=""> All</option>
                                    @foreach($allcases as $case)
                                        <option value="{{$case->name}}"> {{$case->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" offset-md-0">
                                <span class=" mr-3 ">Start Date</span>
                            </div>
                            <div>
                                <input type="text" class="form-control" id="pending_min" name="pending_min" >
                            </div>
                            <div class=" offset-md-1">
                                <span class=" mr-3 ">End Date</span>
                            </div>
                            <div>
                                <input type="text" class="form-control" id="pending_max" name="pending_max" >
                            </div>

                        </div>
                    </div>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Message</th>
                        <th scope="col">Status</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Category</th>
                        <th scope="col">Last Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        @if($ticket->status_type->status=="Pending")
                            <tr>
                                <th>{{$ticket->title}}</th>
                                <td>
                                    <a href="{{ url("tickets/$ticket->ticket_id") }}">#{{$ticket->ticket_id}}
                                    </a>
                                </td>
                                <td>{!!substr($ticket->message,0,150)!!}...</td>
                                <td>{{$ticket->status}}</td>
                                <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}">{{$ticket->priority_type->priority}}</button></td>
                                {{--                                <td class="border"><img src="{{asset("/imgs/$photos[1]")}}" alt="" width="200px"height="200px"></td>--}}
                                <td>
                                    {{$ticket->cases->name}}
                                </td>

                                <td>{{$ticket->created_at->toFormattedDateString()}}</td>

                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade col-md-12" id="pills-progress" role="tabpanel" aria-labelledby="pills-profile-tab" style="overflow-x:auto;">
                <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>Progress Tickets</h3>
                <table class="table" id="progress">
                    <thead>
                    <div class=" col-md-12">
                        <div class="row">
                            <label class="col-md-3 ">Search By</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-1">
                                <select class="custom-select"  id="progress_casetype">
                                    <option value=""> All</option>
                                    @foreach($allcases as $case)
                                        <option value="{{$case->name}}"> {{$case->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="offset-md-0">
                                <span class=" mr-3 ">Start Date</span>
                            </div>
                            <div>
                                <input type="text" class="form-control" id="progress_min" name="progress_min" >
                            </div>
                            <div class=" offset-md-1">
                                <span class=" mr-3 ">End Date</span>
                            </div>
                            <div class="text-white">
                                <input type="text" class="form-control" id="progress_max" name="progress_max" >
                            </div>

                        </div>
                    </div>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Message</th>
                        <th scope="col">Status</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Category</th>
                        <th scope="col">Last Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        @if($ticket->status_type->status=="Inprogress")
                            <tr>
                                <th scope="row">{{$ticket->title}}</th>
                                <td>
                                    <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                        #{{ $ticket->ticket_id }}
                                    </a>
                                </td>
                                <td>{!!substr($ticket->message,0,150)!!}...</td>
                                <td>{{$ticket->status}}</td>
                                <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}">{{$ticket->priority_type->priority}}</button></td>
                                {{--                                <td class="border"><img src="{{asset("/imgs/$photos[1]")}}" alt="" width="200px"height="200px"></td>--}}
                                <td>{{$ticket->cases->name}}</td>
                                <td>{{$ticket->created_at->toFormattedDateString()}}</td>

                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                {{--                </div>--}}

            </div>
        </div>
    </div>
    </div>
{{--    <script>--}}
{{--        // $('#select-all').click(function(event) {--}}
{{--        //     if(this.checked) {--}}
{{--        //         // Iterate each checkbox--}}
{{--        //         $(':checkbox').each(function() {--}}
{{--        //             this.checked = true;--}}
{{--        //         });--}}
{{--        //     } else {--}}
{{--        //         $(':checkbox').each(function() {--}}
{{--        //             this.checked = false;--}}
{{--        //         });--}}
{{--        //     }--}}
{{--        // });--}}
{{--        $(document).ready(function() {--}}
{{--            $(document).on('click', '#ajax', function () {--}}
{{--                var ticket_id = new Array();--}}
{{--                $("input:checked").each(function () {--}}
{{--                    //console.log($(this).val()); //works fine--}}
{{--                    ticket_id.push($(this).val());--}}
{{--                });--}}
{{--                var assign_type=$( "#type option:selected" ).val();--}}
{{--                var assign_name=$( "#size option:selected" ).val();--}}

{{--                $.ajax({--}}
{{--                    type:'POST',--}}
{{--                    data : {ticket_id:ticket_id,assignType:assign_type,assign_id:assign_name},--}}
{{--                    url:'/assign',--}}
{{--                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
{{--                    success:function(data){--}}
{{--                        console.log(data);--}}
{{--                        window.location.reload()--}}
{{--                        md.showNotification("bottom", "center","Assigned Successful","info");--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

    <script>

        {{--$(document).ready(function () {--}}
        {{--    $("#type").change(function () {--}}
        {{--        var userid=document.getElementById("user_id").val();--}}
        {{--        var val = $(this).val();--}}
        {{--        if (val == "dept") {--}}
        {{--            $("#size").html("@foreach($depts as $dept)<option value='{{$dept->id}}'>{{$dept->dept_name}}</option> @endforeach");--}}
        {{--        } else if (val == "agent") {--}}
        {{--            $("#size").html(" @if(Auth::user()->hasAnyRole('Admin')) @foreach($agents as $agent) @if($agent->user->uuid!=$ticket->user_id)<option value='{{$agent->user->id}}'>{{$agent->user->name}}</option> @endif @endforeach @elseif(Auth::user()->hasAnyRole('Agent'))@foreach($admin_agents as $agent)@if($agent->user->uuid!=Auth::user()->uuid)<option value='{{$agent->user->id}}'>{{$agent->user->name}}</option> @endif @endforeach @endif");--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
        //for all tickets
        $(document).ready(function() {
            $('#allticket').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],

            } );

        } );
        $('#casetype').on('change', function() {
            var table = $('#allticket').DataTable();
            table.column(6).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#min').datepicker("getDate");
                    var max = $('#max').datepicker("getDate");
                    var startDate = new Date(data[7]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#allticket').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').change(function () {
                table.draw();
            });
        });

        // status new ticket
        $(document).ready(function() {
            $('#new').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
        $('#new_casetype').on('change', function() {
            var table = $('#new').DataTable();
            table.column(5).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#new_min').datepicker("getDate");
                    var max = $('#new_max').datepicker("getDate");
                    var startDate = new Date(data[6]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#new_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#new_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#new').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#new_min, #new_max').change(function () {
                table.draw();
            });
        });

        // for open ticket
        $(document).ready(function() {
            $('#open').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
        $('#open_casetype').on('change', function() {
            var table = $('#open').DataTable();
            table.column(5).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#open_min').datepicker("getDate");
                    var max = $('#open_max').datepicker("getDate");
                    var startDate = new Date(data[6]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#open_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#open_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#open').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#open_min, #open_max').change(function () {
                table.draw();
            });
        });

        // status close tickets
        $(document).ready(function() {
            $('#close').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
        $('#close_casetype').on('change', function() {
            var table = $('#close').DataTable();
            table.column(5).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#close_min').datepicker("getDate");
                    var max = $('#close_max').datepicker("getDate");
                    var startDate = new Date(data[6]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#close_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#close_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#close').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#close_min, #close_max').change(function () {
                table.draw();
            });
        });

        //complete ticket
        $(document).ready(function() {
            $('#complete').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
        $('#complete_casetype').on('change', function() {
            var table = $('#complete').DataTable();
            table.column(5).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#complete_min').datepicker("getDate");
                    var max = $('#complete_max').datepicker("getDate");
                    var startDate = new Date(data[6]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#complete_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#complete_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#complete').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#complete_min, #complete_max').change(function () {
                table.draw();
            });
        });

        //pending ticket
        $(document).ready(function() {
            $('#pending').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
        $('#pending_casetype').on('change', function() {
            var table = $('#pending').DataTable();
            table.column(5).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#pending_min').datepicker("getDate");
                    var max = $('#pending_max').datepicker("getDate");
                    var startDate = new Date(data[6]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#pending_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#pending_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#pending').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#pending_min, #pending_max').change(function () {
                table.draw();
            });
        });

        //progress ticket
        $(document).ready(function() {
            $('#progress').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
        $('#progress_casetype').on('change', function() {
            var table = $('#progress').DataTable();
            table.column(5).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#progress_min').datepicker("getDate");
                    var max = $('#progress_max').datepicker("getDate");
                    var startDate = new Date(data[6]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#progress_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#progress_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#progress').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#progress_min, #progress_max').change(function () {
                table.draw();
            });
        });

    </script>

    {{--        @yield("ticket")--}}

@endsection

