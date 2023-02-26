<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];


    public static function storeSubCategory($request)
    {
        $subCat = new SubCategory();
        $subCat->category_id = $request->category;
        $subCat->sub_cat_name = $request->sub_category_name;
        $subCat->sub_cat_slug = str_replace(' ','-',$request->sub_category_name);
        $subCat->save();
    }

    public static function updateSubCategory($request,$id)
    {
        $data = SubCategory::find($id);
        $data->category_id = $request->category;
        $data->sub_cat_name = $request->sub_category_name;
        $data->sub_cat_slug = str_replace(' ','-',$request->sub_category_name);
        $data->save();

    }

    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
}
