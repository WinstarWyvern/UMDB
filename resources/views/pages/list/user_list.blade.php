@extends('layouts.app')
@section('title', 'My List')

@section('content')
    <div class="container text-white">
        <div class="row justify-content-center col-md-10">
            <ul class="nav nav-pills mb-3 fs-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-movie-tab" data-bs-toggle="pill" data-bs-target="#pills-movie"
                        type="button" role="tab" aria-controls="pills-movie" aria-selected="true">
                        Movie List
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-tvshow-tab" data-bs-toggle="pill" data-bs-target="#pills-tvshow"
                        type="button" role="tab" aria-controls="pills-tvshow" aria-selected="false">
                        Tv Show List
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-people-tab" data-bs-toggle="pill" data-bs-target="#pills-people"
                        type="button" role="tab" aria-controls="pills-people" aria-selected="false">
                        Favorite People
                    </button>
                </li>
            </ul>
            <div class="tab-content text-white" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-movie" role="tabpanel" aria-labelledby="pills-movie-tab"
                    tabindex="0">Movie List
                </div>
                <div class="tab-pane fade" id="pills-tvshow" role="tabpanel" aria-labelledby="pills-tvshow-tab"
                    tabindex="0">
                    Tv Show List
                </div>
                <div class="tab-pane fade" id="pills-people" role="tabpanel" aria-labelledby="pills-people-tab"
                    tabindex="0">

                    <div class="row text-dark">
                        @if (count($people) <= 0)
                            <h1>No Favorite People Yet</h1>
                        @else
                            @foreach ($people as $person)
                                <div class="col-lg-3 my-2">
                                    <div class="card">
                                        <img src="https://image.tmdb.org/t/p/w185/{{ $person['profile_path'] }}"
                                            class="card-img-top img-fluid">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $person['name'] }}</h5>
                                            <p class="card-text">&#x2605; {{ $person['popularity'] }}</p>
                                            <div>
                                                <a href="/people/{{ $person['id'] }}" class="btn btn-primary">Read
                                                    more..</a>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <form action="{{ route('people.destroy', $person['relation_id']) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <div>
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-star-fill"></i> Remove Favorite</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
