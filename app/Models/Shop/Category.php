<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Assist\Util;

class Category extends Model
{
    protected $table = 'sh_categories';

    protected $fillable = ['name', 'description', 'image', 'sort', 'status'];

    private static $_IMG_STORAGE = '/img/shop/cats/';

    public static function getCategories(){
        return Category::all()->where('status', 1)->sortBy('sort');
    }

    public static function getAdminCategories(){
        return Category::all()->sortBy('id')->sortBy('sort');
    }

    public static function getNameAlias($id){
        if($cat = Category::select('name', 'alias')->where('id', $id)->first())
            return $cat;
        $cat = new \stdClass();
        $cat->name = 'category';
        $cat->alias = '';
        return $cat;
    }

    public static function getAlias($id){
        return Category::select('alias')->where('id', $id)->first();
    }

    public static function getName($id){
        if($cat = Category::select('name')->where('id', $id)->first())
            return $cat->name;
        return '';
    }

    public static function categoryStore(Request $request){
        $data = $request->except('image', 'alias', 'description', '_token', 'hidden');
        if($d = $request->get('description'))
            $description = Util::textProcessor($d);
        else
            $description = '';
        $alias = $request->get('alias');
        if(!$alias) {
            $name = $request->get('name');
            $alias = Util::aliasProcessor($name);
        }
        $category = new Category();
        $alias = Util::aliasUnique($alias, $category);
        $category->setAttribute('description', $description);
        $category->setAttribute('alias', $alias);
        $category->fill($data);
        $category->save();
        if (is_uploaded_file($_FILES['image']['tmp_name'])){
            Util::uploadImage($category, self::$_IMG_STORAGE);
        }
        return $category;
    }

    public static function categoryUpdate(Category $category, Request $request)
    {
        $data = $request->except('image', 'image_del', 'description', '_token', 'hidden');
        $category->fill($data);
        if($d = $request->get('description'))
            $description = Util::textProcessor($d);
        else
            $description = '';
        $category->setAttribute('description', $description);
        if($alias = $request->get('alias')){
            $alias = Util::aliasUpdate($request->get('alias'), $category);
            $category->setAttribute('alias', $alias);
        }
        $image_del = $request->get('image_del');
        if ($image_del) {
            $category->setAttribute('image', '');
            $imageDirectory = self::$_IMG_STORAGE . $category->id;
            Util::delDir($imageDirectory);
        }
        if (is_uploaded_file($_FILES['image']['tmp_name'])){
            Util::uploadImage($category, self::$_IMG_STORAGE);
        }
        $category->save();
    }

    public static function categoryDelete(Category $category){
        $imageDirectory = self::$_IMG_STORAGE . $category->id;
        $category->delete();
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imageDirectory)){
            Util::delTree($_SERVER['DOCUMENT_ROOT'] . $imageDirectory);
        }
    }

}


