@extends('index')
@section('content')
    <div class="d-flex flex-column">

        <div class="mb-5 d-flex justify-content-center">
            <a role="button" class="btn btn-primary" href="{{ route('books.create') }}">Add a new Book</a>
        </div>

        @if($errors->has('hasBooks'))
            <div class="alert alert-danger" role="alert">Cannot delete author since they have published books!</div>
        @endif

        @if($errors->has('error'))
            <div class="alert alert-danger" role="alert">An error occurred while deleting the author!</div>
        @endif

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

        <ul class="pagination d-flex justify-content-center">
            <li class="page-item">
                <a class="page-link" href="{{ route('authors.page', ['page' => $page - 1]) }}">Previous</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ route('authors.page', ['page' => $page + 1]) }}">Next</a>
            </li>
        </ul>
    </div>
@endsection
