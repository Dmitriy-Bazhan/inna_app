<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductData extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'lang', 'name', 'short_description', 'description'];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
