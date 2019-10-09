<?php

namespace App\Assist\Shop;

use App\Models\Shop\Order;
use App\Models\Shop\Product;

class Cart {

    public static function addProduct($id) {
        $id = intval($id);
        $products = array();
        if (session()->exists('products')) {
            $products = session('products');
        }
        if (array_key_exists($id, $products)) {
            $products[$id] ++;
        } else {
            $products[$id] = 1;
        }
        session()->put('products', $products);
        return self::countItems();
    }

    public static function delProduct($id) {
        $id = intval($id);
        $products = array();
        if (session()->exists('products')) {
            $products = session('products');
        }
        if (array_key_exists($id, $products)) {
            unset($products[$id]);
        }
        session()->put('products', $products);
        return self::countItems();
    }
    
    public static function countItems() {
        if (session()->exists('products')) {
            $count = 0;
            foreach (session()->get('products') as $id => $quantity) {
                $count += $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function getProducts() {
        if(!session()->exists('products')) return [];
        return session()->get('products');
    }

    public static function getTotal(){
        $cart = Cart::getProducts();
        $prodIds = array_keys($cart);
        $products = Product::whereIn('id', $prodIds)->get();
        $amount = 0;
        foreach ($products as $product) {
            $amount += $product->price * $cart[$product->id];
        }
        return $amount;
    }

    public static function clearCart() {
        if(session()->exists('products'))
            session()->forget('products');
        return true;
    }

    public static function totalOrders() {
        return Order::all()->count();
    }

    public static function newOrders() {
        return Order::all()->where('status', 0)->count();
    }

//    public static function getTotalPrice($products) {
//        $prodsInCart = self::getProducts();
//        $total = 0;
//        if ($prodsInCart) {
//            foreach ($products as $prod) {
//                $total += $prod['price'] * $prodsInCart[$prod['id']];
//            }
//        }
//        return $total;
//    }

}
