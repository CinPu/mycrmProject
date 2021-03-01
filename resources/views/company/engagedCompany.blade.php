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
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Company</a>
                        <button type="button" class="btn btn-outline-secondary mr-2" data-toggle="modal" data-target="#importEmployee">
                            <i class="fa fa-upload mr-2"></i>Import
                        </button>
                        <div class="modal fade" id="importEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Company</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url("client/company/import")}}" method="POST" enctype="multipart/form-data">
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
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Company ID</label>
                        <input type="text" name="company_id" id="search_with_id" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Company Name</label>
                        <input type="text" name="company_id" id="search_with_id" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Business</label>
                        <input type="text" name="company_id" id="search_with_id" class="form-control">
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                        <button class="btn btn-primary mt-4" id="search">Search</button>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row staff-grid-row">
                        @foreach($allcompany as $company)
                            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                <div class="profile-widget">
                                    <div class="profile-img">
                                        <a href="{{url("client/company/profile/$company->id")}}" >
                                            <img src="{{url(asset("/companylogo/$company->logo"))}}"class="avatar" alt="">
                                        </a>
                                    </div>
                                    <div class="dropdown profile-action">
                                        <div class="pro-edit">
                                            <button class="edit-icon"  href="#" data-toggle="modal" data-target="#delete{{$company->id}}"><i class="fa fa-trash-o"></i></button>
                                        </div>
                                    </div>
                                    <div id="delete{{$company->id}}" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    Are you sure delete <b>{{$company->name}}</b>?
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <a href="#" class="btn btn-outline-warning text-center" data-dismiss="modal" aria-label="Close">No</a>
                                                        <a href="{{url("/customer_company/delet/$company->id")}}" class="btn btn-outline-danger text-center">Yes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{url("client/company/profile/$company->id")}}">{{$company->name}}</a></h4>
                                    <strong>{{$company->company_id}}</strong>
                                    <h5>Hotline : <i class="fa fa-phone"></i> <a href="tel:{{$company->hotline}}">{{$company->hotline}}</a></h5>
                                    <a href="{{$company->company_website}}">{{$company->company_website}}</a>
                                    {{--                            <div class="small text-muted">{{$emp->position->emp_position}}</div>--}}
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="overflow-x: auto">
                    <table class="table" id="emp">
                        <thead>
                        <tr>
                            <th scope="col">Company ID</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Company Email</th>
                            <th scope="col">Hotline</th>
                            <th scope="col">Type of Business</th>
                            <th scope="col">Parent Company</th>
                            <th scope="col">Website</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allcompany as $company)
                            <tr>
                                <td><a href="{{url("client/company/profile/$company->id")}}">#{{$company->company_id}}</a></td>
                                <td>{{$company->name}}</td>
                                <td>{{$company->email}}</td>
                                <td><a href="tel:{{$company->hotline}}"><i class="fa fa-phone"></i> {{$company->hotline}}</a></td>
                                <td>{{$company->type_of_business}}</td>
                                <td>{{$company->parent_company}}</td>
                                <td><a href="{{$company->company_website}}">{{$company->company_website}}</a></td>
                                <td>
                                    <a href="#"class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-th-list ml-2 mt-2" style="font-size: 18px;"></i></a>
                                    <div class="dropdown-menu">
                                        <a href="{{url("client/company/profile/$company->id")}}" class="dropdown-item"><i class="fa fa-building mr-2"></i>Details</a>
                                        <a data-toggle="modal" data-target="#delete{{$company->id}}_list" class="dropdown-item"><i class="fa fa-trash-o mr-2"></i>Delete</a>
                                    </div>
                                    <div id="delete{{$company->id}}_list" class="modal custom-modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    Are you sure delete <b>{{$company->name}}</b>?
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12 text-center">
                                                        <a href="#" class="btn btn-outline-warning text-center" data-dismiss="modal" aria-label="Close">No</a>
                                                        <a href="{{url("/customer_company/delet/$company->id")}}" class="btn btn-outline-danger text-center">Yes</a>
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
                        <form action="{{url("client/company/create/route")}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col-12 mb-3">
                                <div>
                                    <div class="text-center" >
                                        <h4>Choose Company Logo</h4>
                                        <img id="output" class="rounded-circle" src="{{url(asset("/img/profiles/avatar-01.jpg"))}}" width="100px" height="100px;"><br><br>
                                        <input type="file" accept="image/*" name="logo"  class="offset-md-1" onchange="loadFile(event)">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                        <label>Company ID : </label>
                                        <input type="text" class="form-control" name="company_id" value="{{$company_id}}" >
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                        <label>Company Name : </label>
                                        <input type="text" class="form-control" name="name" >
                                </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                        <label>Company CEO Name</label>
                                        <input type="text" class="form-control" name="ceo">
                                </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                    <label>Company Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Company Email">
                                </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                    <label>Parent Company</label>
                                    <input type="text" class="form-control" name="parent">
                                </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                        <label>Business Type</label>
                                        <input type="text" class="form-control" name="business_type">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                    <label>Company Phone</label>
                                    <input type="number" class="form-control" name="phone" placeholder="09xxxxxxxxx">
                                </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                    <label>Hot Line</label>
                                    <input type="number" class="form-control" name="hotline" placeholder="09xxxxxxxxx">
                                </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                    <label>Company Website Link</label>
                                    <input type="url" class="form-control" name="web_link" value="https://">
                                </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                        <label>Facebook Page Link</label>
                                        <input type="url" class="form-control" name="facebook_page" value="https://">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                        <label>LinkedIn</label>
                                        <input type="url" class="form-control" name="linked_in" value="https://">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" placeholder="Thirih(5)Street,Hlaing Township,Yangon">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12 col-12 ">
                                        <label>Company Registry</label><br>
                                        <textarea rows="3" style="width: 100%" name="company_retistry"></textarea>
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12 col-12 ">
                                        <label>Company Vision</label><br>
                                        <textarea rows="3" style="width: 100%" name="vision"></textarea>
                                    </div>
                                    <div class="form-group col-lg-12 col-sm-12 col-12 ">
                                        <label>Company Mission</label><br>
                                        <textarea rows="3" style="width:100%;" name="mission"></textarea>
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
