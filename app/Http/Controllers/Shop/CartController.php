<?php

namespace App\Http\Controllers\Shop;

use App\Assist\Shop\Cart;
use App\Http\Controllers\Controller;
use App\Models\Shop\Order;
use App\Models\Visit;
use Illuminate\Http\Request;
use App\Models\Shop\Product;

class CartController extends Controller
{
    /**
     * iHerb counter
     */
    public function ihCount($number) {
        $urn = 'iHerb_' . $number;
        if($visit = Visit::where('page', $urn)->first()) {
            $visit->increment('amount');
        } else {
            $visit = new Visit();
            $visit->page = $urn;
            $visit->user = 0;
            $visit->amount = 1;
            $visit->save();
        }
        return $visit->amount;
    }

    /**
     * iHerb counter reset
     */
    public function ihCountReset($number) {

        $urn = 'iHerb_' . $number;

        if($visit = Visit::where('page', $urn)->first()) {
            $visit->amount = 0;
        } else {
            $visit = new Visit();
            $visit->page = $urn;
            $visit->user = 0;
            $visit->amount = 0;
        }
        $visit->save();
        return 'Reset: ' . $number;
    }

    public function add($id) {
        return Cart::addProduct($id);
    }

    public function del($id) {
        $response = [
            'count' => Cart::delProduct($id),
            'total' => Cart::getTotal()
            ];
        return json_encode($response);
    }

    public function amount($id, $amount) {
        $products = array();
        if (session()->exists('products')) {
            $products = session('products');
        }
        if (array_key_exists($id, $products)) {
            $products[$id] = $amount;
        }
        session()->put('products', $products);
        $response = [
            'total' => Cart::getTotal(),
            'count' => Cart::countItems()
        ];
        return json_encode($response);
    }

    public function cart() {
        return view('shop.cart.items', $this->cartViewItems(false));
    }

    public function order(Request $request) {
        if($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:100',
                'phone' => 'required|max:30|regex:/^[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\[0-9]*$/i',
            ]);
            $products = Cart::getProducts();
            if(count($products) < 1) return redirect()->back()->withInput()->withErrors('Корзина пуста');
            $order = new Order([
                'name' => $request->name,
                'phone' => $request->phone,
                'comment' => $request->comment ? $request->comment : '',
                'order' => $products = json_encode($products)
            ]);
            $order->save();
            $params = $this->cartViewItems(true);
            $params['order_id'] = $order->id;
            Cart::clearCart();
            return view('shop.cart.success', $params);
        } else
            return view('shop.cart.order', $this->cartViewItems(true));
    }

    private function cartViewItems($commit) {
        $cart = Cart::getProducts();
        $prodIds = array_keys($cart);
        $products = Product::whereIn('id', $prodIds)->get();
        $total = Cart::getTotal();
        return [
            'cart' => $cart,
            'total' => $total,
            'products' => $products,
            'headers' => $commit ? $this->getCartHeaders() : $this->getCommitHeaders(),
            'currentCategory' => 0,
            'commit' => $commit
        ];
    }

    // HEADERS Preparing headers for Post-Page
    private function getCartHeaders()
    {
        return [
            'pageTitle' => 'Корзина заказов | Vegans Freedom',
            'url' => asset('shop/cart'),
            'title' => 'Корзина Заказов',
            'description' => 'Страница товаров добавленных в корзину',
            'image' => '/img/vegans.jpg'
        ];
    }

    private function getCommitHeaders()
    {
        return [
            'pageTitle' => 'Подтверждение Заказа',
            'url' => asset('shop/cart/order'),
            'title' => 'Подтверждение Заказа',
            'description' => 'Подтверждение заказа товаров добавленных в корзину',
            'image' => '/img/vegans.jpg'
        ];
    }

}










