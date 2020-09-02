@extends("layouts.app")
@section("title","Agent Detail")
@section("csscode")
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
@endsection
@section("content")

    <div style="width:300px;height:300px" class="offset-md-4">
        <canvas id="timespend"></canvas>
    </div>

    <div class="row">
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
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="javascript:;">
                        <img class="img" src="{{url("assets/img/agentpp.png")}}" />
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-category text-gray">Agent</h6>
                    <h4 class="card-title">{{$agentuser->name}}</h4>
                    <h5 class="card-title"><i class="fa fa-envelope"></i> {{$agentuser->email}}</h5>
                    <p class="card-description">
                      <i class="fa fa-users"></i>  {{$agent->dept->dept_name}}
                    </p>
                    <a href="javascript:;" class="btn btn-primary btn-round">Follow</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
    <ul class="nav nav-tabs bg-primary" id="myTab" role="tablist">
        <li class="nav-item my-1">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Created Ticket</a>
        </li>
        <li class="nav-item my-1">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Assign By Name </a>
        </li>
        <li class="nav-item my-1">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Assign By Department</a>
        </li>
    </ul>

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
                            <div class="col-md-3 offset-md-1">
                                <select class="custom-select"  id="created_casetype">
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
                                <input type="text" class="form-control" id="created_min" name="created_min" >
                            </div>
                            <div class=" offset-md-1">
                                <span class=" mr-3 ">End Date</span>
                            </div>
                            <div class="text-white">
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
                                <td>{{$ticket->status}}</td>
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
                            <td>{{$ticket->status}}</td>
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
                            <td>{{$ticket->status}}</td>
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
@endsection
@section("scriptcode")
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
    </script>
@endsection