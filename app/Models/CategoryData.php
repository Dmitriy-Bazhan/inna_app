<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryData extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'lang', 'title', 'short_description', 'description'];
}
