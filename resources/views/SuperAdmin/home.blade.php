@extends("layouts.app")
@section("title","SuperAdmin Home Page")
@section("content")
    <div class="container-fluid">
        <table class="table" id="usertable">
            <thead>
            <th>User Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created_at</th>
            </thead>
            <tbody>
            @foreach($alluser as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td> <a href="#" data-toggle="modal" data-target="#{{$user->name}}" style="text-decoration: none">

                        @if(count($user->roles->pluck("name"))>0)
                            <span>{{ucfirst($user->roles->pluck("name")[0])}}</span>
                        @else
                            <span>No Role</span>
                        @endif
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="{{$user->name}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Assing Role</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <strong>User Current Role:</strong><br>
                                        @foreach($roles as $role)
                                            @if($user->hasRole($role->name))
                                             <i class="fa fa-check"></i>   <span>{{$role->name}}</span><br>
                                                @endif
                                        @endforeach
                                        <form method="post" action="{{url("/role/assign/$user->id")}}" class="my-3">
                                            {{csrf_field()}}
                                            <label for="role">Assign Role </label>
                                            <select class=" form-control" name="rolename">
                                                    @foreach($roles as $role)
                                                    <option value="{{$role->name}}">
                                                    {{$role->name}}
                                                    </option>
                                                    @endforeach
                                            </select>
                                            <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-danger float-right" data-toggle="modal" data-target="#rm{{$user->name}}" style="text-decoration: none"><i class="fa fa-trash mr-2"></i>Remove</a>
                        <div class="modal fade" id="rm{{$user->name}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Remove Role</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <strong>User Current Role:</strong>
                                        @if(count($user->roles->pluck("name"))>0)
                                            <span>{{ucfirst($user->roles->pluck("name")[0])}}</span>
                                        @else
                                            <span>No Role</span>
                                        @endif
                                        <form method="POST" id="remove" action="{{url("/role/remove/$user->id")}}" class="my-3">
                                            {{csrf_field()}}
                                            <label for="role">Remove Role </label><br>
                                                @foreach($roles as $role)
                                                    @if($user->hasRole($role->name))
                                                    <input type="checkbox" value="{{$role->name}}" name="rolename">
                                                    <label for="">{{$role->name}}</label><br>
                                                    @endif
                                                @endforeach
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div></td>
                    <td>{{$user->created_at->toFormattedDateString()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection
@section("scriptcode")
    <script>
    $(document).ready(function() {
    $('#usertable').DataTable();
    } );
    </script>
@endsection
