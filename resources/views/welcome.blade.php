<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Welcome</title>
    <style>
        body{
            background-image: url("public/companylogo/logo.jpg");
        }
    </style>
</head>
<body style="background-color: lightblue">
<nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand ml-2" href="#">Support Ticket</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
{{--        <div class="collapse navbar-collapse" id="navbarNav">--}}
{{--            <ul class="navbar-nav offset-md-10 float-right">--}}
{{--                <li class="nav-item active">--}}
{{--                    <a class="nav-link btn btn-outline-warning rounded-pill" href="{{url("/login")}}"><i class="fa fa-sign-in mr-2"></i> <span>Login</span> <span class="sr-only">(current)</span></a>--}}
{{--                </li>--}}
{{--                <li class="nav-item ml-2">--}}
{{--                    <a class="nav-link btn btn-outline-info" href="{{url("/register")}}">Register</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
    </nav>
<div class="home_body" style="height: 250px;">
    <br>
<div class="row">
    <div class="col-md-7">
        <h3 align="center" class="my-5">
            What can we help you?
        </h3>
        <!-- Default dropright button -->
        <div class="btn-group offset-md-4 offset-2 dropright">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary rounded" data-toggle="modal" data-target="#exampleModalCenter">
                Send Complain Ticket<i class="fa fa-send-o ml-3"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-left" role="document">
                    <div class="modal-content">
                        <div>
                            <span type="button " class="mr-3 mt-2 close float-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></span>

                        </div>
                        <span class="mt-2 ml-3">Which Company Do You Want to Send Complain Ticket?</span>
                        <div class="modal-body">
                            @foreach($company as $com)
                                <a class="btn btn-outline-dark col-12 mt-2" href="{{url("/ticket/create/".$com->admin->uuid)}}"><img src="{{url(asset("companylogo/$com->company_logo"))}}" alt="" class="rounded-circle float-left" width="30px;"height="30px;"> {{$com->company_name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    <h3 align="center">SIGN IN</h3>
    <div class="card border-dark">
    <form method="POST" action="{{route("login")}}" class="col-12 my-3">
        {{csrf_field()}}
        <div class="form-group" data-validate = "Valid email is required: ex@abc.xyz">
            <span class="label-input100">Email</span>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email addess...">
            <span class="focus-input100"></span>
        </div>

        <div class="form-group" data-validate = "Password is required">
            <span class="label-input100">Password</span>
            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="*************">
            <span class="focus-input100"></span>
        </div>
            <div class="form-group ">
                <button type="submit"  class="btn btn-primary col-12 mt-2">
                    Sign in
                </button>
                <a href="{{url("/register")}}" class="btn btn-outline-success col-12 mt-2">
                    Sign Up
                </a>
            </div>
    </form>
    </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>