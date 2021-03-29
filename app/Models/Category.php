<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['_token', 'id'];

    static function TakeParent($id = 0)
    {
        $result = self::where('parentId', $id)->get();
        return $result;
    }

    public function takeBreadcrumb()
    {
        $temp = ($this->parentId !== 0) ? $this->recursia($this->parentId) : [];
        return $temp;
    }

    public function recursia($id, $array = [])
    {
        var_dump($id);
        $temp = Category::where('id', $id)->first();
        echo $temp->name;
        if ($temp) {
            array_unshift( $array,[
                $temp->name,
                $temp->id
            ]);
            if ($temp->parentId !== 0) {
                $array = $this->recursia($temp->parentId, $array);
            }
            return $array;
        }
    }

    public function ProductCategory(){
        return $this->hasMany($this, 'parentId');
    }

    public function rootCategories(){
        return $this->where('parentId', 0)->with('ProductCategory')->get();
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parentId', 'id');
    }


}
