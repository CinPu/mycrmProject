@extends("layouts.app")
@section("title","Ticket")
@section("csscode")
    <style>
        #select-all,#label_selectall{
            position: relative;
            top: 60px;
            }
    </style>
@endsection
@section("content")
    <div class="card my-3">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item  ml-2 my-2">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="presentation" aria-controls="pills-home" aria-selected="true">My Created Ticket
                    <span class="badge badge-danger">{{$noOfmyticket}}</span>
                </a>
            </li>
            <li class="nav-item my-2">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Assigned Ticket
                    <span class="badge badge-pill badge-danger ">{{$noOfassign}}</span>
                </a>
            </li>
            <li class="nav-item my-2">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#assigndept" role="tab" aria-controls="pills-profile" aria-selected="false">Assigned With Department
                    <span class="badge badge-pill badge-danger ">{{$noOfassign_withdept}}</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="card">
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active col-md-12 " id="pills-home" role="presentation" aria-labelledby="pills-home-tab">
            <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>My Ticket</h3>
                <table class="table col-12 col-md-12 " id="myticket">
                    <thead>
                    <div class=" col-md-12">
                        <div class="row">
                            <label class="col-md-3 ">Search By</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-1  col-sm-3 text-white">
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
                                <input type="text" class="form-control" id="myticket_min" name="myticket_min" >
                            </div>
                            <div class=" offset-md-1">
                                <span class=" mr-3 ">End Date</span>
                            </div>
                            <div class="text-white">
                                <input type="text" class="form-control" id="myticket_max" name="myticket_max" >
                            </div>

                        </div>
                    </div>
                    <button class="btn btn-info ml-3 "  type="button"  data-toggle="modal" data-target="#assign">
                        <i class="fa fa-hand-o-right mr-2" aria-hidden="true"></i>Assign
                    </button>
                    <tr>
                        <th scope="col">Assign/Unassign</th>
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
                        <tr>
                            <td>
                                @if($ticket->isassign==1)<input type="checkbox" name="TicketId[]" class="mr-2" value="{{$ticket->id}}" checked>Assigned @elseif($ticket->isassign==0)<input type="checkbox" name="TicketId[]" class="mr-2" value="{{$ticket->id}}">Unassigned @endif
                            </td>
                            <td>{{$ticket->title}}</td>
                            <td>
                                <a href="{{ url("tickets/$ticket->ticket_id") }}">
                                    #{{ $ticket->ticket_id }}
                                </a>
                            </td>
                            <td>{!!$ticket->message!!}</td>
                            <td>{{$ticket->status}}</td>
                            <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}">{{$ticket->priority_type->priority}}</button></td>
                            <td>
                               {{$ticket->cases->name}}
                            </td>
                            <td>{{$ticket->created_at->toFormattedDateString()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            <!-- Modal -->
            <div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Assign Ticket</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="type">Assign Type :</label>
                                <select class="form-control col-md-6 offset-md-2" id="type" name="assignType">
                                    <option value="item0">Choose Assign Type</option>
                                    <option value="dept">Assign To Department</option>
                                    <option value="agent">Assign To Agent</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="size">Assign To :</label>
                                <select class="form-control col-md-6 offset-md-2" name="assign_id" id="size">
                                    <option></option>
                                </select>
                            </div>
                            <button  id="btn_assign" data-dismiss="modal" class="btn btn-primary float-right">Assigned</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade col-md-12" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>Assign Tickets</h3>
            <table class="table" id="assignticket">
                <thead>
                <div class=" col-md-12">
                    <div class="row">
                        <label class="col-md-3 ">Search By</label>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 offset-md-1 text-white">
                            <select class="custom-select"  id="assignticket_casetype">
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
                            <input type="text" class="form-control" id="assignticket_min" name="assignticket_min" >
                        </div>
                        <div class=" offset-md-1">
                            <span class=" mr-3 ">End Date</span>
                        </div>
                        <div class="text-white">
                            <input type="text" class="form-control" id="assignticket_max" name="assignticket_max" >
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

                <tbody>
                @foreach($assignticket as $aticket)
                    <tr>
                        <th scope="row" >{{$aticket->title}}</th>
                        <td >
                            <a href="{{ url('tickets/'.$aticket->ticket_id) }}">
                                {{ $aticket->ticket_id }}
                            </a>
                        </td>
                        <td>{!!$aticket->message!!}</td>
                        <td >{{$aticket->status}}</td>
                        <td ><button type="button" class="btn btn-{{$aticket->priority_type->color}}">{{$aticket->priority_type->priority}}</button></td>
                        <td >
                            {{$aticket->cases->name}}
                        </td>
                        <td >{{$aticket->created_at->toFormattedDateString()}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade col-md-12" id="assigndept" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div>
                <h4 class="ml-5 mt-5">Asigned With Dept</h4>
                <table class="table" id="dept">
                    <thead>
                    <div class=" col-md-12">
                        <div class="row">
                            <label class="col-md-3 ">Search By</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-1 text-white">
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
                            <div class="text-white">
                                <input type="text" class="form-control" id="dept_min" name="dept_min" >
                            </div>
                            <div class=" offset-md-1">
                                <span class=" mr-3 ">End Date</span>
                            </div>
                            <div class="text-white">
                                <input type="text" class="form-control" id="dept_max" name="dept_max" >
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
                    @foreach($assingwithDepts as $assignwithdept)
                        <tr>
                            <th scope="row">{{$assignwithdept->ticket->title}}</th>
                            <td>
                                <a href="{{ url('tickets/'.$assignwithdept->ticket->ticket_id) }}">
                                    {{ $assignwithdept->ticket->ticket_id }}
                                </a>
                            </td>
                            <td>{!!$assignwithdept->ticket->message!!}</td>
                            <td>{{$assignwithdept->ticket->status}}</td>
                            <td><button type="button" class="btn btn-{{$assignwithdept->ticket->priority_type->color}}">{{$assignwithdept->ticket->priority_type->priority}}</button></td>
                            <td>
                                {{$assignwithdept->ticket->cases->name}}
                            </td>
                            <td>{{$assignwithdept->ticket->created_at->toFormattedDateString()}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
        <script>
            $(document).ready(function() {
                $(document).on('click', '#btn_assign', function () {
                    var ticket_id = new Array();
                    $("input:checked").each(function () {
                        //console.log($(this).val()); //works fine
                        ticket_id.push($(this).val());
                    });
                    var assign_type=$( "#type option:selected" ).val();
                    var assign_name=$( "#size option:selected" ).val();

                    $.ajax({
                        type:'POST',
                        data : {ticket_id:ticket_id,assignType:assign_type,assign_id:assign_name},
                        url:'/assign',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success:function(data){
                            window.location.reload()
                            md.showNotification("bottom", "center","Assigned Successful","info");
                        }
                    });
                });
            });
        </script>
    <script>
        $(document).ready(function () {
            $("#type").change(function () {
                var val = $(this).val();
                if (val == "dept") {
                    $("#size").html("@foreach($depts as $dept)<option value='{{$dept->id}}'>{{$dept->dept_name}}</option> @endforeach");
                } else if (val == "agent") {
                    $("#size").html(" @if(Auth::user()->hasAnyRole('Admin')) @foreach($admin_agents as $agent) @if($agent->user->uuid!=$ticket->user_id)<option value='{{$agent->user->id}}'>{{$agent->user->name}}</option> @endif @endforeach @elseif(Auth::user()->hasAnyRole('Agent'))@foreach($admin_agents as $agent)@if($agent->user->uuid!=Auth::user()->uuid)<option value='{{$agent->user->id}}'>{{$agent->user->name}}</option> @endif @endforeach @endif");
                }
            });
        });
        $(document).ready(function() {
            $('#myticket').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
        $('#casetype').on('change', function() {
            var table = $('#myticket').DataTable();
            table.column(6).search($(this).val()).draw();
            console.log(table);
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#myticket_min').datepicker("getDate");
                    var max = $('#myticket_max').datepicker("getDate");
                    // console.log(data);
                    var startDate = new Date(data[7]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#myticket_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#myticket_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#myticket').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#myticket_min, #myticket_max').change(function () {
                table.draw();
            });
        });

        $(document).ready(function() {
            $('#assignticket').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
        $('#assignticket_casetype').on('change', function() {
            var table = $('#assignticket').DataTable();
            table.column(5).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#assignticket_min').datepicker("getDate");
                    var max = $('#assignticket_max').datepicker("getDate");
                    console.log(data);
                    var startDate = new Date(data[6]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#assignticket_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#assignticket_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#assignticket').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#assignticket_min, #assignticket_max').change(function () {
                table.draw();
            });
        });

        $(document).ready(function() {
            $('#dept').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
        $('#dept_casetype').on('change', function() {
            var table = $('#dept').DataTable();
            table.column(5).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#dept_min').datepicker("getDate");
                    var max = $('#dept_max').datepicker("getDate");
                    console.log(data);
                    var startDate = new Date(data[6]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#dept_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#dept_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#dept').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#dept_min, #dept_max').change(function () {
                table.draw();
            });
        });
    </script>
@endsection
