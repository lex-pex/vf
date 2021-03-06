<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Assist\Shop\Pager;

class HomeController extends Controller
{
    public function page_0(){
        return redirect('shop/');
    }

    public function main($page = 0) {
        if($page < 0) return abort(404);
        if($page == 1) return redirect('shop/');
        if(!$pages = Pager::feed(0, $page)) return abort(404);
        $products = $pages['result_set'];
        return view('shop.pages.main', [
            'headers' => $this->getShopHeaders(),
            'currentCategory' => 0,
            'products' => $products,
            'pager' => $pages['pager']
        ]);
    }

    public function about() {
        return view('shop.pages.about', [
            'headers' => $this->getAboutHeaders(),
            'currentCategory' => 0,
        ]);
    }

    private function getShopHeaders() {
        return [
            'pageTitle' => 'Магазин Веган Товаров | Vegans Freedom',
            'url' => asset('shop') . '/',
            'title' => 'Магазин Веган Товаров',
            'description' => 'ПРОДУКТЫ ПО УКРАИНЕ "НОВОЙ ПОШТОЙ", В РАМКАХ ПРОЕКТА "ЗДОРОВА УКРАЇНА", ВЕГАНСЬКІЙ РУХ ПОДДЕРЖИВАЕТ ИНИЦИАТИВУ для развития веганства и распространения культуры полезного питания в Украине',
            'image' => asset('img/shop/details/shop.jpg')
        ];
    }

    private function getAboutHeaders() {
        return [
            'pageTitle' => 'О проекте - Еда Без Вреда, в наличии всегда | Vegans Freedom',
            'url' => asset('shop') . '/about/',
            'title' => 'Еда Без Вреда, в Наличии Всегда',
            'description' => 'ПРОДУКТЫ ПО УКРАИНЕ "НОВОЙ ПОШТОЙ", В РАМКАХ ПРОЕКТА "ЗДОРОВА УКРАЇНА", ВЕГАНСЬКІЙ РУХ ПОДДЕРЖИВАЕТ ИНИЦИАТИВУ для развития веганства и распространения культуры полезного питания в Украине',
//            'description' => 'Акция "Еда Без Вреда, в наличии всегда", благотворительная акция, не прибыльный проэкт по распространению идеи этичности и здоровья. Это версия волонтёрского магазина для развития веганства и распространения культуры полезного питания',
            'image' => asset('img/shop/details/shop.jpg')
        ];
    }

}



