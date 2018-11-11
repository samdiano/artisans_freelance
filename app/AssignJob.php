<?php

namespace App;

use Carbon\Carbon;
use function GuzzleHttp\Psr7\str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignJob extends Model
{
    use SoftDeletes;
    protected $table = "assign_jobs";

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
    public function mileStones()
    {
        return $this->hasMany('App\Milestone','assign_job_id')->latest();
    }

    public function getUpdatedAtAttribute($val)
    {
        return date('d.m.Y', strtotime($val));
//        return Carbon::parse($val)->diffForHumans();
    }

}
