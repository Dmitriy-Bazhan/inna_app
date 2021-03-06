<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostData extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'lang', 'content', 'title', 'short_description'];
}
