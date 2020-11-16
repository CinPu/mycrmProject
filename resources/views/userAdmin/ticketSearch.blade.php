@extends("layouts.mainlayout")
@section("title","Filter Result")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Ticket Filter Result</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{url("ticket/dashboard")}}">Ticket</a></li>
                            <li class="breadcrumb-item active">Filter Result</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
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
            <th scope="col">Assign Staff</th>
            <th scope="col">Status</th>
            <th scope="col">Priority</th>
            <th scope="col">Category</th>
            <th scope="col">Last Updated</th>
        </tr>
        </thead>
        <tbody>
        @foreach($agent_tickets as $ticket)
                <tr>
                    <th>{{$ticket->title}}</th>
                    <td>
                        <a href="{{ url("tickets/$ticket->ticket_id") }}">#{{$ticket->ticket_id}}
                        </a>
                    </td>
                    <td>
{{--                        <img src="{{url(asset("/profile/".$staff_name->agent_pp->profile))}}" alt="" width="30px" height="30px;" class="rounded-circle">--}}
                        {{$staff_name->agent->name}}
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
    <script>
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
    </script>
@endsection