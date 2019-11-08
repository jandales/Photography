<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = "photos";
    protected $primarykey = "id";

    protected $fillable = [
        'name','location','album_id',
    ];

    public function AlbumPhotos()
    {
        
    }
}
