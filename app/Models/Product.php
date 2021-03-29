<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['_token', 'id'];

    public static function search($search, $category)
    {
        $data = Product::where('name', 'LIKE', "%{$search}%")->where('category_id', 'LIKE', $category)->get();

        return $data;
    }
}
