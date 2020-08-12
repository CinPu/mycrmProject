@extends("layouts.app")
@section("title","Agent Detail")
@section("content")
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Overview</h4>
                </div>
                <div class="card-body">
{{--                    <ul class="nav nav-tabs bg-primary" id="nav-tab" role="tablist">--}}
{{--                        <li class="nav-item active my-1" role="presentation">--}}
{{--                            <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-summary" role="presentation" aria-controls="nav-home" aria-selected="true">Overview</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item my-1" role="presentation">--}}
{{--                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-assignByname" role="tab" aria-controls="nav-profile" aria-selected="false">Assign By Name</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item my-1" role="presentation">--}}
{{--                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-assignBydept" role="tab" aria-controls="nav-contact" aria-selected="false">Assign With Department</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item my-1" role="presentation">--}}
{{--                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-created" role="tab" aria-controls="nav-contact" aria-selected="false">Created Ticket</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
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
{{--                        <div class="tab-pane fade my-3" id="nav-assignByname" role="tabpanel" aria-labelledby="nav-profile-tab">--}}
{{--                            <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>Assign By Name</h3>--}}
{{--                            <table class="table" id="assign_by_name">--}}
{{--                                <div class=" col-md-12">--}}
{{--                                        <label>Search By</label>--}}
{{--                                    <div class=" mb-3">--}}
{{--                                        <div class="col-md-5  text-white">--}}
{{--                                            <select class="custom-select"  id="byname_casetype">--}}
{{--                                                <option value=""> All</option>--}}
{{--                                                @foreach($allcases as $case)--}}
{{--                                                    <option value="{{$case->name}}"> {{$case->name}} </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="row my-3">--}}
{{--                                            <label class="mr-3">Start Date</label>--}}
{{--                                        <div class="text-white">--}}
{{--                                            <input type="text" class="form-control" id="byname_min" name="byname_min" >--}}
{{--                                        </div>--}}
{{--                                            <label class=" mr-3">End Date</label>--}}
{{--                                        <div class="text-white">--}}
{{--                                            <input type="text" class="form-control" id="byname_max" name="byname_max" >--}}
{{--                                        </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">Title</th>--}}
{{--                                    <th scope="col">Ticket ID</th>--}}
{{--                                    <th scope="col">Status</th>--}}
{{--                                    <th scope="col">Priority</th>--}}
{{--                                    <th scope="col">Case Type</th>--}}
{{--                                    <th scope="col">Assigned Date</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}

{{--                                @foreach($assigntickets as $aticket)--}}
{{--                                    <tr>--}}
{{--                                        <th scope="row">{{$aticket->ticket->title}}</th>--}}
{{--                                        <td>--}}
{{--                                            <a href="{{ url('tickets/'.$aticket->ticket->ticket_id) }}">--}}
{{--                                                {{ $aticket->ticket->ticket_id }}--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
{{--                                        <td>{{$aticket->ticket->status}}</td>--}}
{{--                                        <td>--}}
{{--                                            <a class="btn btn-{{$aticket->ticket->priority_type->color}} text-white">{{$aticket->ticket->priority_type->priority}}</a>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            @foreach($allcases as $case)--}}
{{--                                                @if($aticket->ticket->case_type==$case->id)--}}
{{--                                                    {{$case->name}}--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                        </td>--}}
{{--                                        <td>{{$aticket->created_at->toFormattedDateString()}}</td>--}}

{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane fade my-3" id="nav-assignBydept" role="tabpanel" aria-labelledby="nav-contact-tab">--}}
{{--                            <table class="table" id="assign_by_dept">--}}
{{--                                <thead>--}}
{{--                                <div class=" col-md-12">--}}
{{--                                    <label>Search By</label>--}}
{{--                                    <div class=" mb-3">--}}
{{--                                        <div class="col-md-5  text-white">--}}
{{--                                            <select class="custom-select"  id="dept_casetype">--}}
{{--                                                <option value=""> All</option>--}}
{{--                                                @foreach($allcases as $case)--}}
{{--                                                    <option value="{{$case->name}}"> {{$case->name}} </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="row my-3">--}}
{{--                                            <label class="mr-3">Start Date</label>--}}
{{--                                            <div class="text-white">--}}
{{--                                                <input type="text" class="form-control" id="bydept_min" name="bydept_min" >--}}
{{--                                            </div>--}}
{{--                                            <label class=" mr-3">End Date</label>--}}
{{--                                            <div class="text-white">--}}
{{--                                                <input type="text" class="form-control" id="bydept_max" name="bydept_max" >--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col" class="border">Title</th>--}}
{{--                                    <th scope="col" class="border">Ticket ID</th>--}}
{{--                                    <th scope="col" class="border">Message</th>--}}
{{--                                    <th scope="col" class="border">Status</th>--}}
{{--                                    <th scope="col" class="border">Priority</th>--}}
{{--                                    <th scope="col" class="border">Category</th>--}}
{{--                                    <th scope="col" class="border">Last Updated</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                --}}{{--@dd($assignwithDepts)--}}
{{--                                @foreach($assigndepts as $assignwithdept)--}}
{{--                                    <tr>--}}
{{--                                        <th scope="row" class="border">{{$assignwithdept->ticket->title}}</th>--}}
{{--                                        <td class="border">--}}
{{--                                            <a href="{{ url('tickets/'.$assignwithdept->ticket->ticket_id) }}">--}}
{{--                                                {{ $assignwithdept->ticket->ticket_id }}--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
{{--                                        <td class="border">{!!$assignwithdept->ticket->message!!}</td>--}}
{{--                                        <td class="border">{{$assignwithdept->ticket->status}}</td>--}}
{{--                                        <td class="border">{{$assignwithdept->ticket->priority_type->priority}}</td>--}}
{{--                                        <td class="border">--}}
{{--                                            @foreach($complaint_type as $case)--}}
{{--                                                @if($assignwithdept->ticket->complain_type==$case->id)--}}
{{--                                                    {{$case->name}}--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                        </td>--}}
{{--                                        <td class="border">{{$assignwithdept->ticket->created_at->toFormattedDateString()}}</td>--}}

{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane fade my-3" id="nav-created" role="tabpanel" aria-labelledby="nav-contact-tab">--}}
{{--                            <table class="table border my-3" id="created_ticket">--}}
{{--                                <thead>--}}
{{--                                <div class=" col-md-12">--}}
{{--                                    <label>Search By</label>--}}
{{--                                    <div class=" mb-3">--}}
{{--                                        <div class="col-md-5  text-white">--}}
{{--                                            <select class="custom-select"  id="created_casetype">--}}
{{--                                                <option value=""> All</option>--}}
{{--                                                @foreach($allcases as $case)--}}
{{--                                                    <option value="{{$case->name}}"> {{$case->name}} </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <div class="row my-3">--}}
{{--                                            <label class="mr-3">Start Date</label>--}}
{{--                                            <div class="text-white">--}}
{{--                                                <input type="text" class="form-control" id="created_min" name="created_min" >--}}
{{--                                            </div>--}}
{{--                                            <label class=" mr-3">End Date</label>--}}
{{--                                            <div class="text-white">--}}
{{--                                                <input type="text" class="form-control" id="created_max" name="created_max" >--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col" class="border">Title</th>--}}
{{--                                    <th scope="col" class="border">Ticket ID</th>--}}
{{--                                    <th scope="col" class="border">Message</th>--}}
{{--                                    <th scope="col" class="border">Status</th>--}}
{{--                                    <th scope="col" class="border">Priority</th>--}}
{{--                                    <th scope="col" class="border">Category</th>--}}
{{--                                    <th scope="col" class="border">Last Updated</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}

{{--                                @foreach($agenttickets as $ticket)--}}
{{--                                    <tr>--}}
{{--                                        <th scope="row" class="border">{{$ticket->title}}</th>--}}
{{--                                        <td class="border">--}}
{{--                                            <a href="{{ url("tickets/$ticket->ticket_id") }}">--}}
{{--                                                #{{ $ticket->ticket_id }}--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
{{--                                        <td class="border">{!!$ticket->message!!}</td>--}}
{{--                                        <td class="border">{{$ticket->status}}</td>--}}
{{--                                        <td class="border">{{$ticket->priority_type->priority}}</td>--}}

{{--                                        <td class="border">--}}
{{--                                            {{$ticket->cases->name}}--}}
{{--                                        </td>--}}
{{--                                        <td class="border">{{$ticket->created_at->toFormattedDateString()}}</td>--}}

{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
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
@endsection
{{--@section("scriptcode")--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('#assign_by_name').DataTable( {--}}
{{--                dom: 'Bfrtip',--}}
{{--                buttons: [--}}
{{--                    'copy', 'csv', 'excel', 'pdf', 'print'--}}
{{--                ]--}}
{{--            } );--}}
{{--        } );--}}
{{--        $('#byname_casetype').on('change', function() {--}}
{{--            var table = $('#assign_by_name').DataTable();--}}
{{--            table.column(4).search($(this).val()).draw();--}}
{{--        });--}}
{{--        $(document).ready(function(){--}}
{{--            $.fn.dataTable.ext.search.push(--}}
{{--                function (settings, data, dataIndex) {--}}
{{--                    var min = $('#byname_min').datepicker("getDate");--}}
{{--                    var max = $('#byname_max').datepicker("getDate");--}}
{{--                    var startDate = new Date(data[5]);--}}
{{--                    if (min == null && max == null) { return true; }--}}
{{--                    if (min == null && startDate <= max) { return true;}--}}
{{--                    if(max == null && startDate >= min) {return true;}--}}
{{--                    if (startDate <= max && startDate >= min) { return true; }--}}
{{--                    return false;--}}
{{--                }--}}
{{--            );--}}

{{--            $("#byname_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });--}}
{{--            $("#byname_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });--}}
{{--            var table = $('#assign_by_name').DataTable();--}}
{{--            // Event listener to the two range filtering inputs to redraw on input--}}
{{--            $('#byname_min, #byname_max').change(function () {--}}
{{--                table.draw();--}}
{{--            });--}}
{{--        });--}}
{{--        //dept assign--}}
{{--        $(document).ready(function() {--}}
{{--            $('#assig_by_dept').DataTable( {--}}
{{--                dom: 'Bfrtip',--}}
{{--                buttons: [--}}
{{--                    'copy', 'csv', 'excel', 'pdf', 'print'--}}
{{--                ]--}}
{{--            } );--}}
{{--        } );--}}
{{--        $('#dept_casetype').on('change', function() {--}}
{{--            var table = $("#assign_by_dept").DataTable();--}}
{{--            table.column(5).search($(this).val()).draw();--}}
{{--        });--}}
{{--        $(document).ready(function(){--}}
{{--            $.fn.dataTable.ext.search.push(--}}
{{--                function (settings, data, dataIndex) {--}}
{{--                    var min = $('#bydept_min').datepicker("getDate");--}}
{{--                    var max = $('#bydept_max').datepicker("getDate");--}}
{{--                    var startDate = new Date(data[6]);--}}
{{--                    if (min == null && max == null) { return true; }--}}
{{--                    if (min == null && startDate <= max) { return true;}--}}
{{--                    if(max == null && startDate >= min) {return true;}--}}
{{--                    if (startDate <= max && startDate >= min) { return true; }--}}
{{--                    return false;--}}
{{--                }--}}
{{--            );--}}

{{--            $("#bydept_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });--}}
{{--            $("#bydept_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });--}}
{{--            var table = $('#assign_by_dept').DataTable();--}}
{{--            // Event listener to the two range filtering inputs to redraw on input--}}
{{--            $('#bydept_min, #bydept_max').change(function () {--}}
{{--                table.draw();--}}
{{--            });--}}
{{--        });--}}
{{--        //created_tickets--}}
{{--        $(document).ready(function() {--}}
{{--            $('#created_ticket').DataTable( {--}}
{{--                dom: 'Bfrtip',--}}
{{--                buttons: [--}}
{{--                    'copy', 'csv', 'excel', 'pdf', 'print'--}}
{{--                ]--}}
{{--            } );--}}
{{--        } );--}}
{{--        $('#created_casetype').on('change', function() {--}}
{{--            var table = $("#created_ticket").DataTable();--}}
{{--            table.column(5).search($(this).val()).draw();--}}
{{--        });--}}
{{--        $(document).ready(function(){--}}
{{--            $.fn.dataTable.ext.search.push(--}}
{{--                function (settings, data, dataIndex) {--}}
{{--                    var min = $('#created_min').datepicker("getDate");--}}
{{--                    var max = $('#created_max').datepicker("getDate");--}}
{{--                    var startDate = new Date(data[6]);--}}
{{--                    if (min == null && max == null) { return true; }--}}
{{--                    if (min == null && startDate <= max) { return true;}--}}
{{--                    if(max == null && startDate >= min) {return true;}--}}
{{--                    if (startDate <= max && startDate >= min) { return true; }--}}
{{--                    return false;--}}
{{--                }--}}
{{--            );--}}

{{--            $("#created_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });--}}
{{--            $("#created_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });--}}
{{--            var table = $('#created_ticket').DataTable();--}}
{{--            // Event listener to the two range filtering inputs to redraw on input--}}
{{--            $('#created_min, #created_max').change(function () {--}}
{{--                table.draw();--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}