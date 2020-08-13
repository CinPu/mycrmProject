@extends("layouts.app")
@section("title","Assign Or Unassign Ticket")
@section("content")
    <div class="container-fluid">
    <ul class="nav nav-tabs bg-secondary" id="myTab" role="tablist">
        <li class="nav-item my-1">
            <a class="nav-link {{$unassign}}" id="home-tab" data-toggle="tab" href="#unassigned" role="tab" aria-controls="home" aria-selected="true">Unassigned Ticket</a>
        </li>
        <li class="nav-item my-1">
            <a class="nav-link {{$assign}}" id="profile-tab" data-toggle="tab" href="#assigned" role="tab" aria-controls="profile" aria-selected="false">Assigned Ticket</a>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade {{$unassign}} card col-12 col-md-12" id="unassigned" role="tabpanel" aria-labelledby="home-tab" style="overflow-x:auto;">
            <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>Unassign Tickets</h3>
            <table class="table " id="unassign">
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
                <button class="btn btn-info ml-3 "  type="button"  data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-hand-o-right mr-2" aria-hidden="true"></i>Assign
                </button>
                <tr>
                    <th scope="col">Assign/Unassign</th>
                    <th scope="col">Ticket Title</th>
                    <th scope="col">Ticket ID</th>
                    <th scope="col">Message</th>
                    <th scope="col">Status</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Category</th>
                    <th scope="col">Created at</th>
                </tr>
                </thead>
                <tbody >
                @foreach($unassign_tickets as $ticket)
                    <tr>
                        <td>
                            @if($ticket->isassign==1)<input type="checkbox" name="TicketId[]" class="mr-2" value="{{$ticket->id}}" checked>Assigned @elseif($ticket->isassign==0)<input type="checkbox" name="TicketId[]" class="mr-2" value="{{$ticket->id}}">Unassigned @endif
                        </td>
                        <td>{{$ticket->title}}</td>
                        <td>
                            <a href="{{ url("tickets/$ticket->ticket_id") }}" class="text-primary">
                                #{{ $ticket->ticket_id }}
                            </a>
                        </td>
                        <td>{!!substr($ticket->message,0,150)!!}....</td>
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
            <!-- Ticket assign Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <button  id="ajax" data-dismiss="modal" class="btn btn-primary float-right">Assigned</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade {{$assign}} card col-12 col-md-12" id="assigned" role="tabpanel" aria-labelledby="profile-tab" style="overflow-x:auto;">
            <h3 class=" text-dark"><i class="mr-3 fa fa-ticket" style="font-size:24px;color: dodgerblue"></i>Assigned Tickets</h3>
            <table class="table " id="assign">
                <div class=" col-md-12">
                    <div class="row">
                        <label class="col-md-3 ">Search By</label>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 offset-md-1 text-white">
                            <select class="custom-select"  id="assign_casetype">
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
                            <input type="text" class="form-control" id="assign_min" name="assign_min" >
                        </div>
                        <div class=" offset-md-1">
                            <span class=" mr-3 ">End Date</span>
                        </div>
                        <div class="text-white">
                            <input type="text" class="form-control" id="assign_max" name="assign_max" >
                        </div>

                    </div>
                </div>
                <thead>
                <tr>
                    <th scope="col">Assign/Unassign</th>
                    <th scope="col">Ticket Title</th>
                    <th scope="col">Ticket ID</th>
                    <th scope="col">Message</th>
                    <th scope="col">Status</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Category</th>
                    <th scope="col">Created at</th>
                </tr>
                </thead>
                <tbody >
                @foreach($assign_tickets as $ticket)
                    <tr>
                        <td>
                            @if($ticket->isassign==1)Assigned @elseif($ticket->isassign==0)<input type="checkbox" name="TicketId[]" class="mr-2" value="{{$ticket->id}}">Unassigned @endif
                        </td>
                        <td>{{$ticket->title}}</td>
                        <td>
                            <a href="{{ url("tickets/$ticket->ticket_id") }}" class="text-primary">
                                #{{ $ticket->ticket_id }}
                            </a>
                        </td>
                        <td>{!!substr($ticket->message,0,150)!!}....</td>
                        <td>{{$ticket->status}}</td>
                        <td><button type="button" class="btn btn-{{$ticket->priority_type->color}}"></button>{{$ticket->priority_type->priority}}</td>
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
@section("scriptcode")
    <script>
        $(document).ready(function () {
            $("#type").change(function () {
                var val = $(this).val();
                if (val == "dept") {
                    $("#size").html("@foreach($depts as $dept)<option value='{{$dept->id}}'>{{$dept->dept_name}}</option> @endforeach");
                } else if (val == "agent") {
                    $("#size").html("@foreach($agents as $agent)<option value='{{$agent->user->id}}'>{{$agent->user->name}}</option>@endforeach");
                }
            });
        });
    </script>
    <script>
        // $('#select-all').click(function(event) {
        //     if(this.checked) {
        //         // Iterate each checkbox
        //         $(':checkbox').each(function() {
        //             this.checked = true;
        //         });
        //     } else {
        //         $(':checkbox').each(function() {
        //             this.checked = false;
        //         });
        //     }
        // });
        $(document).ready(function() {
            $(document).on('click', '#ajax', function () {
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
                        console.log(data);
                        window.location.reload()
                        md.showNotification("bottom", "center","Assigned Successful","info");
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#unassign').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],

            } );

        } );
        $('#casetype').on('change', function() {
            var table = $('#unassign').DataTable();
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
            var table = $('#unassign').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').change(function () {
                table.draw();
            });
        });

        //assign ticket
        $(document).ready(function() {
            $('#assign').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],

            } );

        } );
        $('#assign_casetype').on('change', function() {
            var table = $('#assign').DataTable();
            table.column(6).search($(this).val()).draw();
        });
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#assign_min').datepicker("getDate");
                    var max = $('#assign_max').datepicker("getDate");
                    var startDate = new Date(data[7]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#assign_min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#assign_max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#assign').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#assign_min, #assign_max').change(function () {
                table.draw();
            });
        });
    </script>
@endsection