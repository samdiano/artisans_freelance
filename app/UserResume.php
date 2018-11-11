<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserResume extends Model
{
    protected $table ="user_resumes";
    protected  $guarded =[];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
