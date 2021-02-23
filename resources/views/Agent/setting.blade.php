@extends("layouts.mainlayout")
@section("title","Setting")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Password Change</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Password Change</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
    <div class="card col-md-6 offset-md-3">
    <form action="" method="POST" id="pass_change">
        {{csrf_field()}}
        <div class="form-group ml-2 mt-3">
            <span>Current Password</span>
            <input type="password" class="form-control" name="current_password" required>

        </div>
        <div class="form-group ml-2">
            <span>New Password</span>
            <input type="password" name="new_password" class="form-control" required >
        </div>
        <div class="form-group ml-2">
            <span>Confirm Password</span>
            <input type="password" name="confirm_password" class="form-control" required >
        </div>
        <div class="invalid-feedback">
            Please type confirm password
        </div>
        <div class="form-group ">
            <button type="submit" class="btn btn-primary float-right mb-3">Save</button>
        </div>

    </form>
    </div>
        </div>
    </div>
@endsection
