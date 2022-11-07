@extends('index')
@section('content')
    <div class="mt-5 d-flex flex-column justify-content-center align-items-center">

        @error('credentials')
        <div class="alert alert-danger" role="alert">Invalid username or password!</div>
        @enderror

        <form method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>
                <div class="col-md-6">
                    <input id="email" type="email" name="email" class="form-control" required
                           autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password:</label>
                <div class="col-md-6">
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
        </form>
    </div>
@endsection
