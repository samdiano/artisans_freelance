<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    protected $table = "reports";

    protected $guarded = [];

    public function reports()
    {
        return $this->belongsTo('App\Milestone','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','report_from');
    }
    public function reportAgainst()
    {
        return $this->belongsTo('App\User','report_against');
    }

    public function getCreatedAtAttribute($value)
    {
         return Carbon::parse($value)->diffForHumans();
    }

}
