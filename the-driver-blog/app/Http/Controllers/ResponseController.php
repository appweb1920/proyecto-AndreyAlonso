<?php

namespace App\Http\Controllers;

use App\Publications;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Responses;
use const http\Client\Curl\AUTH_ANY;

class ResponseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show() {

    }

    public function create(Request $request) {
        $user = Auth::user();
        $response = new Responses;
        $response->description = $request->description;
        $response->publication_id = $request->publication_id;
        $response->user_id = $user->id;

        $response->save();

        return redirect()->action('PublicationController@showByID',$response->publication_id);
    }

    public function edit(Request $request) {
        $publication = Publications::find($request->id);

        return view('createResponse')
            ->with('p', $publication);
    }

    public function delete(Request $request){
        $response = Responses::find($request->id);
        $id = $response->publication_id;
        $response->delete();

        return redirect()->action('PublicationController@showByID',$id);
    }

    public function addLike(Request $request){
        $response = Responses::find($request->id);
        $response->likes++;
        $response->updated_at = now();
        $response->save();
        DB::insert('INSERT INTO user_responses_likes(user_id, response_id) VALUES(?,?)', [Auth::user()->id, $response->id]);
        return redirect()->action('PublicationController@showByID',$response->publication_id);

    }
    public function addApprove(Request $request){
        $response = Responses::find($request->id);
        $response->is_approved = true;
        $response->updated_at = now();
        $response->save();
        return redirect()->action('PublicationController@showByID',$response->publication_id);
    }

    public function removeApprove(Request $request) {
        $response = Responses::find($request->id);
        $response->is_approved = false;
        $response->updated_at = now();
        $response->save();
        return redirect()->action('PublicationController@showByID',$response->publication_id);
    }

    public function removeLike(Request $request){
        $response = Responses::find($request->id);
        $response->likes--;
        $response->updated_at = now();
        $response->save();
        DB::delete('DELETE FROM user_responses_likes WHERE user_id = ? AND response_id = ?', [Auth::user()->id, $response->id]);
        return redirect()->action('PublicationController@showByID',$response->publication_id);
    }
}
