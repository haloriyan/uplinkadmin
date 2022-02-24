<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWithdraw extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function bank() {
        return $this->belongsTo('App\Models\UserBank', 'bank_id');
    }
}
