@extends('index')
@section('content')
    <div class="d-flex flex-column">
        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Birthday</th>
                <th scope="col">Place of Birth</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($response['items'] as $author)
                <tr>
                    <td><a href="{{ route('authors.show', ['id' => $author['id']]) }}">{{ $author['id'] }}</a></td>
                    <td>{{ $author['first_name'] }}</td>
                    <td>{{ $author['last_name'] }}</td>
                    <td>{{ date('d.m.Y.', strtotime($author['birthday'])) }}</td>
                    <td>{{ $author['place_of_birth'] }}</td>
                    <td>
                        <a role="button" class="btn btn-primary btn-sm"
                           href="{{ route('authors.delete', ['id' => $author['id']]) }}">Delete</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        @if($errors->has('hasBooks'))
            <div class="alert alert-danger" role="alert">Cannot delete author since they have published books!</div>
        @endif

        @if($errors->has('error'))
            <div class="alert alert-danger" role="alert">An error occurred while deleting the author!</div>
        @endif
    </div>
@endsection
