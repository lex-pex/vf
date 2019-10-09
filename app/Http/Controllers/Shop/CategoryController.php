<?php

namespace App\Http\Controllers\Shop;


use App\Http\Controllers\Controller;
use App\Models\Shop\Category;
use App\Assist\Shop\Pager;

class CategoryController extends Controller
{

    public function category_0($cat){
        return redirect('shop/'. $cat);
    }

    public function category($cat = 'nocat', $page = 0) {

        if($page < 0) return abort(404);
        if(!$cat = Category::all()->where('alias', $cat)->first()) return abort(404);
        if(!$pages = Pager::feed($cat->id, $page)) return abort(404);
        $products = $pages['result_set'];

        return view('shop.pages.category', [
            'headers' => $this->getShopHeaders($cat),
            'currentCategory' => $cat->id,
            'products' => $products,
            'pager' => $pages['pager']
        ]);


    }

    private function getShopHeaders($cat) {
        return [
            'pageTitle' => 'Веган Магазин | Категория '. $cat->name .' | Vegans Freedom',
            'url' => asset('shop/' . $cat->alias) . '/',
            'title' => 'Магазин '. $cat->name,
            'description' => $cat->description,
            'image' => $cat->image
        ];
    }
}
