<?php

namespace App\Models\Shop;

use App\Assist\Util;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Product extends Model
{

    public function getPriceAttribute($value){
//        return ceil($value / 2 * 1.3);
        return ceil($value / 2);
    }

    public function getPrice() {
        return DB::table('sh_products')->select('price')->where('id', $this->id)->first()->price;
    }

    protected $table = 'sh_products';

    protected $fillable = ['name', 'description', 'category', 'unit', 'price', 'image', 'sort', 'status'];

    private static $_IMG_STORAGE = '/img/shop/goods/';

    public static function productStore(Request $request){
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
        $product = new Product();
        $alias = Util::aliasUnique($alias, $product);
        $product->setAttribute('description', $description);
        $product->setAttribute('alias', $alias);
        $product->fill($data);
        $sort = Product::max('sort');
        $product->sort = $sort + 1;
        $product->save();
        if (is_uploaded_file($_FILES['image']['tmp_name'])){
            Util::uploadImage($product, self::$_IMG_STORAGE);
        }
        return $product;
    }

    public static function productUpdate(Product $product, Request $request){
        $data = $request->except('image', 'image_del', 'description', 'alias', '_token', 'hidden');
        if($d = $request->get('description'))
            $description = Util::textProcessor($d);
        else
            $description = '';
        $product->setAttribute('description', $description);
        if($alias = $request->get('alias')){
            $alias = Util::aliasUpdate($request->get('alias'), $product);
            $product->setAttribute('alias', $alias);
        }
        $image_del = $request->get('image_del');
        $product->fill($data);
        if ($image_del) {
            $product->setAttribute('image', '');
            $imageDirectory = self::$_IMG_STORAGE . $product->id;
            Util::delDir($imageDirectory);
        }
        if (is_uploaded_file($_FILES['image']['tmp_name'])){
            Util::uploadImage($product, self::$_IMG_STORAGE);
        }
        $product->save();
    }

    public static function productDelete(Product $product){
        $imageDirectory = self::$_IMG_STORAGE . $product->id;
        $product->delete();
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imageDirectory)){
            Util::delTree($_SERVER['DOCUMENT_ROOT'] . $imageDirectory);
        }
    }

}



