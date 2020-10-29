@extends("layouts.app")
@section("title","Role Management")
@section("content")
    <div class="container-fluid">
        <table class="table" id="usertable">
            <thead>
            <th>User Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
            </thead>
            <tbody>
            @foreach($employees as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>

                            @if(count($user->roles->pluck("name"))>0)
                            @foreach($roles as $role)
                                @if($user->hasRole($role->name))
                                  <span style="font-size: 13px;color: #9c27b0">{{$role->name}}</span>,
                                @endif
                            @endforeach
{{--                                <span>{{ucfirst($user->roles->pluck("name")[0])}}</span>--}}
                            @else
                                <span>No Role</span>
                            @endif
                    </td>
                    <td>
                        <button class="btn btn-primary rounded" data-toggle="modal" data-target="#{{$user->name}}" style="text-decoration: none">Add Role</button>
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
                                            <label for="role">Assign Role </label><br>
                                                @foreach($roles as $role)
                                                <input type="checkbox" value="{{$role->name}}" name="rolename[]">
                                                <label for="">{{$role->name}}</label><br>
                                                @endforeach
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-danger rounded" data-toggle="modal" data-target="#rm{{$user->name}}" style="text-decoration: none"><i class="fa fa-trash mr-2"></i>Remove Role</button>
                        <div class="modal fade" id="rm{{$user->name}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Remove Role</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" id="remove" action="{{url("/role/remove/$user->id")}}" class="my-3">
                                            {{csrf_field()}}
                                            <label for="role">Remove Role </label><br>
                                            @foreach($roles as $role)
                                                @if($user->hasRole($role->name))
                                                    <input type="checkbox" value="{{$role->name}}" name="rolename[]">
                                                    <label for="">{{$role->name}}</label><br>
                                                @endif
                                            @endforeach
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Remove</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div></td>
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
