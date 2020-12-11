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

    public function delete(Request  $request){
        $p = Publications::find($request->id);
        $p->delete();

        $publications = Publications::all()->sortByDesc('likes');
        return view('publications')->with('publications', $publications);
    }

    public function showByID(Request  $request){
        $publication = Publications::find($request->id);
        $publications = Publications::all();
        $psqlGetBypublicationID = 'SELECT r.id, r.user_id, description, u.name, r.publication_id, r.likes, r.is_approved, r.created_at
                                    FROM responses r INNER JOIN users u ON r.user_id = u.id WHERE r.publication_id = ? ORDER BY is_approved DESC, likes DESC';
        $responses =  DB::select($psqlGetBypublicationID,[$publication->id]);

        $psqlGetUserLikes = 'SELECT response_id FROM user_responses_likes WHERE user_id = ?';
        $psqlGetUserPublicationLikes =  'SELECT publication_id FROM user_publications_likes WHERE user_id = ?';
        $userLikes = DB::select($psqlGetUserLikes, [Auth::user()->id]);
        $userPublicationLikes = DB::select($psqlGetUserPublicationLikes, [Auth::user()->id]);
        if(!is_null($publication)) {
            return view('publication')->with('p', $publication)->with('responses', $responses)->with('userLikes', $userLikes)->with('userLikePublications', $userPublicationLikes);
        }
        return redirect('publications');
    }

    public function create(Request $request){
        $publication = new Publications;
        $publication->title = $request->title;
        $publication->image = $request->file('image')->store('public/imagenes');
        $publication->user_id = Auth::user()->id;

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

    public function removeLike(Request $request){
        $publication = Publications::find($request->id);
        $publication->likes--;
        $publication->updated_at = now();
        $publication->save();
        DB::delete('DELETE FROM user_publications_likes WHERE user_id = ? AND publication_id = ?', [Auth::user()->id, $publication->id]);
        return redirect()->action('PublicationController@showByID',$publication->id);
    }
    public function addLike(Request $request){
        $publication = Publications::find($request->id);
        $publication->likes++;
        $publication->updated_at = now();
        $publication->save();
        DB::insert('INSERT INTO user_publications_likes(user_id, publication_id) VALUES(?,?)', [Auth::user()->id, $publication->id]);
        return redirect()->action('PublicationController@showByID',$publication->id);
    }
}
