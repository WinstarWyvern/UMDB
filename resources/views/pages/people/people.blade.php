@extends('layouts.app')
@section('title', 'People')

@section('content')
    <div>
        <h1 class="text-center mb-2">All People</h1>
    </div>

    <div class="container">
        <div class="my-3">
            {{ $people->links() }}
        </div>

        <div class="row">
            @foreach ($people as $person)
                <div class="col-lg-3 my-2">
                    <div class="card">
                        <img src="https://image.tmdb.org/t/p/w185/{{ $person['profile_path'] }}" class="card-img-top img-fluid">
                        <div class="card-body">
                            <h5 class="card-title">{{ $person['name'] }}</h5>
                            <p class="card-text">&#x2605; {{ $person['popularity'] }}</p>
                            <a href="/people/{{ $person["id"] }}" class="btn btn-primary">Read more..</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="my-3">
            {{ $people->links() }}
        </div>
    </div>
@endsection
