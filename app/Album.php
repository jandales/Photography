<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = "albums";
    protected $primarykey = "id";
    

    public $fillable = [
        'name','category_id','featured_image','description','tags','user_id','slug','published'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function status()
    {
        if($this->published == 0)
        {
            return "Unpublish";
        }

        return "Published";

    }

    public function scopeSearch($query,$search)
    {
        return $query->where('name','like','%'. $search . '%');       
    }

    public function exist($id,$name)
    {
        if($this->id == $id && $this->name == $name)
        {  
            return true;
        }
        
        return false;
    }

    


}
