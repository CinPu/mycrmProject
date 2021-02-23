@extends('layouts.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Clients</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{url("client")}}">Clients</a></li>
                            <li class="breadcrumb-item active">Filter Result</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{url("client/customer/create")}}" class="btn add-btn"><i class="fa fa-plus"></i> Add Client</a>
                        <div class="view-icons">
                            <ul class="nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="grid-view btn btn-link nav-link active" id="home-tab" data-toggle="tab" href="#galleryView" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-th"></i></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a  id="profile-tab" data-toggle="tab" href="#listview" role="tab" aria-controls="profile" aria-selected="false" class="list-view btn btn-link nav-link"><i class="fa fa-bars"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="galleryView" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row staff-grid-row">
                        {{--                    @dd($allclients)--}}
                        @foreach($filter_results as $client)
                            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                <div class="profile-widget">
                                    <div class="profile-img">
                                        <a href="{{url("/profile/$client->id")}}" class="avatar"><img alt="" src="img/profiles/avatar-19.jpg"></a>
                                    </div>
                                    <div class="dropdown profile-action">
                                        <div class="pro-edit">
                                            <button class="edit-icon"  href="#" data-toggle="modal" data-target="#delete{{$client->id}}"><i class="fa fa-trash-o"></i></button>
                                        </div>
                                    </div>
                                    <div id="delete{{$client->id}}" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    Are you sure delete <b>{{$client->customer_name}}</b>?
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <a href="#" class=" btn btn-outline-warning text-center" data-dismiss="modal" aria-label="Close">No</a>
                                                        <a href="{{url("/client/delete/$client->id")}}" class="btn btn-outline-danger text-center">Yes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{url("/profile/$client->id")}}">{{$client->customer_company->name}}</a></h4>
                                    <h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{url("/profile/$client->id")}}">{{$client->customer_name}}</a></h5>
                                    <div class="small text-muted">{{$client->customer_position->emp_position}}</div>
                                    <a href="chat" class="btn btn-white btn-sm m-t-10">Message</a>
                                    <a href="{{url("/profile/$client->id")}}" class="btn btn-white btn-sm m-t-10">View Profile</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade " id="listview" role="tabpanel" aria-labelledby="home-tab" style="overflow-x: auto">
                    <table class="table" id="customer">
                        <thead>
                        <tr>
                            <th scope="col">Customer ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Company</th>
                            <th scope="col">Department</th>
                            <th scope="col">Position</th>
                            <th scope="col">Address</th>
                            <th scope="col">Report To</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($filter_results as $client)
                            <tr>
                                <th>{{$client->customer_id}}</th>
                                <td>{{$client->customer_name}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->phone}}</td>
                                <td>{{$client->customer_company->name}}</td>
                                <td>{{$client->department}}</td>
                                <td>{{$client->customer_position->emp_position}}</td>
                                <td>{{$client->address}}</td>
                                <td>{{$client->report_to}}</td>
                                <td>
                                    <a href="#"class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-th-list ml-2 mt-2" style="font-size: 18px;"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="{{url("/profile/$client->id")}}" class="dropdown-item" ><i class="fa fa-user mr-2"></i>Profile</a>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#table_delete{{$client->id}}"><i class="fa fa-trash-o mr-2"></i>Delete</a>
                                    </div>
                                    <div id="table_delete{{$client->id}}" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    Are you sure delete <b>{{$client->customer_name}}</b>?
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <a href="#" class=" btn btn-outline-warning offset-4" data-dismiss="modal" aria-label="Close">No</a>
                                                        <a href="{{url("/client/delete/$client->id")}}" class="btn btn-outline-danger text-center">Yes</a>
                                                    </div>
                                                </div>
                                            </div>
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
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
    <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
@endsection