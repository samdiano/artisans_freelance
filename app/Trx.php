<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Trx extends Model
{
    protected $guarded = ['id'];

    public function getCreatedAtColumnAttribute($value)
    {
        return date('d.m.Y h:s A',strtotime($value));
    }
}
