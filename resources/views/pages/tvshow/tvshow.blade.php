@extends('layouts.app')
@section('title', $show['original_name'])

@section('content')
    <div class="container mt-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 border border-dark mx-0 px-0 rounded">
                <div class="d-flex">
                    <div class="col-lg-4">
                        <img src="https://image.tmdb.org/t/p/w300/{{ $show['poster_path'] }}" alt="" class="rounded">
                    </div>
                    <div class="col-lg-8 px-5 pt-3">
                        <table class="table-borderless" width="100%">
                            <tr>
                                <td width="30%">Name</td>
                                <td width="10%">:</td>
                                <td width="59%">{{ $show['name'] }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{ $show['status'] }}</td>
                            </tr>
                            <tr>
                                <td>First Air Date</td>
                                <td>:</td>
                                <td>{{ date('d F Y', strtotime($show['first_air_date'])) }}</td>
                            </tr>
                            <tr>
                                <td>Last Air Date</td>
                                <td>:</td>
                                <td>{{ date('d F Y', strtotime($show['last_air_date'])) }}</td>
                            </tr>
                            <tr>
                                <td>Seasons</td>
                                <td>:</td>
                                <td>{{ $show['number_of_seasons'] }}</td>
                            </tr>
                            <tr>
                                <td>Episodes</td>
                                <td>:</td>
                                <td>{{ $show['number_of_episodes'] }}</td>
                            </tr>
                            <tr>
                                <td class="align-top">Synopsis</td>
                                <td class="align-top">:</td>
                                <td class="align-top">
                                    <p>{{ $show['overview'] }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Age Restricted</td>
                                <td>:</td>
                                <td>{{ $show['adult'] == true ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <td>Popularity</td>
                                <td>:</td>
                                <td>{{ $show['popularity'] }}</td>
                            </tr>
                            <tr>
                                <td>Rating</td>
                                <td>:</td>
                                <td>{{ $show['vote_average'] }}</td>
                            </tr>
                            <tr>
                                <td class="align-top">Genre</td>
                                <td class="align-top">:</td>
                                <td>
                                    @foreach ($show['genres'] as $genre)
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

            <div class="d-flex mt-lg-5 justify-content-evenly">
                <div>
                    <button type="button" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Add</button>
                </div>
                {{-- <div>
                                <button type="button" class="btn btn-warning">Edit Your Score</button>
                            </div> --}}
                <div>
                    <button type="button" class="btn btn-danger">
                        <i class="bi bi-x"></i> Remove
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection
