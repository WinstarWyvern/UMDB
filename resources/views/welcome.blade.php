@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mb-sm-4">
                    <p class="fs-1 text-center text-white">
                        Welcome to Universal Movie Database, Where you can find any kind of movies
                    </p>
                </div>
                <div class="mb-sm-4">
                    <img src={{ url('/asset/image/moviemixposter.jpg') }} alt="">
                </div>
                <div class="m-auto text-center">
                    <a href="/movies">
                        <button class="btn btn-success btn-lg">
                            Go To Movie List
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
