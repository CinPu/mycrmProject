<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" class="avatar avatar-xs" type="image/x-icon" href="{{url(asset("companylogo/mainlogo.png"))}}">
    <title>CloudArk</title>
    <style>
        body{

        }
    </style>
    <ul class="nav nav-pills bg-dark" id="pills-tab" role="tablist">
        <li class="nav-item  my-2 ml-3 float-right">
            <a class="nav-link active "  id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa fa-lock mr-2"></i>Login</a>
        </li>
        <li class="nav-item mr-5 my-2 float-right">
            <a class="navbar-brand  nav-link" data-toggle="pill" href="#pills-home" role="tab"><i class="fa fa-ticket"></i> Ticket </a>
        </li>

    </ul>
</head>
<body style="background-image:url(./public/companylogo/logo.jpg);">

{{--</nav>--}}
       <div class="container-fluid">
           <div class="tab-content" id="pills-tabContent">
               <div class="tab-pane fade text-center " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                   <h4 align="center" class="mt-5">
                      Ticket Sending
                   </h4>
                   <div class="row">
                    @foreach($ticket_admin as $admin)
                        <div class="col-lg-2 col-sm-3 col-6">
                                <a href="{{url("/ticket/create/".$admin->user->uuid)}}" style="text-decoration: none">
                                    <div class="card  rounded shadow " style="background-color:#f2eeed">
                                        <div class="card-body text-center">
                                            @php
                                            $company=\App\company::where("id",$admin->employee->company_id)->where("is_admin_company",1)->first();
                                            @endphp
                                            <img src="{{url(asset("companylogo/$company->logo"))}}" class="rounded-circle mb-3" width="50%" height="50%;">
                                            <br><b align="center" style="font-size:100%">{{$company->name}}</b>
                                        </div>
                                    </div>
                                 </a>
                        </div>
                    @endforeach
                    </div>
                </div>
               <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="col-lg-4 col-sm-6 col-12 offset-lg-4 offset-sm-3 mt-5">
                        <h3 align="center">SIGN IN</h3>
                        <div class="card col-12 border-dark">
                            <div class="text-center mt-3">
                            <img class="rounded-circle" src="{{url(asset("/companylogo/mainlogo.png"))}}" alt="" width="30%" height="30%;">
                            </div>
                            <form method="POST" action="{{url("login")}}" class="col-12 my-3">
                                {{csrf_field()}}
                                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="form-group" data-validate = "Valid email is required: ex@abc.xyz">
                                    <span class="label-input100">Email</span>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email addess...">
                                </div>
                                </div>
                                <div class="form-group" data-validate = "Password is required">
                                    <span class="label-input100">Password</span>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password" placeholder="*************">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong class="text-danger text-center">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
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
