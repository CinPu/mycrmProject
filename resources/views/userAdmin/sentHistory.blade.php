@extends("layouts.app")
@section("title","Guest User Information")
@section("csscode")
    <style>
        .dt-button{
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
@endsection
@section("content")
    <div class="card">
        <div class="col-12">
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
@endsection
@section("scriptcode")
    <script>
        $(document).ready(function() {
            $('#senthistory').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
            } );
        } );
    </script>
@endsection