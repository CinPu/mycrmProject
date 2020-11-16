@extends("layouts.mainlayout")
@section("title","Employee Home Page")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee Home Page</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Home</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
    <h1 align="center">Welcome {{\Illuminate\Support\Facades\Auth::user()->name}}</h1>
        </div>
    </div>
@endsection