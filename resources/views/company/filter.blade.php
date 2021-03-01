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
                        <h3 class="page-title">Company Search Results</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{url("engaged/company")}}">Company</a></li>
                            <li class="breadcrumb-item active">Company</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Company</a>
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
                    <table class="table" id="search_result">
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

    </div>
    <script>
        $(document).ready(function (){
            $("#search_result").DataTable({
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
            });
        });
    </script>
    <!-- /Page Wrapper -->
@endsection
