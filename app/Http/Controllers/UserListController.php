<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

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

        $people = [];

        foreach ($userPeople as $userPerson) {
            $id = $userPerson['person_id'];
            $personResponse = Http::get("https://api.themoviedb.org/3/person/" . $id . "?api_key=2e642658089918c920af9adc5dd79a54&language=en-US");
            $personTemp = json_decode($personResponse, true);
            $personTemp['relation_id'] = $userPerson['id'];
            array_push($people, $personTemp);
        }

        return view('pages.list.user_list', [
            "people" => $people,
            "userPeople" => $userPeople,
        ]);
    }
}
