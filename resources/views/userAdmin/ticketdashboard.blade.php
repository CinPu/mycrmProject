@extends("layouts.mainlayout")
@section("title","Dashboard")
@section("content")
    <style>
        /*#allticket_info,#new_info,#open_info,#close_info,#complete_info,#pending_info,#progress_info{*/
        /*    color: aliceblue;*/
        /*}*/
        .dt-buttons{
            position: relative;
            top: 2px;
        }
        .dataTables_filter{
            display: none;
        }
        .scroll {
            /*width: 300px;*/
            height: 270px;
            overflow: scroll;
        }
    </style>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div>
            @php
            if ($tickets!=null){
            $all=count($tickets);
            $percetnOfnew=round(($new/$all)*100);
            $percentOfopen=round(($openticket/$all)*100);
            $percentOfsolved=round(($complete/$all)*100);
            $percentOfpending=round(($pending/$all)*100);
            }else{
             $percetnOfnew=0;
            $percentOfopen=0;
            $percentOfsolved=0;
            $percentOfpending=0;
            }
        @endphp
            <br>
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Tickets</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tickets</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{url("/ticket/create/".\Illuminate\Support\Facades\Auth::user()->uuid)}}" class="btn add-btn" ><i class="fa fa-plus"></i> Add Ticket</a>
                </div>
            </div>
            </div>
        <!-- /Page Header -->
        <div class="col-md-12">
            <div class="row" >

                <div class="card col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <a href="{{url("/ticket/status/new")}}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">New Tickets</span>
                            </div>
                            <div>
                                <span class="text-success">{{$percetnOfnew}}%</span>
                            </div>
                        </div>
                        <h3 class="mb-3">{{$new}}</h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{$percetnOfnew}}%;">

                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="card col-xl-3 col-lg-6 col-md-6 col-sm-6" >
                    <a href="{{url("/ticket/status/complete")}}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">Solved Tickets</span>
                            </div>
                            <div>
                                <span class="text-success">{{$percentOfsolved}}%</span>
                            </div>
                        </div>
                        <h3 class="mb-3">{{$complete}}</h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$complete}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$percentOfsolved}}%;">

                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="card col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <a href="{{url("/ticket/status/open")}}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">Open Tickets</span>
                            </div>
                            <div>
                                <span class="text-danger">{{$percentOfopen}}%</span>
                            </div>
                        </div>
                        <h3 class="mb-3">{{$openticket}}</h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width:{{$percentOfopen}}%;"></div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="card col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <a href="{{url("/ticket/status/pending")}}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div><span class="d-block">Pending Tickets</span>
                            </div>
                            <div>
                                <span class="text-danger">{{$percentOfpending}}%</span>
                            </div>
                        </div>
                        <h3 class="mb-3">{{$pending}}</h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$percentOfpending}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$percentOfpending}}%;"></div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
            <!-- Ticket Filter Form -->
            <form action="{{url("/ticket/search")}}" id="search_ticket" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-2 col-sm-4">
                        <div class="form-group">
                            <select id="agent_name" name="agent_name" class="select form-control text-center" >
                                <option disabled selected hidden>Select Agent .... </option>
                                @foreach($agents as $agent)
                                    <option value="{{$agent->agent_id}}">{{$agent->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4">
                        <div class="form-group">
                            <select id="priority_search" name="priority" class="select form-control" >
                                <option disabled selected hidden>Select Priority .... </option>
                                @foreach($priorities as $priority)
                                    <option value="{{$priority->id}}">{{$priority->priority}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4">
                        <div class="form-group">
                            <select name="status" id="status" class="select form-control" >
                                <option disabled selected hidden>Select Status ...</option>
                                @foreach($statuses as $status)
                                    <option value="{{$status->id}}">{{$status->status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <span class="mt-2 offset-1 offset-lg-0 offset-sm-1">From</span>
                    <div class="col-lg-2 col-sm-4">
                        <div class="form-group">
                            <input type="date" id="from_date" name="from_date" class="form-control" required>
                        </div>
                    </div>
                    <span class="mt-2 offset-1 offset-lg-0 offset-sm-0">To</span>
                    <div class="col-lg-2 col-sm-4">
                        <div class="form-group">
                           <span> <input type="date" name="to_date" id="to_date" class="form-control" required></span>
                        </div>
                    </div>
                    <div class="col-lg-1 col-12 col-sm-2 mr-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-warning rounded col-12"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <!--end of Ticket filter Form -->
        <div class="card rounded">
            <!-- ticket tab dropdown -->
            <div class="dropdown">
                    <a class="dropdown-toggle dropdown-toggle-split btn btn-outline-secondary my-2 ml-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 18px;">
                     <i class="fa fa-ticket mr-2"></i>Ticket
                    </a>
                    <div class="dropdown-menu mt-1 col-md-2">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="dropdown-item rounded mr-2 ml-2" id="pills-dashboard-tab" data-toggle="tab" href="#pills-dashboard" role="tab" aria-controls="pills-home" aria-selected="true" >
                            <span>All Tickets</span>
                            <span class="float-right">{{$countallticket}}</span>
                        </a>
                        <a class="dropdown-item rounded mr-2 ml-2" id="pills-new-tab" data-toggle="tab" href="#pills-new" role="tab" aria-controls="pills-profile" aria-selected="false" >
                            <span>New</span>
                            <span  class="float-right">{{$new}}</span>
                        </a>
                        <a class="dropdown-item rounded mr-2 ml-2" id="pills-open-tab" data-toggle="tab" href="#pills-open" role="tab" aria-controls="pills-profile" aria-selected="false" >
                            <span>Open Ticket</span>
                            <span class="float-right">{{$openticket}}</span>
                        </a>
                        <a class="dropdown-item rounded mr-2 ml-2" id="pills-close-tab" data-toggle="tab" href="#pills-close" role="tab" aria-controls="pills-contact" aria-selected="false" >
                            <span>Closed Ticket</span>
                            <span class="float-right">{{$closeticket}}</span>
                        </a>
                        <a class="dropdown-item rounded mr-2 ml-2" id="pills-complete-tab" data-toggle="tab" href="#pills-complete" role="tab" aria-controls="pills-contact" aria-selected="false" >
                            <span>Completed Ticket</span>
                            <span class="float-right">{{$complete}}</span>
                        </a>
                        <a class="dropdown-item rounded mr-2 ml-2 " id="pills-pending-tab" data-toggle="tab" href="#pills-pending" role="tab" aria-controls="pills-profile" aria-selected="false" >
                            <span>Pending</span>
                            <span class="float-right">{{$pending}}</span>
                        </a>
                        <a class="dropdown-item rounded mr-2 ml-2 mb-3" id="pills-progress-tab" data-toggle="tab" href="#pills-progress" role="tab" aria-controls="pills-profile" aria-selected="false" >
                            <span>Progress</span>
                            <span class="float-right">{{$progress}}</span>
                        </a>
                        </div>
                        </div>
                   </div>
            <!-- Ticket tab dropdown end -->
            <!-- ticket tab content start-->
            <div class="tab-content" id="nav-tabContent" role="tablist"  >
                <div class="tab-pane fade show active col-md-12" id="pills-dashboard" role="tabpanel" aria-labelledby="pills-profile-tab" style="overflow-x:auto;">
                    <div class="row">
                        <h5 class=" text-dark col-md-10 col-6">All Tickets</h5>
                    </div>
                    <table class="table" id="allticket">
                        <thead>
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
                        <button type="button" class="btn btn-outline-secondary float-right" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-upload mr-2"></i>Import
                        </button>
                        <!-- Button import modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Ticket</h5>
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
                        <!-- import ticket -->
                        <tr>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">Ticket Title</th>
                            {{--                        <th scope="col">Description</th>--}}
                            <th scope="col">Assign Agent</th>
                            <th scope="col">Status</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Case Type</th>
                            <th scope="col">Created at</th>
                        </tr>
                        </thead>
                        <tbody >
                        @foreach($tickets as $ticket)
                            <tr>
                                <th>
                                    <a href="{{ url("tickets/$ticket->ticket_id") }}" class="text-primary">
                                        #{{ $ticket->ticket_id }}
                                    </a>
                                </th>
                                <td>{{$ticket->title}}</td>
                                <td>
                                    @if($ticket->isassign==1)
                                        @foreach($assign_name as $assignName)
                                            @if($assignName->ticket_id==$ticket->id)
                                              @if($assignName->type_of_assign==0)
                                                    @php
                                                        $emp=\App\employee::where("id",$assignName->employee->emp_id)->first();
                                                    @endphp
                                                    @if($emp->emp_profile!=null)
                                                        <img src="{{url(asset("/profile/".$emp->emp_profile))}}" alt="" width="30px" height="30px;" class="rounded-circle">
                                                        {{$emp->name}}
                                                    @else
                                                        <img src="{{asset("assets/img/user.png")}}" alt="" width="30px" height="30px">
                                                        {{$emp->name}}
                                                    @endif
                                                @else
                                                  {{$assignName->dept->dept_name}}
                                                @endif
                                            @endif
                                        @endforeach
                                    @elseif($ticket->isassign==0)
                                        <a href="{{url("isassign/2")}}" class="btn btn-outline-warning">Unassigned </a> @endif
                                </td>
                                <td><a href=""  data-toggle="modal" data-target="#status{{$ticket->id}}">{{$ticket->status_type->status}}</a>
                                    <div class="modal fade" id="status{{$ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                        <div class="modal-dialog" role="document" style="padding-left: 200px;">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h3 class="text-dark">Change Status</h3>
                                                    <form action="{{ url("/status/change/".$ticket->ticket_id) }}" method="GET" class="form">
                                                        <select class="custom-select" name="status_change">
                                                            @foreach($statuses as $status)
                                                                @if(Auth::user()->hasAnyRole("TicketAdmin"))
                                                                    <option value="{{$status->id}}">{{$status->status}}</option>
                                                                @else
                                                                    @if($status->status!="Close")
                                                                        <option value="{{$status->id}}">{{$status->status}}</option>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary float-right">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><i class="fa fa-dot-circle-o text-{{$ticket->priority_type->color}} mr-2"></i>{{$ticket->priority_type->priority}}</td>
                                <td>
                                    {{$ticket->cases->name}}
                                </td>
                                <td>{{$ticket->created_at->toFormattedDateString()}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane fade col-md-12 " id="pills-new" role="tabpanel" aria-labelledby="pills-profile-tab" style="overflow-x:auto;">
                    <div class="row">
                    <h5 class=" text-dark col-md-10 col-6">New Tickets</h5>
                    </div>
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
                        <!-- Button import modal -->
                        <button type="button" class="btn btn-outline-secondary float-right" data-toggle="modal" data-target="#newticket">
                            <i class="fa fa-upload mr-2"></i>Import
                        </button>

                        <!-- Import Modal -->
                        <div class="modal fade" id="newticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Ticket</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url("/ticket/import")}}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <label>Choose Excel and CSV File</label>
                                            <input type="file" name="file" >
                                            <br>
                                            <button class="btn btn-outline-success float-right"><i class="fa fa-upload mr-2"></i>Import Ticket</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--             import ticket-->
                        <tr>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Assign Staff</th>
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
                                    <th>
                                        <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                            #{{ $ticket->ticket_id }}
                                        </a>
                                    </th>
                                    <td scope="row" >{{$ticket->title}}</td>

                                    <td>
                                        @if($ticket->isassign==1)
                                            @foreach($assign_name as $assignName)
                                                @if($assignName->ticket_id==$ticket->id)
                                                    @if($assignName->type_of_assign==0)
                                                        @php
                                                            $emp=\App\employee::where("id",$assignName->employee->emp_id)->first();
                                                        @endphp
                                                        @if($emp->emp_profile!=null)
                                                            <img src="{{url(asset("/profile/".$emp->emp_profile))}}" alt="" width="30px" height="30px;" class="rounded-circle">
                                                            {{$emp->name}}
                                                        @else
                                                            <img src="{{asset("assets/img/user.png")}}" alt="" width="30px" height="30px">
                                                            {{$emp->name}}
                                                        @endif
                                                    @else
                                                        {{$assignName->dept->dept_name}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        @elseif($ticket->isassign==0)
                                            <a href="{{url("isassign/2")}}" class="btn btn-outline-warning">Unassigned </a> @endif
                                    </td>
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
                    <div class="row">
                    <h5 class=" text-dark col-md-10 col-6">Open Tickets</h5>

                    </div>
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
                        <!-- Button import modal -->
                        <button type="button" class="btn btn-outline-secondary float-right" data-toggle="modal" data-target="#openticket">
                            <i class="fa fa-upload mr-2"></i>Import
                        </button>
                        <!-- Import Modal -->
                        <div class="modal fade" id="openticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Ticket</h5>
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
                        <!--                import ticket-->
                        <tr>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Assign Staff</th>
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
                                    <th>
                                        <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                            #{{ $ticket->ticket_id }}
                                        </a>
                                    </th>
                                    <td scope="row" >{{$ticket->title}}</td>
                                    <td>
                                        @if($ticket->isassign==1)
                                            @foreach($assign_name as $assignName)
                                                @if($assignName->ticket_id==$ticket->id)
                                                    @if($assignName->type_of_assign==0)
                                                        @php
                                                            $emp=\App\employee::where("id",$assignName->employee->emp_id)->first();
                                                        @endphp
                                                        @if($emp->emp_profile!=null)
                                                            <img src="{{url(asset("/profile/".$emp->emp_profile))}}" alt="" width="30px" height="30px;" class="rounded-circle">
                                                            {{$emp->name}}
                                                        @else
                                                            <img src="{{asset("assets/img/user.png")}}" alt="" width="30px" height="30px">
                                                            {{$emp->name}}
                                                        @endif
                                                    @else
                                                        {{$assignName->dept->dept_name}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        @elseif($ticket->isassign==0)
                                            <a href="{{url("isassign/2")}}" class="btn btn-outline-warning">Unassigned </a> @endif
                                    </td>
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
                <div class="tab-pane fade col-md-12" id="pills-close" role="tabpanel" aria-labelledby="pills-contact-tab"style="overflow-x:auto;">
                   <div class="row">
                    <h5 class=" text-dark col-md-10 col-6">Closed Tickets</h5>
                   </div>
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
                        <!-- Button import modal -->
                        <button type="button" class="btn btn-outline-secondary float-right" data-toggle="modal" data-target="#closeticket">
                            <i class="fa fa-upload mr-2"></i>Import
                        </button>
                        <!-- Import Modal -->
                        <div class="modal fade" id="closeticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Ticket</h5>
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
                        <!--                import ticket-->
                        <tr>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Assign Staff</th>
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
                                    <th>
                                        <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                            #{{ $ticket->ticket_id }}
                                        </a>
                                    </th>
                                    <td scope="row">{{$ticket->title}}</td>
                                    <td>
                                        @if($ticket->isassign==1)
                                            @foreach($assign_name as $assignName)
                                                @if($assignName->ticket_id==$ticket->id)
                                                    @if($assignName->type_of_assign==0)
                                                        @php
                                                            $emp=\App\employee::where("id",$assignName->employee->emp_id)->first();
                                                        @endphp
                                                        @if($emp->emp_profile!=null)
                                                            <img src="{{url(asset("/profile/".$emp->emp_profile))}}" alt="" width="30px" height="30px;" class="rounded-circle">
                                                            {{$emp->name}}
                                                        @else
                                                            <img src="{{asset("assets/img/user.png")}}" alt="" width="30px" height="30px">
                                                            {{$emp->name}}
                                                        @endif
                                                    @else
                                                        {{$assignName->dept->dept_name}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        @elseif($ticket->isassign==0)
                                            <a href="{{url("isassign/2")}}" class="btn btn-outline-warning">Unassigned </a> @endif
                                    </td>
                                    <td>{{$ticket->status_type->status}}</td>
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
                   <div class="row">
                    <h5 class=" text-dark col-md-10 col-6">Completed Tickets</h5>
                   </div>
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
                        <!-- Button import modal -->
                        <button type="button" class="btn btn-outline-secondary float-right" data-toggle="modal" data-target="#completeticket">
                            <i class="fa fa-upload mr-2"></i>Import
                        </button>
                        <!-- Import Modal -->
                        <div class="modal fade" id="completeticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Ticket</h5>
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
                        <!--                import ticket-->
                        <tr>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Assign Staff</th>
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

                                    <th>
                                        <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                            #{{ $ticket->ticket_id }}
                                        </a>
                                    </th>
                                    <td scope="row">{{$ticket->title}}</td>
                                    <td>
                                        @if($ticket->isassign==1)
                                            @foreach($assign_name as $assignName)
                                                @if($assignName->ticket_id==$ticket->id)
                                                    @if($assignName->type_of_assign==0)
                                                        @php
                                                            $emp=\App\employee::where("id",$assignName->employee->emp_id)->first();
                                                        @endphp
                                                        @if($emp->emp_profile!=null)
                                                            <img src="{{url(asset("/profile/".$emp->emp_profile))}}" alt="" width="30px" height="30px;" class="rounded-circle">
                                                            {{$emp->name}}
                                                        @else
                                                            <img src="{{asset("assets/img/user.png")}}" alt="" width="30px" height="30px">
                                                            {{$emp->name}}
                                                        @endif
                                                    @else
                                                        {{$assignName->dept->dept_name}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        @elseif($ticket->isassign==0)
                                            <a href="{{url("isassign/2")}}" class="btn btn-outline-warning">Unassigned </a> @endif
                                    </td>
                                    <td>{{$ticket->status_type->status}}</td>
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
                    <div class="row">
                        <h5 class=" text-dark col-md-10 col-6">Pending Tickets</h5>
                    </div>
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
                        <!-- Button import modal -->
                        <button type="button" class="btn btn-outline-secondary float-right" data-toggle="modal" data-target="#pendingticket">
                            <i class="fa fa-upload mr-2"></i>Import
                        </button>
                        <!-- Import Modal -->
                        <div class="modal fade" id="pendingticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Ticket</h5>
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
                        <!--                import ticket-->
                        <tr>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Assign Staff</th>
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
                                    <th>
                                        <a href="{{ url("tickets/$ticket->ticket_id") }}">#{{$ticket->ticket_id}}
                                        </a>
                                    </th>
                                    <td>{{$ticket->title}}</td>
                                    <td>
                                        @if($ticket->isassign==1)
                                            @foreach($assign_name as $assignName)
                                                @if($assignName->ticket_id==$ticket->id)
                                                    @if($assignName->type_of_assign==0)
                                                        @php
                                                            $emp=\App\employee::where("id",$assignName->employee->emp_id)->first();
                                                        @endphp
                                                        @if($emp->emp_profile!=null)
                                                            <img src="{{url(asset("/profile/".$emp->emp_profile))}}" alt="" width="30px" height="30px;" class="rounded-circle">
                                                            {{$emp->name}}
                                                        @else
                                                            <img src="{{asset("assets/img/user.png")}}" alt="" width="30px" height="30px">
                                                            {{$emp->name}}
                                                        @endif
                                                    @else
                                                        {{$assignName->dept->dept_name}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        @elseif($ticket->isassign==0)
                                            <a href="{{url("isassign/2")}}" class="btn btn-outline-warning">Unassigned </a> @endif
                                    </td>
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
                <div class="tab-pane fade col-md-12" id="pills-progress" role="tabpanel" aria-labelledby="pills-profile-tab" style="overflow-x:auto;">
                    <div class="row">
                        <h5 class=" text-dark col-md-10 col-6">Progress Tickets</h5>
                    </div>
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
                        <!-- Button import modal -->
                        <button type="button" class="btn btn-outline-secondary float-right" data-toggle="modal" data-target="#progressticket">
                            <i class="fa fa-upload mr-2"></i>Import
                        </button>
                        <!-- Import Modal -->
                        <div class="modal fade" id="progressticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Ticket</h5>
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
                        <!--                import ticket-->
                        <tr>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Assign Staff</th>
                            <th scope="col">Status</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Category</th>
                            <th scope="col">Last Updated</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            @if($ticket->status_type->status=="Progress")
                                <tr>
                                    <th>
                                        <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                            #{{ $ticket->ticket_id }}
                                        </a>
                                    </th>
                                    <td scope="row">{{$ticket->title}}</td>
                                    <td>
                                        @if($ticket->isassign==1)
                                            @foreach($assign_name as $assignName)
                                                @if($assignName->ticket_id==$ticket->id)
                                                    @if($assignName->type_of_assign==0)
                                                        @php
                                                            $emp=\App\employee::where("id",$assignName->employee->emp_id)->first();
                                                        @endphp
                                                        @if($emp->emp_profile!=null)
                                                            <img src="{{url(asset("/profile/".$emp->emp_profile))}}" alt="" width="30px" height="30px;" class="rounded-circle">
                                                            {{$emp->name}}
                                                        @else
                                                            <img src="{{asset("assets/img/user.png")}}" alt="" width="30px" height="30px">
                                                            {{$emp->name}}
                                                        @endif
                                                    @else
                                                        {{$assignName->dept->dept_name}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        @elseif($ticket->isassign==0)
                                            <a href="{{url("isassign/2")}}" class="btn btn-outline-warning">Unassigned </a> @endif
                                    </td>
                                    <td>{{$ticket->status_type->status}}</td>
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
            <!--end of Ticket tab content -->
        </div>
    </div>
        </div>
    </div>
    <script>
        //for all tickets
        $(document).ready(function() {
            $('#allticket').DataTable( {
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

            } );

        } );
        $('#casetype').on('change', function() {
            var table = $('#allticket').DataTable();
            table.column(5).search($(this).val()).draw();
        });
        $('#priority').on('change', function() {
            var table = $('#allticket').DataTable();
            table.column(6).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#min').datepicker("getDate");
                    var max = $('#max').datepicker("getDate");
                    var startDate = new Date(data[6]);
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

                    {
                        extend: 'collection',
                        text: '<i class="fa fa-download mr-2"></i>Export',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    }
                ],
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

                    {
                        extend: 'collection',
                        text: '<i class="fa fa-download mr-2"></i>Export',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    }
                ],
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

                    {
                        extend: 'collection',
                        text: '<i class="fa fa-download mr-2"></i>Export',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    }
                ],
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

                    {
                        extend: 'collection',
                        text: '<i class="fa fa-download mr-2"></i>Export',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    }
                ],
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

                    {
                        extend: 'collection',
                        text: '<i class="fa fa-download mr-2"></i>Export',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    }
                ],
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

                    {
                        extend: 'collection',
                        text: '<i class="fa fa-download mr-2"></i>Export',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    }
                ],
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
@endsection

