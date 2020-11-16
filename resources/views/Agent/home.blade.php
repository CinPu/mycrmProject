@extends("layouts.mainlayout")
@section("title","Ticket")
@section("content")
    <style>
        #select-all,#label_selectall{
            position: relative;
            top: 60px;
            }
    </style>
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Agent Home</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Home</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
        </div>
    </div>
@endsection
