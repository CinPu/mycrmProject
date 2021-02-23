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
