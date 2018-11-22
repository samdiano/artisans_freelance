<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $guarded = [];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function deposit()
    {
        return $this->hasMany('App\Deposit','user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }


//    public function WithdrawLogs()
//    {
//        return $this->hasMany('App\WithdrawLog', 'user_id');
//    }

    public function resume()
    {
        return $this->hasOne('App\UserResume', 'user_id');
    }


    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function userLogin()
    {
        return $this->hasOne('App\UserLogin','user_id')->select('created_at')->latest();
    }

    public function getUpdatedAtAttribute($val){
        return Carbon::parse($val)->diffForHumans();
    }

}
