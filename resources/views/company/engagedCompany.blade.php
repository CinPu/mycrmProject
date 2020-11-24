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
                        <h3 class="page-title">Company</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Company</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
                        <button type="button" class="btn btn-outline-secondary mr-2" data-toggle="modal" data-target="#importEmployee">
                            <i class="fa fa-upload mr-2"></i>Import
                        </button>
                        <div class="modal fade" id="importEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Employee</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url("/employee/import")}}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="file" name="file" >
                                            <br>
                                            <button class="btn btn-outline-success float-right"><i class="fa fa-upload mr-2"></i>Import Ticket</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="view-icons">
                            <ul class="nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="grid-view btn btn-link nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-th"></i></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a  id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" class="list-view btn btn-link nav-link"><i class="fa fa-bars"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Content Starts -->
            <div class="row staff-grid-row">
                @foreach($allcompany as $company)
                    <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                        <div class="profile-widget">
                            <div class="profile-img">
                                    <a href="{{url("/company/profile/$company->id")}}" >
                                        <img src="{{url(asset("/companylogo/$company->logo"))}}"class="avatar" alt="">
                                    </a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{url("/company/edit/$company->id")}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="{{url("/company/delete/$company->id")}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{url("/company/profile/$company->id")}}">{{$company->name}}</a></h4>
{{--                            <div class="small text-muted">{{$emp->position->emp_position}}</div>--}}
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /Content End -->

        </div>
        <!-- /Page Content -->
        <div id="add_employee" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Company</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url("/company/create")}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col-12 mb-3">
                                <div>
                                    <div class="text-center" >
                                        <h4>Choose Company Logo</h4>
                                        <img id="output" class="rounded-circle" width="100px" height="100px;"><br><br>
                                        <input type="file" accept="image/*" name="logo"  class="offset-md-1" onchange="loadFile(event)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row mt-5">
                                        <span for="" class="col-6 col-md-4">Company Name : </span>
                                        <input type="text" class="form-control col-md-6 col-6" name="name" >
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <span class="col-6 col-md-4">Company Name Short Form</span>
                                        <input type="text" class="form-control col-6 col-md-6" name="short_form" placeholder="eg.LG co.,ltd">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <span class="col-6 col-md-4">Company Email</span>
                                        <input type="email" class="form-control col-6 col-md-6" name="email" placeholder="Company Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <span class="col-6 col-md-4">Company Address</span>
                                        <input type="text" class="form-control col-6 col-md-6" name="address" placeholder="Thiri(5)Street,Hlaing,Yangon">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <span class="col-6 col-md-4">Company Phone</span>
                                        <input type="number" class="form-control col-6 col-md-6" name="phone" placeholder="09xxxxxxxxx">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <span class="col-6 col-md-4">Hot Line</span>
                                        <input type="number" class="form-control col-6 col-md-6" name="hotline" placeholder="09xxxxxxxxx">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <span class="col-6 col-md-4">Company Website Link</span>
                                        <input type="text" class="form-control col-6 col-md-6" name="web_link" placeholder="www.cloudark.biz">
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit"  class="btn btn-primary rounded">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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