<?php

namespace App\Http\Controllers;

use App\Publications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Responses;

class ResponseController extends Controller
{
    public function show() {

    }

    public function create(Request $request) {
        $response = new Responses;
        $response->description = $request->description;
        $response->publication_id = $request->publication_id;
        $response->user_id = 1;
        $response->save();

//        return redirect('publication/')->with('id',$response->publication_id);
        return redirect()->action('PublicationController@showByID',$response->publication_id);
    }

    public function edit(Request $request) {
        $publication = Publications::find($request->id);

        return view('createResponse')
            ->with('p', $publication);
    }
}
