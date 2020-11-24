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
                        <h3 class="page-title">Company Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                            <li class="breadcrumb-item active">Company</li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="card col-lg-8 offset-lg-2 col-sm-10 offset-sm-1 col-12">
                <div class="pro-edit mt-2"><a class="edit-icon" href="{{url("/company/edit/$company->id")}}"><i class="fa fa-pencil"></i></a></div>
                <div class="col-lg-4 offset-lg-4 col-sm-4 offset-sm-4 my-4">
                    <img src="{{url(asset("/companylogo/$company->logo"))}}" class="rounded-circle" alt="" width="200px;" height="200px">
                </div>
                <h3 align="center">{{$company->name}}</h3>
                <div class="row mb-5">
                    <div class="col-lg-2 col-sm-2 col-3 my-2">
                        Email
                    </div>
                    <div class="col-lg-4 col-sm-4 col-8 my-2">
                        : {{$company->email}}
                    </div>
                    <div class="col-lg-2 col-sm-2 col-3 my-2">
                        Website link
                    </div>
                    <div class="col-lg-4 col-sm-4 col-8 my-2">
                        : {{$company->company_website}}
                    </div>
                    <div class="col-lg-2 col-sm-2 col-3 my-2">
                        Phone
                    </div>
                    <div class="col-lg-4 col-sm-4 col-8 my-2">
                        : {{$company->phone}}
                    </div>
                    <div class="col-lg-2 col-sm-2 col-3 my-2">
                        Hotline
                    </div>
                    <div class="col-lg-4 col-sm-4 col-8 my-2">
                        : {{$company->hotline}}
                    </div>
                    <div class="col-lg-2 col-sm-2 col-3 my-2">
                        Company Address
                    </div>
                    <div class="col-lg-4 col-sm-4 col-8 my-2">
                        : {{$company->company_address}}
                    </div>
                    <div class="col-lg-2 col-sm-2 col-3 my-2">
                        Short Form
                    </div>
                    <div class="col-lg-4 col-sm-4 col-8 my-2">
                        : {{$company->company_shortname}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection