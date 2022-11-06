@extends('index')
@section('content')
    <div class="d-flex flex-column align-items-center">
        <div class="card w-50 mb-5">
            <div class="card-body">
                <h5 class="card-title">{{ $author['first_name'] }} {{ $author['last_name'] }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    {{ $author['place_of_birth'] }} |
                    {{ $author['gender'] }} |
                    {{ date('d.m.Y.', strtotime($author['birthday'])) }}
                </h6>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">{{ $author['biography'] }}</p>
            </div>
        </div>

        @if($errors->has('error'))
            <div class="alert alert-danger" role="alert">An error occurred while deleting a book!</div>
        @endif

        @if($author['books'])
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Release Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Format</th>
                    <th scope="col">Number of pages</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($author['books'] as $book)
                    <tr>
                        <td>{{ $book['id'] }}</td>
                        <td>{{ $book['title'] }}</td>
                        <td>{{ date('d.m.Y.', strtotime($book['release_date'])) }}</td>
                        <td>{{ $book['description'] }}</td>
                        <td>{{ $book['isbn'] }}</td>
                        <td>{{ $book['format'] }}</td>
                        <td>{{ $book['number_of_pages'] }}</td>
                        <td>
                            <a role="button" class="btn btn-primary btn-sm"
                               href="{{ route('books.delete', ['id' => $book['id']]) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div>This author has no published books.</div>
        @endif
    </div>
@endsection
