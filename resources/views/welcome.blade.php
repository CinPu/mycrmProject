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

        }
    </style>
</head>
<body style="background-color: lightblue;background-image:url(./public/companylogo/logo.jpg);">
<nav class=" navbar navbar-expand-lg navbar-light mt-2" id="pills-tab" role="tablist">
    <a class="navbar-brand " href="#">Support Ticket</a>
    <ul class="nav nav-pills offset-lg-8 offset-0" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa fa-lock mr-2"></i>Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-envelope mr-2"></i>Sending</a>
        </li>

    </ul>
</nav>
        <div class="container-fluid">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <h4 align="center" class="mt-5">
                        Choose You Want to Send Company?
                    </h4>
                    @foreach($company as $com)
                        <a href="{{url("/ticket/create/".$com->admin->uuid)}}" style="text-decoration: none">
                            <div class="row  text-center">
                                <div class="col-12">
                                    <div class="card col-lg-2 col-sm-3 col-5 offset-1 offset-lg-1 rounded shadow">
                                        <div class="card-body text-center">
                                            <img src="{{url(asset("companylogo/$com->company_logo"))}}" class="rounded-circle mb-3" width="50%" height="50%;">
                                            <br><b align="center" style="font-size:100%">{{$com->company_name}}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
                <div class="tab-pane fade offset-lg-1 show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="col-lg-3 col-sm-6 col-11 offset-lg-4 offset-sm-3">
                        <h3 align="center" class="mt-5">SIGN IN</h3>
                        <div class="card col-12 border-dark">
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
        </div>
</body>
</html>