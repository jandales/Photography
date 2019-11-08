<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    
    protected $primarykey = "id";

    protected $fillable = ['fullname','email_to','email_from','subject','message','isRead','type', 'status'];
}
