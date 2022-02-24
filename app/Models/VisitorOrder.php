<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorOrder extends Model
{
    use HasFactory;

    public function details() {
        return $this->hasMany('App\Models\VisitorOrderDetail', 'order_id');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function visitor() {
        return $this->belongsTo('App\Models\Visitor', 'visitor_id');
    }
}
