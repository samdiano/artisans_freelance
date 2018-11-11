<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitJob extends Model
{
    protected $table = "bit_jobs";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }

    public function project()
    {
        return $this->belongsTo('App\Project','project_id');
    }

}
