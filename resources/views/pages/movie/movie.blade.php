@extends('layouts.app')
@section('title', $movie['original_title'])

@section('content')
    <div class="container mt-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 border border-dark mx-0 px-0 rounded bg-white">
                <div class="d-flex">
                    <div class="col-lg-4">
                        <img src="https://image.tmdb.org/t/p/w300/{{ $movie['poster_path'] }}" alt="" class="rounded">
                    </div>
                    <div class="col-lg-8 px-5 pt-3">
                        <table class="table-borderless" width="100%">
                            <tr>
                                <td width="30%">Title</td>
                                <td width="10%">:</td>
                                <td width="59%">{{ $movie['title'] }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{ $movie['status'] }}</td>
                            </tr>
                            <tr>
                                <td>Release Date</td>
                                <td>:</td>
                                <td>{{ date('d F Y', strtotime($movie['release_date'])) }}</td>
                            </tr>
                            <tr>
                                <td class="align-top">Synopsis</td>
                                <td class="align-top">:</td>
                                <td class="align-top">
                                    <p>{{ $movie['overview'] }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Age Restricted</td>
                                <td>:</td>
                                <td>{{ $movie['adult'] == true ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <td>Popularity</td>
                                <td>:</td>
                                <td>{{ $movie['popularity'] }}</td>
                            </tr>
                            <tr>
                                <td>Rating</td>
                                <td>:</td>
                                <td>{{ $movie['vote_average'] }}</td>
                            </tr>
                            @if (auth()->check())
                                <tr>
                                    <td>My Rating</td>
                                    <td>:</td>
                                    <td>{{ $userMovie['score'] ?? '-' }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="align-top">Genre</td>
                                <td class="align-top">:</td>
                                <td>
                                    @foreach ($movie['genres'] as $genre)
                                        @if ($loop->last)
                                            {{ $genre['name'] }}
                                        @else
                                            {{ $genre['name'] }},
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            @if (auth()->check())
                @if (!isset($userMovie['id']))
                    <div class="d-flex mt-lg-5 justify-content-center">
                        <div>
                            <form action="{{ route('movies.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control" aria-describedby="save-score-btn"
                                        name="score" placeholder="Input Score [1-10]">
                                    <button class="btn btn-success" type="submit" id="save-score-btn">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="d-flex mt-lg-5 justify-content-center">
                        <div>
                            <form action="{{ route('movies.update', $userMovie['id']) }}" method="POST">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control" aria-describedby="save-score-btn"
                                        name="score" placeholder="Input New Score [1-10]">
                                    <button class="btn btn-success" type="submit" id="save-score-btn">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        @if (isset($userMovie))
                            <form action="{{ route('movies.destroy', $userMovie['id']) }}" method="POST">
                                @csrf
                                @method('delete')
                                <div>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-x"></i> Remove</button>
                                </div>
                            </form>
                        @endif
                    </div>
                @endif
            @endif

        </div>
    </div>
@endsection
