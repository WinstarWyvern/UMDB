<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = [];
        for ($i = 1; $i <= 5; $i++) {
            $moviesResponse = Http::get("https://api.themoviedb.org/3/movie/top_rated?api_key=2e642658089918c920af9adc5dd79a54&language=en-US&page=" . $i);
            $moviesTemp = $moviesResponse->json();
            $movies = array_merge($movies, $moviesTemp["results"]);
        }

        $movies = $this->paginate($movies)->withPath('');

        return view('pages.movie.movies', [
            "movies" => $movies,
        ]);
    }

    public function paginate($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedScore = $request->validate([
            "score" => 'required|digits_between:0,10'
        ]);

        $user_id = Auth::user()->id;
        $movie_id = $request->movie_id;
        Movie::create([
            "movie_id" => $request->movie_id,
            "user_id" => $user_id,
            "score" => $validatedScore['score'],
        ]);

        return redirect('/movies/' . $movie_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movieResponse = Http::get("https://api.themoviedb.org/3/movie/" . $id . "?api_key=2e642658089918c920af9adc5dd79a54&language=en-US");
        $movieTemp = $movieResponse->json();

        if(Auth::user()) {
            $userMovie = Movie::where('user_id', Auth::user()->id)->where('movie_id', $id)->first();
        }
        else {
            $userMovie = null;
        }

        return view('pages.movie.movie', [
            "movie" => $movieTemp,
            "userMovie" => $userMovie
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedScore = $request->validate([
            "score" => 'required|digits_between:0,10'
        ]);

        $movie_id = $request->movie_id;

        Movie::where('id', $id)->update($validatedScore);

        return redirect('/movies/' . $movie_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedMovie = Movie::where('id', $id)->first();
        $movie_id = $deletedMovie->movie_id;
        $deletedMovie->delete();

        return redirect('/movies/' . $movie_id);
    }
}
