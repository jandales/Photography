<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';

    public  $fillable = [
            'fullname','email','content','post_id',
    ];

    public function ToDate()
    {
        return date('M d Y',strtotime($this->created_at));
    }


    public function Post()
    {
        return $this->belongsTo('App\Post');
    }


    public function status()
    {
        if ($this->status == 0)
        {
            return "Unapproved";
        }
        
        return "Approved";
    }
    public function reply()
    {    
         
        return Comment::find($this->respondto);
    }

    public function replyto(){
       
        return $this->hasOne('App\Comment', 'id', 'respondto');
    }



}
