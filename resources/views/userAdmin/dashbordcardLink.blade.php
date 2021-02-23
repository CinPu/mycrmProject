@extends("layouts.mainlayout")
@section("title","Card Link")
@section("content")
<div class="page-wrapper">
    <div class="container-fluid">
            <div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Tickets</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                <li class="breadcrumb-item active">{{ucfirst($status)}} Tickets</li>
            </ul>
        </div>
    </div>
</div>
            <div style="overflow-x: auto">
                <table class="table">
    <thead>
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
                                @if($assignName->agent_pp!=null)
                                    <img src="{{url(asset("/profile/".$assignName->agent_pp->profile))}}" alt="" width="30px" height="30px;" class="rounded-circle">
                                    {{$assignName->agent->name}}
                                @else
                                    <img src="{{asset("assets/img/user.png")}}" alt="" width="30px" height="30px">
                                    {{$assignName->agent->name}}
                                @endif
                            @endif
                        @endforeach
                        @foreach($assign_dept_name as $dept_name)
                            @if($dept_name->ticket_id==$ticket->id)
                                <i class="fa fa-users"></i>
                                {{$dept_name->dept->dept_name}}
                            @endif
                        @endforeach
                    @elseif($ticket->isassign==0)
                        <a href="{{url("isassign/2")}}" class="btn btn-facebook">Unassigned </a> @endif
                </td>
                <td>{{$ticket->status_type->status}}</td>
                <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}">{{$ticket->priority_type->priority}}</button></td>
                {{--                                <td class="border"><img src="{{asset("/imgs/$photos[1]")}}" alt="" width="200px"height="200px"></td>--}}
                <td>
                    {{$ticket->cases->name}}
                </td>
                <td>{{$ticket->created_at->toFormattedDateString()}}</td>

            </tr>
    @endforeach
    </tbody>
</table>
            </div>
    </div>
</div>
@endsection