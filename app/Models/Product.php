<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'vendor_code', 'alias', 'search_string'];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function data()
    {
        return $this->hasMany(ProductData::class, 'product_id', 'id');
    }
}
