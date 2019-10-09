<?php

namespace App\Http\Controllers\Shop;


use App\Assist\Shop\Pager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SearchController extends Controller
{
    public function search(Request $request) {
        $query = $request->get('query');
        if($query) {
            $page = $request->get('page') ? $request->get('page') : 1;
            if($pager = Pager::search($query, $page)) {
                $products = $pager['result_set'];
                $pager = $pager['pager'];
            } else {
                $products = [];
                $pager = [];
            }
        } else {
            $products = [];
            $pager = [];
            $query = '_';
        }
        return view('shop.pages.search', [
            'headers' => $this->getSearchHeaders($query),
            'currentCategory' => 0,
            'products' => $products,
            'pager' => $pager,
            'query' => $query
        ]);
    }

    private function getSearchHeaders($query) {
        return [
            'pageTitle' => 'Поиск в магазине Сайте Веганс Фридом | Vegans Freedom',
            'url' =>  '/shop/search/',
            'title' => 'Поиск в Магазине',
            'description' => 'Поиск по запросу: "<span class="cyphers">'. $query . '</span>"',
            'image' => '/img/details/search.jpg'
        ];
    }
}


