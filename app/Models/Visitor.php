<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function orders() {
        return $this->hasMany('App\Models\VisitorOrder', 'visitor_id');
    }
}
