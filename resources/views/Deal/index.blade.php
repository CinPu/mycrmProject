@extends('layouts.mainlayout')
@section('content')
{{--    <link rel="stylesheet" href="{{url(asset("js/kaban/style.css"))}}">--}}
<style>
   #cke_12,#cke_13,#cke_14,#cke_15,.cke_toolbar_separator,#cke_16,#cke_17,#cke_18,#cke_19{
        visibility: hidden;
    }
</style>
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Deal</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto ml-auto mb-3">
                    <a href="{{url("/deal/add")}}" class="btn add-btn rounded" ><i class="fa fa-plus"></i> Add New</a>
                    <div class="view-icons">
                        <ul class="nav mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="grid-view btn btn-link nav-link active" id="home-tab" data-toggle="tab" href="#list_view" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-th"></i></a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a  id="profile-tab" data-toggle="tab" href="#kaban_view" role="tab" aria-controls="profile" aria-selected="false" class="list-view btn btn-link nav-link"><i class="fa fa-trello "></i></a>
                            </li>
{{--                            <li class="nav-item" role="presentation">--}}
{{--                                <a class="list-view btn btn-link nav-link"><i class="fa fa-history mr-2"></i>Sync</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item" role="presentation">--}}
{{--                                <div class="dropdown">--}}
{{--                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                        Sort By & View By--}}
{{--                                    </button>--}}
{{--                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Another action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="list_view" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Deal Name</th>
                            <th>Amount</th>
                            <th>Organization</th>
                            <th>Expected Close Date</th>
                            <th>Sale Stage</th>
                            <th>Assign To</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($alldeals as $deal)
                        <tr>
                            <td><a href="{{url("deal/show/$deal->id")}}">{{$deal->name}}</a></td>
                            <td>{{$deal->amount}} <strong class="float-right">{{$deal->unit}}</strong></td>
                            <td>{{$deal->customer_company->name}}</td>
                            <td>{{$deal->close_date}}</td>
                            <td>{{$deal->sale_stage}}</td>
                            <td>{{$deal->employee->name}}</td>
                            <td>
                                <a href="#"class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v ml-2 mt-2" style="font-size: 18px;"></i></a>
                                <div class="dropdown-menu">
                                    <a href="{{url("/deal/edit/$deal->id")}}" class="dropdown-item"><i class="fa fa-edit mr-2"></i>Edit</a>
                                    <a href="{{url("$/deal/delete/$deal->id")}}" class="dropdown-item"><i class="fa fa-trash-o mr-2"></i>Delete</a>
                                </div>
                            </td>
                        </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="kaban_view" role="tabpanel" aria-labelledby="home-tab">
                    Kaban View
                </div>
            </div>
        </div>
    </div>
        <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

        </script>
@endsection
