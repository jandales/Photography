<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $primarykey = "id";

    protected $fillable = [
        'title','content','category_id','user_id','tags','slug','isPublished','featured_image',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function Category()
    {
        return $this->belongsTo('App\Category');
    }

    public function Comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function exist($id,$title)
    {
        if($this->id == $id && $this->title == $title)
        {
             return  true;
        }          
        return false;
    }

    public function status($id)
    {
        switch ($id) {
            case 0:
                return "Draft";
                
            case 1:
                return "Unpublished";

            case 2:
                return "Published";  
            
          
          
        }
    }

    public function scopeSearch($query,$search)
    {
        return $query->where('title','like','%' . $search . '%')
                    ->orWhere('tags','like','%' . $search . '%')
                    ->orWhere('slug','like','%' . $search . '%');
                
    }

    public function ToDate($timespan)
    {
        return date('M d Y',strtotime($timespan));
    }

    public function Created_at()
    {
        return date('M D Y',strtotime($this->created_at));
    }


}
