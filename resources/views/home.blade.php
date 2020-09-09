@extends("layouts.app")
@section("content")
<div class="card col-md-8 offset-md-1 my-5">
    <i class="fa fa-info-circle my-2" style="font-size: 24px;"></i>
    <p class="text-center my-2">
        Welcome {{\Illuminate\Support\Facades\Auth::user()->name}}<br>
    Congratulation !<br>
    Register Successful!<br>
    Just now,You have no any role and permission!
    </p>
</div>
@endsection
