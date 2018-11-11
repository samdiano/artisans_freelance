<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table = "projects";

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function bids()
    {
        return $this->hasMany('App\BitJob','project_id');
    }

}
