<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $primaryKey = "id";

    protected $fillable = [
        'name','description','slug'
    ];

    public function scopeSearch($query,$search)
    {
        return $query->where('name','like','%'. $search . '%')
                     ->orWhere('description','like','%'. $search . '%')
                     ->orWhere('slug','like','%'. $search . '%');


    }
   
}

