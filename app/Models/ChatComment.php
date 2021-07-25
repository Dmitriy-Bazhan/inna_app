<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatComment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'is_user_admin'];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
