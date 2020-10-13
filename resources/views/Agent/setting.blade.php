@extends("layouts.app")
@section("title","Setting")
@section("content")
    <div class="card col-md-6 offset-md-3">
    <form action="" method="POST" id="pass_change">
        {{csrf_field()}}
        <div class="form-group ml-2">
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
        <div class="form-group">
            <button type="submit" class="btn btn-primary float-right">Save</button>
        </div>

    </form>
    </div>
@endsection
