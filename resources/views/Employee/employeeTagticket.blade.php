@extends("layouts.mainlayout")
@section("title","Tags Tickets")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <a href="{{url("ticket/create/".$admin_uuid->admin->uuid)}}" class="btn add-btn"><i class="fa fa-plus"></i> Add Ticket</a>
                        <h3 class="page-title">{{\Illuminate\Support\Facades\Auth::user()->name}} Tags Ticket</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Ticket</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="card">
                <table class="table">
           <thead>
           <tr>
               <th>Ticket ID</th>
               <th>Ticket Title</th>
               <th>Priority</th>
               <th>Status</th>
               <th>Case Type</th>
               <th>Created Date</th>
           </tr>
           </thead>
           <tbody>
           @foreach($follow_tickets as $ticket)
           <tr>
               <th>
               <a href="{{ url("tickets/$ticket->ticket_id") }}" class="text-primary">
                   #{{ $ticket->ticket_id }}
               </a>
               </th>
               <th>{{$ticket->title}}</th>
               <th>{{$ticket->priority_type->priority}}</th>
               <th>{{$ticket->status_type->status}}</th>
               <th>{{$ticket->cases->name}}</th>
               <th>{{$ticket->created_at}}</th>
           </tr>
           @endforeach
           </tbody>
       </table>
            </div>
        </div>
   </div>
    @endsection