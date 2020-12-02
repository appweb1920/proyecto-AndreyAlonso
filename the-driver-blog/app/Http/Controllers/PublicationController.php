<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use  App\Publications;

class PublicationController extends Controller
{
    public function show(){
        $publications = Publications::all()->sortByDesc('likes');
        return view('publications')->with('publications', $publications);
    }
    public function showByID(Request  $request){
        $publication = Publications::find($request->id);
        $publications = Publications::all();
        $psqlGetBypublicationID = "SELECT r.id, description, name, publication_id, likes, is_approved, r.created_at FROM responses r INNER JOIN users u ON u.id = r.user_id WHERE publication_id = $publication->id ORDER BY likes DESC";
        $responses =  DB::select($psqlGetBypublicationID);


        if(!is_null($publication)) {
            return view('publication')->with('p', $publication)->with('responses', $responses);
        }
        return redirect('publications');
    }

    public function create(Request $request){
        $publication = new Publications;
        $publication->title = $request->title;
        $publication->image = "imagen.jpg";

        $exist = DB::table('publications')->select('id')
            ->where('title','=', $publication->title)
            ->exists();
        if($exist){
            return redirect()->back();
        }
        $publication->save();
        return redirect('publications');
    }
}