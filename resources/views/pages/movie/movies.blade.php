@extends('layouts.app')
@section('title', 'Movies')

@section('content')
    <div>
        <h1 class="text-center mb-2">All Movies</h1>
    </div>

    <div class="container">
        <div class="my-3">
            {{ $movies->links() }}
        </div>

        <div class="row">
            @foreach ($movies as $movie)
                <div class="col-lg-3 my-2">
                    <div class="card">
                        <img src="https://image.tmdb.org/t/p/w185/{{ $movie['poster_path'] }}" class="card-img-top img-fluid">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie['title'] }}</h5>
                            <p class="card-text">{{ substr($movie['overview'], 0, 100) }}...</p>
                            <a href="{{ route('movies.show', $movie['id']) }}" class="btn btn-primary">Read more..</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="my-3">
            {{ $movies->links() }}
        </div>
    </div>
@endsection
