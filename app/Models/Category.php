<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    protected $fillable = [ 'name', 'alias', 'descr', 'image', 'sort_order', 'status' ];

    public $timestamps = false;

    private static $_IMG_STORAGE = '/img/rubrics/';

    public static function getCategories()
    {
        return Category::all()->where('status', 1)->sortByDesc('sort_order');
    }

    public static function getStatus($id) {
        return Category::all()->where('id', $id)->first()->status;
    }

    public static function getAdminCategories()
    {
        return Category::all()->sortByDesc('sort_order');
    }

    public static function categoryUpdate(Category $category, Request $request)
    {
        $data = $request->except('image', 'image_del', 'hidden');

        $image_del = $request->get('image_del');

        $alias = $request->get('alias');

        if ($image_del) {
            $category->setAttribute('image', '');
            $imageDirectory = self::$_IMG_STORAGE . $alias;
            self::delDir($imageDirectory);
        }

        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            $imageDirectory = self::$_IMG_STORAGE . $alias;
            self::delDir($imageDirectory);
            $fileName = $_FILES['image']['name'];
            $array = explode('.', $fileName);
            $extension = trim(array_pop($array));
            $imagePath = $imageDirectory . "/{$alias}." . $extension;
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imageDirectory)) {
                mkdir($_SERVER['DOCUMENT_ROOT'] . $imageDirectory);
            }
            move_uploaded_file($_FILES['image']['tmp_name'],
                $_SERVER['DOCUMENT_ROOT'] . $imagePath
            );
            $category->setAttribute('image', $imagePath);
        }
        $category->fill($data);
        $category->save();
    }

    public static function categoryDelete(Category $category)
    {
        $category->delete();
        $imageDirectory = self::$_IMG_STORAGE . $category->alias;
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imageDirectory)) {
            self::delTree($_SERVER['DOCUMENT_ROOT'] . $imageDirectory);
        }
    }

    public static function getName($id) {
        if($id && $cat = Category::find($id))
            return $cat->name;
        return null;
    }

    public static function getNameByAlias($alias) {
        return Category::all()->where('alias', $alias)->first()->name;
    }

    public static function categoryCreate(Request $request)
    {
        $data = $request->except('image', 'hidden');
        $category = new Category();
        $alias = $request->get('alias');
        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            $imageDirectory = self::$_IMG_STORAGE . $alias;
            self::delDir($imageDirectory);
            $fileName = $_FILES['image']['name'];
            $array = explode('.', $fileName);
            $extension = trim(array_pop($array));
            $imagePath = $imageDirectory . "/{$alias}." . $extension;
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imageDirectory)) {
                mkdir($_SERVER['DOCUMENT_ROOT'] . $imageDirectory);
            }
            move_uploaded_file($_FILES['image']['tmp_name'],
                $_SERVER['DOCUMENT_ROOT'] . $imagePath
            );
            $category->setAttribute('image', $imagePath);
        }
        $category->fill($data);
        $category->save();
    }

    public static function getIdByAlias($alias)
    {
        if (Category::all()->where('alias', $alias)->first())
            return Category::all()->where('alias', $alias)->first()->id;
        else return null;
    }

    public static function getAliasById($id)
    {
        if ($c = Category::find($id))
            return $c->alias;
        return null;
    }

    // SERVICE METHODS

    private static function delDir($directory)
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $directory)) {
            self::delTree($_SERVER['DOCUMENT_ROOT'] . $directory);
        }
    }

    private static function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    public static function getCategoryByAlias($alias)
    {
        return Category::all()->where('alias', $alias)->first();
    }
}
