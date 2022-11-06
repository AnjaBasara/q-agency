@extends('index')
@section('content')
    <div class="h-100 d-flex flex-column justify-content-center align-items-center">

        @if($errors->has('error'))
            <div class="alert alert-danger" role="alert">An error occurred while creating a new book!</div>
        @endif

        <h3 class="mb-5">New Book</h3>

        <form method="POST" action="{{ route('books.store') }}" autocomplete="off">
            @csrf

            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">Title:</label>
                <div class="col-md-6">
                    <input id="title" type="text" name="title" class="form-control" required autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="author" class="col-md-4 col-form-label text-md-right">Author:</label>
                <div class="col-md-6">
                    <input id="author" type="number" name="author" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="releaseDate" class="col-md-4 col-form-label text-md-right">Release Date:</label>
                <div class="col-md-6">
                    <input id="releaseDate" type="text" name="releaseDate" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">Description:</label>
                <div class="col-md-6">
                    <textarea id="description" name="description" class="form-control" required></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="isbn" class="col-md-4 col-form-label text-md-right">ISBN:</label>
                <div class="col-md-6">
                    <input id="isbn" type="text" name="isbn" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="format" class="col-md-4 col-form-label text-md-right">Format:</label>
                <div class="col-md-6">
                    <input id="format" type="text" name="format" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="numberOfPages" class="col-md-4 col-form-label text-md-right">Number of pages:</label>
                <div class="col-md-6">
                    <input id="numberOfPages" type="number" name="numberOfPages" class="form-control" required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
