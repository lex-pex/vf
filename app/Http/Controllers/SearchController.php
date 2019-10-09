<?php

namespace App\Http\Controllers;


use App\Assist\Pager;
use Illuminate\Http\Request;


class SearchController extends Controller
{

    public function search(Request $request) {
        $query = $request->get('query');
        if($query) {
            $page = $request->get('page') ? $request->get('page') : 1;
            if($pager = Pager::search($query, $page)) {
                $blogPosts = $pager['result_set'];
                $pager = $pager['pager'];
            } else {
                $blogPosts = [];
                $pager = [];
            }
        } else {
            $blogPosts = [];
            $pager = [];
            $query = '_';
        }
        return view('pages.search', [
            'headers' => $this->getSearchHeaders($query),
            'currentCategory' => 0,
            'blogPosts' => $blogPosts,
            'pager' => $pager,
            'query' => $query
        ]);
    }

    private function getSearchHeaders($query) {
        return [
            'pageTitle' => 'Поиск на Сайте Веганс Фридом | Vegans Freedom',
            'url' =>  '/',
            'title' => 'Поиск на сайте',
            'description' => 'Поиск по запросу: "<span class="cyphers">'. $query . '</span>"',
            'image' => '/img/details/search.jpg'
        ];
    }
}


