@extends("layouts.app")
@section("title","Department All Member")
@section("content")
    <div class="col-md-12">
        <div class="card">

            <div class="card-header card-header-primary">
                <h4 class="card-title">{{$dept->dept_name}}'s All Member</h4>
            </div>
            <div class="card-body">
                @foreach($members as $member)
                    <div class="card card-header bg-info">
                        <span><img class="img rounded-circle" src="{{url("assets/img/agentpp.png")}}" height="40px;" width="40px;" /><a href="{{url("/agent/detail/$member->id")}}"> <b class="ml-3 my-3">{{$member->user->name}}</b></a></span>
                        <span><i class="fa fa-envelope offset-md-1"></i> {{$member->user->email}}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection