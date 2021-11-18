<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User as Me;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name', 'email', 'password','lname','address','zipcode','country_id','city','phone','state','landmark','sfname','slname','saddress','scity','szipcode','scountry_id','sphone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function get_register_user($id)
    {
        $data = User::select('*')->where('id' ,'=', $id)->find($id);
        return $data;
    }
    public static function userinfo($id)
    {       
        $des = Me::find($id);

        return $des;
    }
}
