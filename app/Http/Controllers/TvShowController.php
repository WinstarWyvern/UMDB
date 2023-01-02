<?php

namespace App\Http\Controllers;

use App\Models\TvShow;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;


class TvShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shows = [];
        for ($i = 1; $i <= 5; $i++) {
            $showsResponse = Http::get("https://api.themoviedb.org/3/tv/top_rated?api_key=2e642658089918c920af9adc5dd79a54&language=en-US&page=" . $i);
            $showsTemp = $showsResponse->json();
            $shows = array_merge($shows, $showsTemp["results"]);
        }

        $shows = $this->paginate($shows)->withPath('');
        return view('pages.tvshow.tvshows', [
            'shows' => $shows
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
        $show_id = $request->show_id;
        TvShow::create([
            "show_id" => $request->show_id,
            "user_id" => $user_id,
            "score" => $validatedScore['score'],
        ]);

        return redirect('/tvshows/' . $show_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tvshowResponse = Http::get("https://api.themoviedb.org/3/tv/" . $id . "?api_key=2e642658089918c920af9adc5dd79a54&language=en-US");
        $tvshowTemp = $tvshowResponse->json();

        if(Auth::user()) {
            $userShow = TvShow::where('user_id', Auth::user()->id)->where('show_id', $id)->first();
        }
        else {
            $userShow = null;
        }

        return view('pages.tvshow.tvshow', [
            "show" => $tvshowTemp,
            "userShow" => $userShow
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

        $show_id = $request->show_id;

        TvShow::where('id', $id)->update($validatedScore);

        return redirect('/tvshows/' . $show_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedShow = TvShow::where('id', $id)->first();
        $show_id = $deletedShow->show_id;
        $deletedShow->delete();

        return redirect('/tvshows/' . $show_id);
    }
}
