<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Person;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $userPeople = Person::where('user_id', Auth::user()->id)->get();
        $userShows = TvShow::where('user_id', Auth::user()->id)->get();
        $userMovies = Movie::where('user_id', Auth::user()->id)->get();

        $people = [];

        foreach ($userPeople as $userPerson) {
            $id = $userPerson['person_id'];
            $personResponse = Http::get("https://api.themoviedb.org/3/person/" . $id . "?api_key=2e642658089918c920af9adc5dd79a54&language=en-US");

            $personTemp = json_decode($personResponse, true);
            $personTemp['relation_id'] = $userPerson['id'];
            array_push($people, $personTemp);
        }

        $tvShows = [];

        foreach ($userShows as $userShow) {
            $id = $userShow['show_id'];
            $tvShowResponse = Http::get("https://api.themoviedb.org/3/tv/" . $id . "?api_key=2e642658089918c920af9adc5dd79a54&language=en-US");

            $tvShowTemp = json_decode($tvShowResponse, true);
            $tvShowTemp['relation_id'] = $userShow['id'];
            array_push($tvShows, $tvShowTemp);
        }

        $movies = [];

        foreach ($userMovies as $userMovie) {
            $id = $userMovie['movie_id'];
            $movieResponse = Http::get("https://api.themoviedb.org/3/movie/" . $id . "?api_key=2e642658089918c920af9adc5dd79a54&language=en-US");

            $movieTemp = json_decode($movieResponse, true);
            $movieTemp['relation_id'] = $userMovie['id'];
            array_push($movies, $movieTemp);
        }

        return view('pages.list.user_list', [
            "people" => $people,
            "userPeople" => $userPeople,
            "shows" => $tvShows,
            "userShows" => $userShows,
            "movies" =>$movies,
            "userMovies" =>$userMovies,
        ]);
    }
}
