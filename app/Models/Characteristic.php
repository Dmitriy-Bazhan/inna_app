<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;

    protected $fillable = ['category_ids'];

    public function setCategoryIdsAttribute($value = [])
    {
        $result = '';
        if (count($value) > 0) {
            $result = '_';
            foreach ($value as $val) {
                $result .= $val . '_';
            }
        }
        $this->attributes['category_ids'] = $result;
    }

    public function getCategoryIdsAttribute($value)
    {
        $result = [];
        if (strlen($value) > 0) {
            $value = trim($value, '_');
            $result = explode('_', $value);
        }
        return $result;
    }
}
