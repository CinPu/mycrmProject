@extends("layouts.mainlayout")
@section("title","Deal")
@section("content")
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Deal</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Deal</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{url("lead/create")}}" class="btn add-btn"><i class="fa fa-plus"></i> Add Lead</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
        </div>
    </div>
@endsection
