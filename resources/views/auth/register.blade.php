<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{asset("/css/registermain.css")}}">
    <link rel="stylesheet" href="{{asset("/css/registerutil.css")}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="{{url(asset("companylogo/mainlogo.png"))}}">
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="login100-more" style="background-image: url('img/logo.jp');"></div>
            <div class="wrap-login100 p-l-30 p-r-50 p-t-30 p-b-50">
                <form method="POST" action="{{ route('register') }}" class="login100-form validate-form">
                    {{csrf_field()}}
                    @if($errors)
                        @foreach($errors->all() as $error)
                            <div class="alert alert-warning alert-dismissible fade show">
                                <strong>Warning!</strong>{{$error}}
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endforeach
                    @endif
					<span class="login100-form-title p-b-20">
						Sign Up
					</span>
                    <div class="wrap-input100 validate-input" data-validate="Name is required">
                        <span class="label-input100">User Name</span>
                        <input id="name" type="text" class="input100  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <span class="label-input100">Email</span>
                        <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email addess...">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="*************">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Repeat Password is required">
                        <span class="label-input100">Repeat Password</span>
                        <input id="password-confirm" type="password" class="input100" name="password_confirmation" required autocomplete="new-password" placeholder="*************">
                        <span class="focus-input100"></span>
                        <input type="hidden" name="uuid" value="{{Str::uuid()->toString()}}">
                    </div>
{{--                    <div class="flex-m w-full p-b-33">--}}
{{--                        <div class="contact100-form-checkbox">--}}
{{--                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">--}}
{{--                            <label class="label-checkbox100" for="ckb1">--}}
{{--								<span class="txt1">--}}
{{--									I agree to the--}}
{{--									<a href="#" class="txt2 hov1">--}}
{{--										Terms of User--}}
{{--									</a>--}}
{{--								</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}


{{--                    </div>--}}

                    <div class="container-login100-form-btn">
                            <button type="submit" class="rounded-pill btn-lg col-md-5 mt-1 col-11 ml-2 btn btn-danger">
                                Sign Up
                            </button>

                        <a href="{{url("/")}}" class="col-md-5  col-11 dis-block btn-lg btn btn-primary rounded-pill mt-1  ml-2  txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
                            Sign in
                            <i class="fa fa-long-arrow-right m-l-5"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
