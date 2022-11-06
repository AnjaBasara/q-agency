@extends('index')
@section('content')
    <div class="d-flex justify-content-center">
        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Birthday</th>
                <th scope="col">Place of Birth</th>
            </tr>
            </thead>
            <tbody>
            @foreach($response['items'] as $author)
                <tr>
                    <td>{{ $author['id'] }}</td>
                    <td>{{ $author['first_name'] }}</td>
                    <td>{{ $author['last_name'] }}</td>
                    <td>{{ date('d.m.Y.', strtotime($author['birthday'])) }}</td>
                    <td>{{ $author['place_of_birth'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
