@extends('layouts.app')
@section('title', $person['name'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 border border-dark mx-0 px-0 rounded bg-white">
                <div class="d-flex">
                    <div class="col-lg-3">
                        <img src="https://image.tmdb.org/t/p/w200/{{ $person['profile_path'] }}" alt=""
                            class="rounded">
                    </div>
                    <div class="col-lg-9 px-5 pt-3">
                        <table class="table-borderless" width="100%">
                            <tr>
                                <td width="30%">Name</td>
                                <td width="10%">:</td>
                                <td width="59%">{{ $person['name'] }}</td>
                            </tr>
                            <tr>
                                <td>Alias</td>
                                <td>:</td>
                                <td>
                                    @if (isset($person['also_known_as']))
                                        @foreach ($person['also_known_as'] as $alias)
                                            @if ($loop->last)
                                                {{ $alias }}
                                            @else
                                                {{ $alias }},
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Birthday Date</td>
                                <td>:</td>
                                <td>{{ date('d F Y', strtotime($person['birthday'])) }}</td>
                            </tr>
                            <tr>
                                <td>Place of Birth</td>
                                <td>:</td>
                                <td>{{ $person['place_of_birth'] }}</td>
                            </tr>
                            <tr>
                                <td width="30%">Gender</td>
                                <td width="10%">:</td>
                                <td width="59%">{{ $person['gender'] == 1 ? 'Female' : 'Male' }}</td>
                            </tr>
                            <tr>
                                <td>Popularity</td>
                                <td>:</td>
                                <td>{{ $person['popularity'] }}</td>
                            </tr>
                            <tr>
                                <td class="align-top">Biography</td>
                                <td class="align-top">:</td>
                                <td class="align-top">
                                    <p>{{ $person['biography'] }}</p>
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

                <div>
                    <button type="button" class="btn btn-danger">
                        <i class="bi bi-x"></i> Remove
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection
