@extends("layouts.mainlayout")
@section("title","Guest User Information")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Ticket Detail</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{url("guestUser")}}">Complainer</a></li>
                            <li class="breadcrumb-item active">Ticket Sending History</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="card">
                <div class="col-12 mt-3">
                    <table class="table" id="senthistory">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Ticket ID</th>
                                <th scope="col">Case Type</th>
                                <th scope="col">Sent Date</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach($sentTickets as $user)
                                <tr>
                                    <td>{{$user->userinfo->name}}</td>
                                    <td>{{$user->userinfo->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td><a href="{{ url("tickets/$user->ticket_id") }}" class="text-primary">
                                        {{$user->ticket_id}}</a></td>
                                    <td>{{$user->cases->name}}</td>
                                    <td>{{$user->created_at->format('Y/m/d')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#senthistory').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'collection',
                        text: '<i class="fa fa-download mr-2"></i>Export',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    }
                ],
            } );
        } );
    </script>
@endsection