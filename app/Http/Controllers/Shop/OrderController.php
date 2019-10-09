<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Order;
use App\Models\Shop\Product;

class OrderController extends Controller
{
    public function order(Order $order){
        if(!$amounts = json_decode($order->order, true))
            $amounts = [];
        $keys = array_keys($amounts);
        $prods = Product::whereIn('id', $keys)->get();
        $total = 0;
        foreach ($prods as $p) {
            $total += $p->price * $amounts[$p->id];
        }
        return view('shop.order.order', [
            'currentCategory' => 0,
            'headers' => $this->adminOrderHeaders($order->id),
            'order' => $order,
            'amounts' => $amounts,
            'products' => $prods,
            'total' => $total
        ]);
    }

    public function orderEdit(Order $order){
        if(!$amounts = json_decode($order->order, true))
            $amounts = [];
        $keys = array_keys($amounts);
        $prods = Product::whereIn('id', $keys)->get();
        $total = 0;
        foreach ($prods as $p) {
            $total += $p->price * $amounts[$p->id];
        }

        return view('shop.order.edit', [
            'currentCategory' => 0,
            'headers' => $this->adminOrderHeaders($order->id),
            'order' => $order,
            'amounts' => $amounts,
            'products' => $prods,
            'total' => $total
        ]);
    }

    public function orderStore(Order $order, Request $request){
        $this->validate($request, [
            'name' => 'required|max:255', // unique:blog_posts|
            'description' => 'max:512',
        ]);
        $order = Order::orderStore($order, $request);
        return redirect(route('order', ['order' => $order]));
    }

    public function orderDelete(Order $order){
        $order->delete();
        return redirect(route('orders'));
    }

        private function adminOrderHeaders($id)
    {
        return [
            'pageTitle' => 'Заказ #' . $id,
            'url' => '/admin/shop/order/' . $id,
            'title' => 'Заказ #' . $id,
            'description' => 'Заказ #' . $id . ', Vegans Freedom Admin',
            'image' => '/img/vegans.jpg',
        ];
    }
}











