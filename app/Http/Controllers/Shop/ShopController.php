<?php

namespace App\Http\Controllers\Shop;


use App\Http\Controllers\Controller;
use App\Models\Shop\Order;
use App\Models\Shop\Product;
use App\Models\Shop\Category;

class ShopController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }

    public function products() {
        $products = Product::all()->sortByDesc('id');
        $categories = Category::getCategories();
        $adminCategories = Category::getAdminCategories();
        return view('shop.manage.products', [
            'headers' => $this->adminProductsHeaders(),
            'categories' => $categories,
            'currentCategory' => 0,
            'products' => $products,
            'adminCategories' => $adminCategories,
        ]);
    }

    public function orders() {
        $orders = Order::all()->sortByDesc('id');
        $categories = Category::getCategories();
        $adminCategories = Category::getAdminCategories();
        return view('shop.order.orders', [
            'headers' => $this->adminOrdersHeaders(),
            'categories' => $categories,
            'currentCategory' => 0,
            'orders' => $orders,
            'adminCategories' => $adminCategories,
        ]);
    }

    public function categories() {
        $orders = Order::all()->sortByDesc('id');
        $categories = Category::getCategories();
        $adminCategories = Category::getAdminCategories();
        return view('shop.category.categories', [
            'headers' => $this->adminCategoriesHeaders(),
            'categories' => $categories,
            'currentCategory' => 0,
            'orders' => $orders,
            'adminCategories' => $adminCategories,
        ]);
    }

    private function adminProductsHeaders()
    {
        return [
            'pageTitle' => 'Список Товаров',
            'url' => '/admin/products/',
            'title' => 'Список Товаров',
            'description' => 'Список товаров, Vegans Freedom Admin',
            'image' => '/img/vegans.jpg',
        ];
    }

    private function adminOrdersHeaders()
    {
        return [
            'pageTitle' => 'Список Заказов',
            'url' => '/admin/orders/',
            'title' => 'Список Заказов',
            'description' => 'Список Заказов, Vegans Freedom Admin',
            'image' => '/img/vegans.jpg',
        ];
    }

    private function adminCategoriesHeaders()
    {
        return [
            'pageTitle' => 'Список Категорий',
            'url' => '/admin/categories/',
            'title' => 'Список Категорий',
            'description' => 'Список Категорий, Vegans Freedom Admin',
            'image' => '/img/vegans.jpg',
        ];
    }
}







