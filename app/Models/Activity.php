<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['title', 'description', 'date', 'time', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}