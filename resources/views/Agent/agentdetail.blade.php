@extends("layouts.mainlayout")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Agent Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{url("/agent")}}">Agent</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div style="width:300px;height:300px" class="offset-md-4">
        <canvas id="timespend"></canvas>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card ">

                    {{--                    <a href="javascript:;">--}}
                    @if($profile_picture==null)
                        <img class="offset-md-3 mt-4" src="{{url("assets/img/agentpp.png")}}" width="100px;" height="100px;">
                    @else
                        <img class="offset-md-3 rounded-circle mt-4" src="{{url(asset("profile/$profile_picture->profile"))}} " style="width: 150px" height="150px;" />
                        {{--                            <img class=" rounded-circle" src="{{url(asset("profile/$profile_picture->profile"))}}" />--}}
                    @endif
                    {{--                    </a>--}}
                <div class="card-body text-center">
                    <h5 class="card-category text-gray">Agent</h5>
                    <h4 class="card-title">{{$agentuser->name}}</h4>
                    <strong class="card-title"><i class="fa fa-envelope"></i> {{$agentuser->email}}</strong><br>
                    <strong class="card-description">
                        <i class="fa fa-users"></i>  {{$agent->dept->dept_name}}
                    </strong><br>
                    <a href="javascript:;" class="btn btn-primary btn-round mt-2">Follow</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Overview</h4>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-summary" role="presentation" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="card col-md-5 my-3 ml-4">
                                    <div class="mt-3">
                                        <label><i class="fa fa-ticket mr-3"></i>New Ticket</label>@if($new>0)<span class="badge bg-danger float-right">{{$new}}</span>@else <span class="badge bg-primary float-right">{{$new}}</span>@endif
                                    </div>
                                    <div >
                                        <label><i class="fa fa-ticket mr-3"></i>Open Ticket</label><span class="badge bg-primary float-right">{{$openticket}}</span>
                                    </div>
                                    <div>
                                        <label><i class="fa fa-ticket mr-3"></i>Pending Ticket</label><span class="badge bg-primary float-right">{{$pending}}</span>
                                    </div>
                                    <div>
                                        <label><i class="fa fa-ticket mr-3"></i>Progress Ticket</label><span class="badge bg-primary float-right">{{$progress}}</span>
                                    </div>
                                    <div>
                                        <label><i class="fa fa-ticket mr-3"></i>Complete Ticket</label><span class="badge bg-primary float-right">{{$complete}}</span>
                                    </div>
                                    <div>
                                        <label><i class="fa fa-ticket mr-3 mb-3"></i>Closed Ticket</label><span class="badge bg-primary float-right">{{$closeticket}}</span>
                                    </div>
                                </div>
                                <div class="card col-md-5 my-3 offset-1">
                                    @php
                                        $assign=count($assigntickets);
                                        $created=count($agenttickets);
                                        $assgndept=count($assigndepts);
                                    @endphp
                                    <div class="mt-3 mb-2">
                                        <label><i class="fa fa-ticket mr-3"></i> Created ticket</label><span class="badge bg-primary float-right">{{$created}}</span>
                                    </div>
                                    <div class="my-2">
                                        <label><i class="fa fa-ticket mr-3"></i> Assign By Name</label><span class="badge bg-primary float-right">{{$assign}}</span>
                                    </div>
                                    <div class="my-2">
                                        <label class=""><i class="fa fa-ticket mr-3"></i>Assign By Department</label><span class="badge bg-primary float-right">{{$assgndept}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Created Ticket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Assign By Name </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Assign By Department</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#ot_spend" role="tab" aria-controls="contact" aria-selected="false">Over Time Spend</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active col-md-12 col-12" id="home" role="tabpanel" aria-labelledby="home-tab" style="overflow-x:auto;">
                <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>Created Tickets</h3>
                <table class="table" id="created_ticket">
                    <thead>
                    <div class=" col-md-12">
                        <div class="row">
                            <label class="col-md-3 ">Search By</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-1 mt-2">
                                <select class="form-control"  id="created_casetype">
                                    <option value=""> All</option>
                                    @foreach($allcases as $case)
                                        <option value="{{$case->name}}"> {{$case->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="offset-md-0 mt-3">
                                <label class="mr-2">Start Date</label>
                            </div>
                            <div class="mt-2">
                                <input type="text" class="form-control" id="created_min" name="created_min" >
                            </div>
                            <div class=" offset-md-1 offset-0 mt-3">
                                <span class=" mr-3 ">End Date</span>
                            </div>
                            <div class="text-white mt-2">
                                <input type="text" class="form-control" id="created_max" name="created_max" >
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
                    @foreach($agenttickets as $ticket)
                        <tr>
                            <th scope="row">{{$ticket->title}}</th>
                            <td>
                                <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                    #{{ $ticket->ticket_id }}
                                </a>
                            </td>
                            <td>{!!substr($ticket->message,0,150)!!}...</td>
                            <td>{{$ticket->status_type->status}}</td>
                            <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}">{{$ticket->priority_type->priority}}</button></td>
                            {{--                                <td class="border"><img src="{{asset("/imgs/$photos[1]")}}" alt="" width="200px"height="200px"></td>--}}
                            <td>{{$ticket->cases->name}}</td>
                            <td>{{$ticket->created_at->toFormattedDateString()}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade col-md-12 col-12" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="overflow-x:auto;">
                <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>Assign By Name Tickets</h3>
                <table class="table" id="assign_by_name">
                    <thead>
                    <div class=" col-md-12">
                        <div class="row">
                            <label class="col-md-3 ">Search By</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-1">
                                <select class="custom-select"  id="byname_casetype">
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
                                <input type="text" class="form-control" id="byname_min" name="byname_min" >
                            </div>
                            <div class=" offset-md-1">
                                <span class=" mr-3 ">End Date</span>
                            </div>
                            <div class="text-white">
                                <input type="text" class="form-control" id="byname_max" name="byname_max" >
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
                    @foreach($assigntickets as $ticket)
                        <tr>
                            <th scope="row">{{$ticket->title}}</th>
                            <td>
                                <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                    #{{ $ticket->ticket_id }}
                                </a>
                            </td>
                            <td>{!!substr($ticket->message,0,150)!!}...</td>
                            <td>{{$ticket->status_type->status}}</td>
                            <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}">{{$ticket->priority_type->priority}}</button></td>
                            {{--                                <td class="border"><img src="{{asset("/imgs/$photos[1]")}}" alt="" width="200px"height="200px"></td>--}}
                            <td>{{$ticket->cases->name}}</td>
                            <td>{{$ticket->created_at->toFormattedDateString()}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade col-12 col-md-12" id="contact" role="tabpanel" aria-labelledby="contact-tab" style="overflow-x:auto;">
                <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>Assign By Department Tickets</h3>
                <table class="table" id="assign_by_dept">
                    <thead>
                    <div class=" col-md-12">
                        <div class="row">
                            <label class="col-md-3 ">Search By</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-1">
                                <select class="custom-select"  id="dept_casetype">
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
                                <input type="text" class="form-control" id="bydept_min" name="bydept_min" >
                            </div>
                            <div class=" offset-md-1">
                                <span class=" mr-3 ">End Date</span>
                            </div>
                            <div class="text-white">
                                <input type="text" class="form-control" id="bydept_max" name="bydept_max" >
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
                    @foreach($assigndepts as $ticket)
                        <tr>
                            <th scope="row">{{$ticket->title}}</th>
                            <td>
                                <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                    #{{ $ticket->ticket_id }}
                                </a>
                            </td>
                            <td>{!!substr($ticket->message,0,150)!!}...</td>
                            <td>{{$ticket->status_type->status}}</td>
                            <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}">{{$ticket->priority_type->priority}}</button></td>
                            {{--                                <td class="border"><img src="{{asset("/imgs/$photos[1]")}}" alt="" width="200px"height="200px"></td>--}}
                            <td>{{$ticket->cases->name}}</td>
                            <td>{{$ticket->created_at->toFormattedDateString()}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade col-12 col-md-12" id="ot_spend" role="tabpanel" aria-labelledby="contact-tab" style="overflow-x:auto;">
                <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>Assign By Department Tickets</h3>
                <table class="table" id="overtime_spend">
                    <thead>
                    <div class=" col-md-12">
                        <div class="row">
                            <label class="col-md-3 ">Search By</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-1">
                                <select class="custom-select"  id="ot_casetype">
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
                                <input type="text" class="form-control" id="ot_min" name="ot_min" >
                            </div>
                            <div class=" offset-md-1">
                                <span class=" mr-3 ">End Date</span>
                            </div>
                            <div class="text-white">
                                <input type="text" class="form-control" id="ot_max" name="ot_max" >
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
                    @foreach($overtimeuse_ticket as $ticket)
                        <tr>
                            <th scope="row">{{$ticket->title}}</th>
                            <td>
                                <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                    #{{ $ticket->ticket_id }}
                                </a>
                            </td>
                            <td>{!!substr($ticket->message,0,150)!!}...</td>
                            <td>{{$ticket->status_type->status}}</td>
                            <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}">{{$ticket->priority_type->priority}}</button></td>
                            {{--                                <td class="border"><img src="{{asset("/imgs/$photos[1]")}}" alt="" width="200px"height="200px"></td>--}}
                            <td>{{$ticket->cases->name}}</td>
                            <td>{{$ticket->created_at->toFormattedDateString()}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            var ctx = document.getElementById("timespend").getContext('2d');
            var data = {
                datasets: [{
                    data: [
                        {{$twenty_fivepercent}},
                        {{$fifty_percent}},
                        {{$seventy_fivepercent}},
                        {{$hundred_percent}},
                        {{$overtimeuse}}
                    ],
                    backgroundColor: [
                        '#ef0636',
                        '#9605a0',
                        '#4642ea',
                        "#6fe00b",
                        "#000"
                    ],
                }],
                labels: [
                    '25%',
                    '50%',
                    '75%',
                    '100%',
                    "OverTime"
                ]
            };
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    title: {
                        display: true,
                        text: "Solved Time Spend for each ticket"
                    },
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 15
                        }
                    }
                }
            });
        });

        $(document).ready(function() {
            $('#assign_by_name').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
        $('#byname_casetype').on('change', function() {
            var table = $('#assign_by_name').DataTable();
            table.column(5).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#byname_min').datepicker("getDate");
                    var max = $('#byname_max').datepicker("getDate");
                    var startDate = new Date(data[6]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#byname_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#byname_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#assign_by_name').DataTable();
            // Event listener to the two range filtering inputs to redraw on input
            $('#byname_min, #byname_max').change(function () {
                table.draw();
            });
        });
        //dept assign
        $(document).ready(function() {
            $('#assign_by_dept').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
        $('#dept_casetype').on('change', function() {
            var table = $("#assign_by_dept").DataTable();
            table.column(5).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#bydept_min').datepicker("getDate");
                    var max = $('#bydept_max').datepicker("getDate");
                    var startDate = new Date(data[6]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#bydept_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#bydept_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#assign_by_dept').DataTable();
            // Event listener to the two range filtering inputs to redraw on input
            $('#bydept_min, #bydept_max').change(function () {
                table.draw();
            });
        });
        //created_tickets
        $(document).ready(function() {
            $('#created_ticket').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
        $('#created_casetype').on('change', function() {
            var table = $("#created_ticket").DataTable();
            table.column(5).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#created_min').datepicker("getDate");
                    var max = $('#created_max').datepicker("getDate");
                    var startDate = new Date(data[6]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#created_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#created_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#created_ticket').DataTable();
            // Event listener to the two range filtering inputs to redraw on input
            $('#created_min, #created_max').change(function () {
                table.draw();
            });
        });
        //over time spend
        $(document).ready(function() {
            $('#overtime_spend').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
        $('#ot_casetype').on('change', function() {
            var table = $("#overtime_spend").DataTable();
            table.column(5).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#ot_min').datepicker("getDate");
                    var max = $('#ot_max').datepicker("getDate");
                    var startDate = new Date(data[6]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#ot_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#ot_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#overtime_spend').DataTable();
            // Event listener to the two range filtering inputs to redraw on input
            $('#ot_min, #ot_max').change(function () {
                table.draw();
            });
        });
    </script>
        </div>
    </div>
@endsection