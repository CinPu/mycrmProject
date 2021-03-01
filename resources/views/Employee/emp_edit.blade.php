@extends("layouts.mainlayout")
@section("title","Employee Profile Edit")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee</li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
        <div class="card">
            <div class="col-12">
            <form action="{{url("/emp/edit/$employees->emp_id")}}" class="my-5" method="POST">
                {{csrf_field()}}
                <div class="row mb-3">
                <div class="form-group col-md-6 col-12 ">
                    <div class="row">
                    <span for="" class="col-md-4 col-10 ml-3">Employee ID</span>
                    <select class="form-control col-md-6 col-10 offset-1" name="emp_id">
                        <option value="{{$employees->employee_id}}">{{$employees->employee_id}}</option>
                    </select>
                    </div>
                </div>
                    <div class="form-group col-md-6 col-12 ">
                        <div class="row">
                        <span for="" class="col-md-4 col-10 ml-3">Employee Name</span>
                        <input type="text" class="form-control col-md-6 col-10 offset-1" name="emp_name" value="{{$employees->employee_user->name}}">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6 col-12 ">
                        <div class="row">
                            <span for="" class="col-md-4 col-10 ml-3">Email</span>
                            <input type="email" class="form-control col-md-6 col-10 offset-1" name="email" value="{{$employees->employee_user->email}}">
                            </div>
                    </div>
                    <div class="form-group col-md-6 col-12 ">
                        <div class="row">
                            <span for="" class="col-md-4 col-10 ml-3">Company</span>
                            <select class="form-control col-md-6 col-10 offset-1" name="company">
                                <option value="{{$employees->company->id}}">{{$employees->company->company_name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6 col-12 ">
                        <div class="row">
                            <span for="" class="col-md-4 col-10 ml-3">Department</span>
                            <select class="form-control col-md-6 col-10 offset-1" id="dept" name="department">
                                <option value="item0">Choose Department</option>
                                @foreach($depts as $dept)
                                    @if($dept->id==$employees->dept_id)
                                        <option  value="{{$dept->id}}">{{$dept->dept_name}} (Current)</option>
                                    @else
                                        <option value="{{$dept->id}}">{{$dept->dept_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12 ">
                        <div class="row">
                            <span for="" class="col-md-4 col-10 ml-3">Position</span>
                            <select name="emp_post" id="" class="form-control col-md-6 col-10 offset-1" >
                                @foreach($positions as $post)
                                    @if($post->id==$employees->emp_post)
                                        <option selected value="{{$post->id}}">{{$post->emp_position}}</option>
                                    @else
                                        <option value="{{$post->id}}">{{$post->emp_position}}</option>
                                    @endif
                                    @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6 col-12 ">
                        <div class="row">
                            <span for="" class="col-md-4 col-10 ml-3">Join Date</span>
                            <input type="date" name="join_date" class="form-control col-md-6 col-10 offset-1" data-date=""  value="{{Illuminate\Support\Carbon::parse($employees->join_date)->format('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12 ">
                        <div class="row">
                            <span for="" class="col-md-4 col-10 ml-3">Date Of Birth</span>
                            <input type="date" name="dob" class="form-control col-md-6 col-10 offset-1" data-date=""  value="{{Illuminate\Support\Carbon::parse($employees->dob)->format('Y-m-d')}}">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6 col-12 ">
                        <div class="row">
                            <span for="" class="col-md-4 col-10  ml-3">Address</span>
                            <input type="text" name="address" class="form-control col-md-6 col-10 offset-1" value="{{$employees->Address}}">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12 ">
                        <div class="row">
                            <span for="" class="col-md-4 col-10 ml-3">Phone</span>
                            <input type="number" name="phone" min="0" oninput="validity.valid||(value='');" class="form-control col-md-6 col-10 offset-1"   value="{{$employees->phone}}">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6 col-12 ">
                    <div class="row">
                        <span for="" class="col-md-4 col-10 ml-3">Report To</span>
                        <select name="report_to" class="form-control col-md-6 col-10 offset-1">
                            @foreach($allemp as $emp)
                                @if($emp->employee_user->id==$employees->report_to)
                                    <option value="{{$emp->employee_user->id}}" selected>{{$emp->employee_user->name}}</option>
                                @else
                                    <option value="{{$emp->employee_user->id}}">{{$emp->employee_user->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                    <div class="form-group col-md-6 col-12 ">
                        <div class="row">
                            <span for="" class="col-md-4 col-10 ml-3">Department Head</span>
                            <select class="form-control col-md-6 col-10 offset-1" name="dept_head" id="size">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-outline-info col-md-2 col-8">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#dept").change(function () {
                var val = $(this).val();
                @foreach($depts as $dept)
                if (val =={{$dept->id}} ) {
                    $("#size").html("<option value='{{$dept->dept_head}}'>{{$dept->department_head->name}}</option>");
                }else if(val=="item0") {
                    $("#size").html( "<option></option>");
                }
                @endforeach
            });
        });
    </script>
@endsection
