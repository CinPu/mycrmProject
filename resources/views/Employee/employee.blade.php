@extends("layouts.app")
@section("title","Employee")
@section("csscode")
    <style>
    </style>
@endsection
@section("content")
    <div class="offset-md-8">
    <ul class="nav" id="myTab" role="tablist">
        <li class="" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><button class="rounded"><i class="fa fa-th"></i></button></a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><button class="rounded"><i class="fa fa-th-list"></i></button></a>
        </li>
        <li>
            <a href="" class="btn btn-warning rounded" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus mr-2"></i>Add Employee</a>
            <div class="modal fade col-md-12" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{url("/employee/create")}}" method="POST">
                            {{csrf_field()}}
                        <div class="modal-body">
                                <div class="col-12 form-group row mt-3">
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 form-group row mt-3">
                                    <div class="col-md-6">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 form-group row mt-3">
                                    <div class="col-md-6">
                                        <label for="">Employee ID</label>
                                        <input type="text" name="emp_id" class="form-control" value="{{$emp_id}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Phone</label>
                                        <input type="number" name="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 form-group row mt-3">
                                    <div class="col-md-6">
                                        <label for="">Company</label>
                                        <select name="company" id="company" class="form-control">
                                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Join Date</label>
                                        <input type="date" name="join_date" class="form-control">
                                    </div>

                                </div>
                                <div class="col-12 form-group row mt-3">
                                    <div class="col-md-6">
                                        <label for="type">Department</label>
                                        <select class="form-control" id="type" name="department">
                                            <option value="item0">Choose Department</option>
                                            @foreach($depts as $dept)
                                                <option value="{{$dept->id}}">{{$dept->dept_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Position</label>
                                        <select name="position" class="form-control" id="">
                                            @foreach($positions as $position)
                                                <option value="{{$position->id}}">{{$position->emp_position}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 form-group row mt-3">
                                        <div class="col-md-6">
                                        <label for="">Report To</label>
                                        <select name="report_to" class="form-control" id="">
                                            <option value="{{\Illuminate\Support\Facades\Auth::user()->id}}">{{\Illuminate\Support\Facades\Auth::user()->name}}</option>
                                            @foreach($agents as $agent)
                                                <option value="{{$agent->user->id}}">{{$agent->user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="size">Department Head</label>
                                    <select class="form-control " name="dept_head" id="size">
                                        <option></option>
                                    </select>
                                </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                            <input type="hidden" name="uuid" value="{{Str::uuid()->toString()}}">
                        </form>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    </div>
    <form action="" class="my-3 offset-md-1">
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating">
                <label class="focus-label">Employee ID</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating">
                <label class="focus-label">Employee Name</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus focused">
                <select class="select floating select2-hidden-accessible form-control" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option data-select2-id="3">Select Designation</option>
                    @foreach($positions as $position)
                        <option value="{{$position->id}}">{{$position->emp_position}}</option>
                    @endforeach
                </select>
{{--               --}}
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <button type="submit" class="custom-control btn btn-success"> Search </button>
        </div>
    </div>
    </form>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                @foreach($employee as $emp)
                <div class="col-md-3 col-sm-4 col-12">
                    <div class="card">
                        <div class="card-title mt-3">
                            <a href=""> <i class="fa fa-ellipsis-v float-right mr-3"></i></a>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{asset("/imgs/2017.jpg")}}" alt="" class="rounded-circle" width="90px;" height="90px;">
{{--                        </div>--}}
{{--                        <div class="text-center">--}}
                            <br><b  style="font-size: 18px;">{{$emp->employee_user->name}}</b><br>
                            <span>{{$emp->position->emp_position}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-3 col-sm-4 col-12">
                    <div class="card">
                        <div class="card-title mt-3">
                            <a href=""> <i class="fa fa-ellipsis-v float-right mr-3"></i></a>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{asset("/imgs/2017.jpg")}}" alt="" class="rounded-circle" width="90px;" height="90px;">
{{--                        </div>--}}
{{--                        <div class="text-center">--}}
                            <br><b  style="font-size: 18px;">John Royal Smith</b><br>
                            <span>Web Developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-12">
                    <div class="card">
                        <div class="card-title mt-3">
                            <a href=""> <i class="fa fa-ellipsis-v float-right mr-3"></i></a>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{asset("/imgs/2017.jpg")}}" alt="" class="rounded-circle" width="90px;" height="90px;">
{{--                        </div>--}}
{{--                        <div class="text-center">--}}
                            <br><b  style="font-size: 18px;">John Royal Smith</b><br>
                            <span>Web Developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-12">
                    <div class="card">
                        <div class="card-title mt-3">
                            <a href=""> <i class="fa fa-ellipsis-v float-right mr-3"></i></a>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{asset("/imgs/2017.jpg")}}" alt="" class="rounded-circle" width="90px;" height="90px;">
{{--                        </div>--}}
{{--                        <div class="text-center">--}}
                            <br><b  style="font-size: 18px;">John Royal Smith</b><br>
                            <span>Web Developer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <table class="table">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Join Date</th>
                    <th scope="col">Position</th>
                    <th scope="col">Action</th>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section("scriptcode")
    <script>
        $(document).ready(function () {
            $("#type").change(function () {
                var val = $(this).val();
                @foreach($depts as $dept)
                if (val =={{$dept->id}} ) {
                    $("#size").html("<option value='{{$dept->department_head}}'>{{$dept->department_head->name}}</option>");
                }else if(val=="item0") {
                    $("#size").html( "<option></option>");
                }
                @endforeach
            });
        });
    </script>

@endsection