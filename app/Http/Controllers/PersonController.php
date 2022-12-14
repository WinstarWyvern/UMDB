<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = [];
        for ($i = 1; $i <= 5; $i++) {
            $peopleResponse = Http::get("https://api.themoviedb.org/3/person/popular?api_key=2e642658089918c920af9adc5dd79a54&language=en-US&page" . $i);
            $peopleTemp = $peopleResponse->json();
            $people = array_merge($people, $peopleTemp["results"]);
        }

        $people = $this->paginate($people)->withPath('');
        return view('pages.people.people', [
            'people' => $people
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
        $user_id = Auth::user()->id;
        $person_id = $request->person_id;
        Person::create([
            "person_id" => $request->person_id,
            "user_id" => $user_id,
        ]);

        return redirect('/people/' . $person_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personResponse = Http::get("https://api.themoviedb.org/3/person/" . $id . "?api_key=2e642658089918c920af9adc5dd79a54&language=en-US");
        $personTemp = $personResponse->json();

        if(Auth::user()){
            $userPerson = Person::where('user_id', Auth::user()->id)->where('person_id', $id)->first();
        }
        else{
            $userPerson = null;
        }

        return view('pages.people.person', [
            "person" => $personTemp,
            "userPerson" => $userPerson,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedPerson = Person::where('id', $id)->first();
        $person_id = $deletedPerson->person_id;
        $deletedPerson->delete();

        return redirect('/people/' . $person_id);
    }
}
