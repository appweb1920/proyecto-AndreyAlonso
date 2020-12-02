<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responses extends Model
{
    protected  $table = "responses";
    protected $fillable = ['description', 'user_id', 'publication_id', 'likes', 'is_approved'];
}
