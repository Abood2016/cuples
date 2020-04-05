<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Active_log extends Model
{
    use SoftDeletes;

    protected $fillabel = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }}
