<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Category;
use App\Models\Shop\Product;

class ProductManager extends Controller
{

    public function __construct() {
        $this->middleware('admin');
    }

    public function productAdd(){
        $categories = Category::getAdminCategories();
        return view('shop.manage.add', [
            'headers' => $this->getAddHeaders(),
            'currentCategory' => 0,
            'categories' => $categories
        ]);
    }

    public function productEdit($id) {
        if(!$product = Product::find($id)) return abort('404');
        $catId = $product->category;
        $cat = Category::getNameAlias($catId);
        $categories = Category::getAdminCategories();
        return view('shop.manage.edit', [
            'headers' => $this->getEditHeaders($id),
            'currentCategory' => $catId,
            'product' => $product,
            'categories' => $categories,
            'cat' => $cat
        ]);
    }

    public function productStore(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:256', // unique:blog_posts|
            'description' => 'max:512',
            'unit' => 'required|min:1',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product = Product::productStore($request);
        return redirect('shop/preview/' . $product->id);
    }

    public function preview($id) {
        if(!$product = Product::find($id)) return abort(404);
        $catId = $product->category;
        $cat = Category::getNameAlias($catId);
        return view('shop.manage.preview', [
            'headers' => $this->getProductHeaders($product, $cat),
            'currentCategory' => $catId,
            'cat' => $cat,
            'product' => $product
        ]);
    }

    public function productDelete(Product $product, $confirm = false) {
        $catId = $product->getAttribute('category_id');
        Product::productDelete($product);
        return redirect('shop/' . Category::getAlias($catId));
    }

    public function confirmDelete(Product $product) {
        $catId = $product->category;
        $cat = Category::getNameAlias($catId);
        return view('shop.manage.del', [
            'headers' => $this->getDelHeaders(),
            'currentCategory' => $catId,
            'product' => $product,
            'cat' => $cat
        ]);
    }

    public function productUpdate(Product $product, Request $request) {
        $this->validate($request, [
            'name' => 'required|max:256',
            'description' => 'max:512',
            'unit' => 'required|min:1',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        Product::productUpdate($product, $request);
        return redirect('shop/preview/' . $product->id);
    }

    /* Pages Headers */

    private function getProductHeaders(Product $product, Category $cat)
    {
        return [
            'pageTitle' => $product->name . ' | ' .$cat->name . ' | Магазин | Vegans Freedom',
            'url' => asset('prod/' . $product->alias),
            'title' => $product->title,
            'description' => $this->postDescription($product->text),
            'image' => asset($product->image)
        ];
    }

    private function getAddHeaders()
    {
        return [
            'pageTitle' => 'Добавление Товара | Vegans Freedom',
            'url' => asset('/shop/add'),
            'title' => 'Добавление Товара',
            'description' => 'Добавление нового товара в магазин | Vegans Freedom',
            'image' => asset('/img/vegans.jpg'),
        ];
    }

    private function getEditHeaders(int $id)
    {
        return [
            'pageTitle' => 'Изменение позиции | Vegans Freedom',
            'url' => asset('/store/edit/'.$id),
            'title' => 'Изменение товара',
            'description' => 'Изменение товара, редактирование позиции в магазине',
            'image' => '/img/vegans.jpg',
        ];
    }

    private function getDelHeaders()
    {
        return [
            'pageTitle' => 'Удаление Товара | Vegans Freedom',
            'url' => '/',
            'title' => 'Подтвердить Удаление Позиции',
            'description' => 'Удаление Позиции с Сайта Vegans Freedom',
            'image' => '/img/vegans.jpg',
        ];
    }

    // Preparing description for header
    private function postDescription($text)
    {
        $descriptionArray = explode(' ', $text);
        $descriptionArray = array_slice($descriptionArray, 0, 30);
        return implode(' ', $descriptionArray);
    }
}
