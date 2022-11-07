@extends('index')
@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">

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
                    <select id="author" name="author" class="custom-select" required>
                        <option selected disabled hidden value="">Select author</option>
                        @foreach($response['items'] as $author)
                            <option
                                value="{{ $author['id'] }}">{{ $author['first_name'] }} {{ $author['last_name'] }}</option>
                        @endforeach
                        <option value="" id="loadMore" style="color: blue">Load more</option>
                    </select>
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

@push('scripts')
    <script>
        let page = 1;

        $('#loadMore').click(() => {
            loadMoreAuthors(page = page + 1);
        });

        function loadMoreAuthors(page) {
            const authorSelect = document.getElementById('author');

            $.ajax({
                type: 'GET',
                url: '/authors/load/' + page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,
                contentType: false,
                success:
                    function (data) {
                        // remove the Load more (in order to place it at the bottom of the new list)
                        const loadMoreOption = authorSelect.removeChild(document.getElementById('loadMore'));

                        // authors fetched from the API
                        const authors = data['items'];

                        for (let i = 0; i < authors.length; i++) {
                            const author = authors[i];
                            const el = document.createElement('option');
                            el.textContent = author['first_name'] + ' ' + author['last_name'];
                            el.value = author['id'];
                            // add the fetched authors to the <select> dropdown
                            authorSelect.appendChild(el);
                        }

                        if (page !== data['total_pages']) {
                            // if there are more authors - append the Load more, otherwise don't
                            authorSelect.appendChild(loadMoreOption);
                        }

                        // after Load more click - dropdown closes so "Select author" needs to be selected to be UI friendly
                        authorSelect.options[0].selected = true;
                    },
                error:
                    function (error) {
                        console.log(error);
                    },
            });
        }
    </script>
@endpush
