<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    protected $table = "messages";

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function bitJob()
    {
        return $this->belongsTo(BitJob::class, 'bit_job_id', 'id');
    }

    public function getCreatedAtAttribute($val){
        return Carbon::parse($val)->diffForHumans();
    }
}
