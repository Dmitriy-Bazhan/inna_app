<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'published' => 'boolean',
    ];

    public function setPublishedAttribute($value)
    {
        $this->attributes['category_ids'] = (int)$value;
    }
}
