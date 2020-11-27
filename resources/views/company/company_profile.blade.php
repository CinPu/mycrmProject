@extends('layouts.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Company Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Company</li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="card mb-0">
                <div class="card-body">
                    <div class="dropdown profile-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons" style="font-size: 20px;">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="">
                                            <img src="{{url(asset("companylogo/$company->logo"))}}" class="avatar" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0">{{$company->name}}</h3>
                                                <h5 class="company-role m-t-0 mb-0">{{$company->name_of_ceo}}</h5>
                                                <small class="text-muted">CEO</small>
                                                <div class="staff-id">Company ID : {{$company->company_id}}</div>
                                                <div class="staff-id"><i class="fa fa-phone"></i> Hotline : {{$company->hotline}}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone</span>
                                                    <span class="text"><a href="">: {{$company->phone}}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email</span>
                                                    <span class="text"><a href="">: {{$company->email}}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Address</span>
                                                    <span class="text">: {{$company->company_address}}</span>
                                                </li>
                                                <div>
                                                    <span class="title mr-5">Parent Company</span>
                                                    <span class="text">: {{$company->parent_company}}</span>
                                                </div>
                                                <div class="my-2">
                                                    <span class="title mr-5">Type Of Business</span>
                                                    <span class="text">: {{$company->type_of_business}}</span>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-2 ml-3"><a href="{{$company->company_website}}"><i class="fa fa-globe mr-2"></i> {{$company->company_website}}</a></div>
                                    <div class="mb-2 ml-3"><a href="{{$company->linkedin}}"><i class="fa fa-linkedin-square mr-2"></i> {{$company->linkedin}}</a></div>
                                    <div class="mb-2 ml-3"><a href="{{$company->facebookpage}}"><i class="fa fa-facebook-square mr-2"></i> {{$company->facebookpage}}</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item col-sm-3"><a class="nav-link active" data-toggle="tab" href="#myprojects">About</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content profile-tab-content">
                        <!-- Projects Tab -->
                        <div id="myprojects" class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="pro-edit"><a data-target="#registry" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                                            <h4 class="project-title"><a href="#">Registry</a></h4>
                                            <p class="text-muted">
                                                {{$company->company_registry}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="pro-edit"><a data-target="#mission" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                                            <h4 class="project-title"><a href="#">Company Mission</a></h4>
                                            <p class="text-muted">{{$company->company_mission}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="pro-edit"><a data-target="#vision" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                                            <h4 class="project-title"><a href="project-view">Vision</a></h4>
                                            <p class="text-muted">
                                                {{$company->company_vision}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="edit" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Company Information Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{url("/company/edit/info/$company->id")}}">
                            {{csrf_field()}}
                            <div class="col-12 mb-3">
                                <div>
                                    <div class="text-center" >
                                        <h4>Choose Company Logo</h4>
                                        <img id="output" class="rounded-circle" src="{{url(asset("companylogo/$company->logo"))}}" width="100px" height="100px;"><br><br>
                                        <input type="file" accept="image/*" name="logo"  class="offset-md-1" onchange="loadFile(event)">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                        <label>Company ID : </label>
                                        <input type="text" class="form-control" name="company_id" value="{{$company->company_id}}" >
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                        <label>Company Name : </label>
                                        <input type="text" class="form-control" name="name" value="{{$company->name}}">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                        <label>Company CEO Name</label>
                                        <input type="text" class="form-control" name="ceo" value="{{$company->name_of_ceo}}">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                        <label>Company Email</label>
                                        <input type="email" class="form-control" name="email" value="{{$company->email}}">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                        <label>Parent Company</label>
                                        <input type="text" class="form-control" name="parent" value="{{$company->parent_company}}">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                        <label>Business Type</label>
                                        <input type="text" class="form-control" name="business_type" value="{{$company->type_of_business}}">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                        <label>Company Phone</label>
                                        <input type="number" class="form-control" name="phone" value="{{$company->phone}}">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12">
                                        <label>Hot Line</label>
                                        <input type="number" class="form-control" name="hotline" value="{{$company->hotline}}">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                        <label>Company Website Link</label>
                                        <input type="url" class="form-control" name="web_link" value="{{$company->company_website}}">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                        <label>Facebook Page Link</label>
                                        <input type="url" class="form-control" name="facebook_page" value="{{$company->facebookpage}}">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                        <label>LinkedIn</label>
                                        <input type="url" class="form-control" name="linked_in" value="{{$company->linkedin}}">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" value="{{$company->company_address}}">
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="vision" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Company Vision</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{url("/company/edit/vision/$company->id")}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="">Company Vision</label><br>
                                <textarea name="vision" id="" rows="3" style="width:100%">
                                                    {{$company->company_vision}}
                                                </textarea>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="mission" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Company Mission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{url("/company/edit/mission/$company->id")}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="">Company Mission</label><br>
                                <textarea name="mission" id="" rows="3" style="width:100%">
                                                    {{$company->company_mission}}
                                                </textarea>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="registry" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Company Registry</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{url("/company/edit/registry/$company->id")}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="">Company Registry</label><br>
                                <textarea name="registry" id="" rows="3" style="width:100%">
                                                    {{$company->company_registry}}
                                                </textarea>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="delete" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        Are you sure delete <b>{{$company->name}}</b>?
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="#" class=" offset-4 btn btn-outline-warning text-center" data-dismiss="modal" aria-label="Close">No</a>
                            <a href="{{url("/customer_company/delet/$company->id")}}" class="btn btn-outline-danger text-center">Yes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
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