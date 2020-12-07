<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use  App\Publications;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(){
        $publications = Publications::all()->sortByDesc('likes');
        return view('publications')->with('publications', $publications);
    }
    public function showByID(Request  $request){
        $publication = Publications::find($request->id);
        $publications = Publications::all();
        $psqlGetBypublicationID = 'SELECT r.id, r.user_id, description, u.name, r.publication_id, r.likes, r.is_approved, r.created_at
                                    FROM responses r INNER JOIN users u ON r.user_id = u.id WHERE r.publication_id = ? ORDER BY likes DESC';
        $responses =  DB::select($psqlGetBypublicationID,[$publication->id]);

        $psqlGetUserLikes = 'SELECT response_id FROM user_responses_likes WHERE user_id = ?';
        $userLikes = DB::select($psqlGetUserLikes, [Auth::user()->id]);
        if(!is_null($publication)) {
            return view('publication')->with('p', $publication)->with('responses', $responses)->with('userLikes', $userLikes);
        }
        return redirect('publications');
    }

    public function create(Request $request){
//        $request->validate([
//            'file' => 'required|image'
//        ]);
        $publication = new Publications;
        $publication->title = $request->title;
        $publication->image = $request->file('image')->store('public/imagenes');

        $exist = DB::table('publications')->select('id')
            ->where('title','=', $publication->title)
            ->exists();
        if($exist){
            return redirect()->back();
        }
        $url = Storage::url($publication->image);
        $publication->save();
        return redirect('publications');
    }
}
