@extends('layouts.mainlayout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <script src="{{asset("/js/rating.js")}}"></script>
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Leads</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Leads</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{url("lead/create")}}" class="btn add-btn"><i class="fa fa-plus"></i> Add Lead</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <div class="mb-3">
                            <span data-toggle="collapse" data-target="#search" >
                            <input type="checkbox" name="login">
                            </span><span >Search By</span>
                        </div>
                        <div class="sub-menu collapse border mb-3" id="search">
                            <div class=" col-md-12 my-3">
                                <div class="row mt-3">
                                    <div class="col-md-4 mb-  text-white">
                                        <select class="custom-select"  id="lead_id">
                                            <option value=""> Lead ID</option>
                                            @foreach($all_leads as $lead)
                                                <option value="{{$lead->lead_id}}"> {{$lead->lead_id}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3  text-white">
                                        <select class="custom-select"  id="customer_name">
                                            <option value="">Customer Name</option>
                                            @foreach($all_leads as $lead)
                                                <option value="{{$lead->customer->customer_name}}"> {{$lead->customer->customer_name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3 text-white">
                                        <select class="custom-select"  id="lead_id">
                                            <option value=""> Sale Person</option>
                                            @foreach($all_leads as $lead)
                                                <option value="{{$lead->lead_id}}"> {{$lead->lead_id}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3 text-white">
                                        <input type="text" class="form-control"  id="industry" placeholder="Type Industry">
                                    </div>
                                    <div class="col-md-4 text-white ">
                                        <input type="text" class="form-control" id="min" name="min" placeholder="From Date" >
                                    </div>
                                    <div class="col-md-4 text-white">
                                        <input type="text" class="form-control" id="max" name="max" placeholder="To Date">
                                    </div>
                                </div>
                                <button type="button" class=" btn btn-primary"><i class="fa fa-search mr-2"></i>Search</button>
                            </div>
                        </div>
                        <div style="overflow-x: auto">
                        <table id="lead" class="table  table-nowrap custom-table mb-0 ">
                            <thead>
                            <button type="button" class="btn btn-outline-secondary my-2" data-toggle="modal" data-target="#import">
                                <i class="fa fa-upload mr-2"></i>Import
                            </button>
                            <!-- Button import modal -->
                            <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <th>#</th>
                                <th>Lead ID</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Lead Title</th>
                                <th>Sale Person</th>
                                <th>Followed Staff</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Industry</th>
                                <th>Created</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all_leads as $lead)
                            <tr>
                                <td>{{$lead->id}}</td>
                                <td>{{$lead->lead_id}}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        @if($lead->customer->profile==null)
                                        <a href="#" class="avatar"><img alt="" src="img/profiles/avatar-11.jpg"></a>
                                        <a href="#">{{$lead->customer->customer_name}}</a>
                                        @else
                                            <a href="{{url("/profile/".$lead->customer->id)}}" ><img alt="" class="avatar" src="{{asset("/profile/".$lead->customer->profile)}}"></a>
                                            <a href="{{url("/profile/".$lead->customer->id)}}">{{$lead->customer->customer_name}}</a>
                                        @endif
                                    </h2>
                                </td>
                                <td>{{$lead->customer->email}}</td>
                                <td>{{$lead->customer->phone}}</td>
                                <td><a href="{{url("lead/view/$lead->id")}}">{{$lead->title}}</a></td>
                                <td><a href="">
                                        @if($lead->customer->profile==null)
                                            <a href="#" class="avatar"><img alt="" src="img/profiles/avatar-11.jpg"></a>
                                            {{$lead->saleMan->name}}
                                        @else
                                            <img alt="" class="avatar" src="{{asset("/profile/".$lead->saleMan->emp_profile)}}"></a>
                                            {{$lead->saleMan->name}}
                                        @endif
                                       </a>
                                </td>
                                <td>
                                    <ul class="team-members">
                                        @php
                                           $followers=\App\lead_follower::with("user")->where("lead_id",$lead->id)->get();

                                        @endphp
                                        <li class="dropdown avatar-dropdown">
                                            <a href="#" class="all-users dropdown-toggle" data-toggle="dropdown" aria-expanded="false">+{{count($followers)}}</a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="avatar-group">
                                                    @foreach($followers as $follower)
                                                        @php
                                                            $emp=\App\user_employee::where("user_id",$follower->user->id)->first();
                                                        @endphp
                                                    <a  href="{{url("/emp/profile/$emp->emp_id")}}">
                                                        @if($follower->user->hasAnyRole("Admin"))
                                                            @if($follower->user->profile==null)
                                                                <span class="avatar"><img alt="" src="img/profiles/avatar-01.jpg"></span>
                                                            @else
                                                                <img src="{{asset("/profile/".$follower->user->profile)}}" alt="user_profile"
                                                                     width="40px;" height="40px;" class="rounded-circle mr-2">
                                                            @endif
                                                        @else
                                                            @php
                                                                $pp=\App\user_employee::with("employee")->where("user_id",$follower->follower_id)->first();
                                                            @endphp
                                                            @if($pp->employee->emp_profile==null)
                                                                <span class="avatar"><img alt="" src="img/profiles/avatar-01.jpg"></span>
                                                            @else
                                                                <img src="{{asset("/profile/".$pp->employee->emp_profile)}}" alt="user_profile" class="avatar avatar-xs" mr-2">
                                                            @endif
                                                        @endif
                                                    </a>
                                                    @endforeach
                                                </div>
                                                <div class="avatar-pagination">
                                                    <ul class="pagination">
                                                        <li class="page-item">
                                                            <a class="page-link" href="#" aria-label="Previous">
                                                                <span aria-hidden="true">«</span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                        </li>
                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item">
                                                            <a class="page-link" href="#" aria-label="Next">
                                                                <span aria-hidden="true">»</span>
                                                                <span class="sr-only">Next</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                                <td><div id="review{{$lead->id}}"></div>
                                    <input type="hidden" id="prioriyt{{$lead->id}}" value="{{$lead->priority}}">
                                    <script>
                                        $("#review{{$lead->id}}").rating({
                                            "value":$("#prioriyt{{$lead->id}}").val(),
                                           "stars":3,
                                            "click": function (e) {
                                                console.log(e);
                                                $("#starsInput").val(e.stars);
                                            }
                                        });
                                    </script>
                                </td>
                                <td>@if($lead->is_qulified==1)
                                        <span class="badge bg-inverse-success">Qualified</span>
                                    @else
                                        <span class="badge bg-inverse-danger">Unqualified</span>
                                        @endif
                                </td>
                                <td>{{$lead->tags->tag_industry}}
                                </td>
                                <td>{{$lead->created_at->toFormattedDateString()}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{url("/lead/edit/$lead->id")}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="{{url("/lead/delete/$lead->id")}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <script>
        $(document).ready(function() {
            $('#lead').DataTable( {
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
        $('#lead_id').on('change', function() {
            var table = $('#lead').DataTable();
            table.column(1).search($(this).val()).draw();
        });
        $('#customer_name').on('change', function() {
            var table = $('#lead').DataTable();
            table.column(2).search($(this).val()).draw();
        });
        $('#saleMan').on('change', function() {
            var table = $('#lead').DataTable();
            table.column(2).search($(this).val()).draw();
        });
        $('#industry').on('change', function() {
            var table = $('#lead').DataTable();
            table.column(10).search($(this).val()).draw();
        });

        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#min').datepicker("getDate");
                    var max = $('#max').datepicker("getDate");
                    var startDate = new Date(data[11]);
                    if (min == null && max == null) { return true; }
                    if (min == null && startDate <= max) { return true;}
                    if(max == null && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#lead').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').change(function () {
                table.draw();
            });
        });



    </script>
    <!-- /Page Wrapper -->
@endsection