<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;


    protected $table = "users";
    protected $primaryKey = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','email', 'password','firstname','lastname','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function postcount()
    {
        return $this->hasMany('App\Post');
    }

    public function Role()
    {
       switch($this->role)
       {
           case 1:
                return "Administrator"; 
           break;

           case 2:
                return "Editor"; 
           break;
           
           case 3:
                return "Author"; 
           break;
       }
    }

    public function IsAdmin()
    {
        if($this->role == 1)
        {
            return true;
        }

        return false;
    }

    public function fullname()
    {
        $name = $this->firstname ." ". $this->lastname;
        return $name;
    }

    public function emailExist($id,$email)
    {
        if($this->id == $id && $this->email == $email)
        {
            return true;
        }
        return false;
    }


    public function scopeSearch($query,$search)
    {
        return $query->where('username','like','%'. $search .'%')
                     ->orWhere('email','like','%' . $search . '%')
                     ->orWhere('firstname','like','%' .$search .'%')
                     ->orWhere('lastname','like','%' .$search .'%');
                 
               
    }
}
