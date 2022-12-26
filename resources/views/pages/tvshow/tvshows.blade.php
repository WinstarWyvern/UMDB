@extends('layouts.app')
@section('title', 'Tv Shows')

@section('content')
    <div>
        <h1 class="text-center mb-2">All Tv Show</h1>
    </div>

    <div class="container">
        <div class="my-3">
            {{ $shows->links() }}
        </div>

        <div class="row">
            @foreach ($shows as $show)
                <div class="col-lg-3 my-2">
                    <div class="card">
                        <img src="https://image.tmdb.org/t/p/w185/{{ $show['poster_path'] }}" class="card-img-top img-fluid">
                        <div class="card-body">
                            <h5 class="card-title">{{ $show['name'] }}</h5>
                            <p class="card-text">{{ substr($show['overview'], 0, 100) }}...</p>
                            <a href="{{ route('tvshows.show', $show['id']) }}" class="btn btn-primary">
                                Read more..
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="my-3">
            {{ $shows->links() }}
        </div>
    </div>
@endsection
