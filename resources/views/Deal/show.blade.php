@extends('layouts.mainlayout')
@section('content')
    <style>
        .scoll{
            height: 490px;
            overflow: scroll;
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
                        <h3 class="page-title">{{$deal->name}}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-building"></i> {{$deal->customer_company->name}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <!-- Content Starts -->
            <div class="row ">
                <div class="col-md-8 col-12 border">
                   <div class="row my-2 col-12 ml-1">
                       <div class="card col-md-4">
                           <h5 class="card-header my-2">Assign To</h5>
                           <div class="card-body">
                               <div class="avatar-xs">
                                   <img class="avatar avatar-xs" src="{{url(asset("profile/".$deal->employee->emp_profile))}}" alt="emp_profile">
                                   <span>{{$deal->employee->name}}</span>
                               </div>
                           </div>
                       </div>
                       <div class="card col-md-4">
                           <h5 class="my-2 card-header">Organization Name</h5>
                           <div class="card-body">
                               <span>{{$deal->customer_company->name}}</span>
                           </div>
                       </div>
                       @if($deal->contact !=null)
                       <div class="card col-md-4">
                           <h5 class="my-2 card-header" >Contact Name</h5>
                           <div class="card-body">
                            <span>{{$deal->customer->name}}</span>
                           </div>
                       </div>
                           @endif
                   </div>
                    <div class="card col-12 ml-1">
                        <div class="card-header">Description</div>
                        <div class="card-body">
                            {!! $deal->description !!}
                        </div>
                    </div>
                    <label for="">Next Action</label>
                    <div class="card ">
                        <div class="row my-3">
                        <div class="col-md-9 ml-3"><i class="fa fa-list"></i> {{$deal->next_step}}</div>
                        <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 border">
                    <div class="card my-2">
                        <div class="card-header">
                            Deal Detail
                        </div>
                        <div class="card-body scoll">
                            <div class="form-group">
                                 <label for="">Deal Name</label>
                                <input type="text" class="form-control" value="{{$deal->name}}">
                             </div>
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="text" class="form-control" value="{{$deal->amount}} {{$deal->unit}}">
                            </div>
                            <div class="form-group">
                                <label for="">Organization Name</label>
                                <input type="text" class="form-control" value="{{$deal->customer_company->name}}">
                            </div>

                            <div class="form-group">
                                <label for="">Contact</label>
                                @if($deal->contact !=null)
                                <input type="text" class="form-control" value="{{$deal->customer->customer_name}}">
                                @else
                                    <input type="text" class="form-control" >
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">Expected Close Date</label>
                                <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($deal->close_date)->format('Y-m-d')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Pipeline</label>
                                <input type="text" class="form-control" value="{{$deal->pipeline}}">
                            </div>
                            <div class="form-group">
                                <label for="">Sale Stage</label>
                                <input type="text" class="form-control" value="{{$deal->sale_stage}}">
                            </div>
                            <div class="form-group">
                                <label for="">Assign To</label>
                                <input type="text" class="form-control" value="{{$deal->employee->name}}">
                            </div>
                            <div class="form-group">
                                <label for="">Lead Source</label>
                                <input type="text" class="form-control" value="{{$deal->lead_source}}">
                            </div>
                            <div class="form-group">
                                <label for="">Type</label>
                                <input type="text" class="form-control" value="{{$deal->type}}">
                            </div>
                            <div class="form-group">
                                <label for="">Probability</label>
                                <input type="text" class="form-control" value="{{$deal->probability}}">
                            </div>
                            <div class="form-group">
                                <label for="">Weighted Revenue</label>
                                <input type="text" class="form-control" value="{{$deal->weighted_revenue}} {{$deal->weighed_revenue_unit}}">
                            </div>
                            <div class="form-group">
                                <label for="">Lost Reason</label>
                                <input type="text" class="form-control" value="{{$deal->lost_reason}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Content End -->

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

@endsection
