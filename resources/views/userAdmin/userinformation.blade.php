@extends("layouts.app")
@section("title","Guest User Information")
@section("csscode")
@endsection
@section("content")
    @foreach($userinfo as $user)
    <div class="card">
        <div class="row my-3">
            <div class="col-md-3 ml-3"><span><img class="img rounded-circle" src="{{url("assets/img/agentpp.png")}}" height="40px;" width="40px;" /></span><b class="ml-3">{{$user->name}}</b></div>
            <div class="col-md-3">{{$user->email}}</div>
            <div class="col-md-5">
            <a href="{{url("/guestuser/sending/$user->id")}}" class="float-right">History<i class="fa fa-history ml-1"></i></a>
            </div>
        </div>
    </div>
    @endforeach
@endsection