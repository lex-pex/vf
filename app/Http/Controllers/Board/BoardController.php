<?php

namespace App\Http\Controllers\Board;


use App\Http\Controllers\Controller;
use App\Assist\Board\Pager;

class BoardController extends Controller
{

    public function board($page = 0) {

        if($page < 0) return abort(404);

        if(Pager::isLast(0, $page)) return abort(404);

        if(!$pages = Pager::feed(0, $page)) return abort(404);

        $blogPosts = $pages['result_set'];

        return view('board.board', [
            'headers' => $this->getBoardHeaders(),
            'currentCategory' => 0,
            'blogPosts' => $blogPosts,
            'pager' => $pages['pager']
        ]);

    }

    private function getBoardHeaders()
    {
        return [
            'pageTitle' => 'Доска объявлений Vegans Freedom',
            'url' => asset('board') . '/',
            'title' => 'Доска объявлений',
            'description' => 'Доска частных объявлений на сайте Vegans Freedom! Объявления для Веган товаров и товаров здоровья!',
            'image' => asset('img/vegans.jpg')
        ];
    }

}
