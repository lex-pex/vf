<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use App\Models\Shop\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function product($alias) {
        if(!$product = Product::where('alias', $alias)->first()) return abort(404);
        if (Auth::user()) {
            $editButton = Auth::user()->role == 'admin';
        } else {
            $editButton = false;
        }
        $cat = Category::getNameAlias($product->category);
        return view('shop.pages.product', [
            'headers' => $this->getProductHeaders($product),
            'currentCategory' => $product->category,
            'categoryName' => $cat->name,
            'categoryUrn' => 'shop/' . $cat->alias,
            'product' => $product,
            'edit' => $editButton,
        ]);
    }

    // HEADERS Preparing headers for Post-Page
    private function getProductHeaders(Product $product)
    {
        return [
            'pageTitle' => $product->name . ' | Vegans Freedom',
            'url' => asset('prod/' . $product->alias),
            'title' => $product->name,
            'description' => $this->productDescription($product->description),
            'image' => $product->image
        ];
    }

    // Preparing description for header
    private function productDescription($text)
    {
        $descriptionArray = explode(' ', $text);
        $descriptionArray = array_slice($descriptionArray, 0, 30);
        return implode(' ', $descriptionArray);
    }
}
