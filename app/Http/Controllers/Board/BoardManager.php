<?php

namespace App\Http\Controllers\Board;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class BoardManager extends Controller
{
    public function add(){

        if(!Auth::check()) return abort(404);

        $hiddenOption = Auth::user()->role == 'admin';

        if($hiddenOption)

            $categories = Category::getAdminCategories();

        else

            $categories = Category::getCategories();

        return view('board.add', [

            'headers' => $this->getAddHeaders(),
            'currentCategory' => 0,
            'categories' => $categories
        ]);
    }

    private function getAddHeaders() {
        return [
            'pageTitle' => 'Добавить Объявление | Admin VF',
            'url' => '/board/ad/add/',
            'title' => 'Добавить Объявление',
            'description' => 'Добавление Объявления | VegansFreedom',
            'image' => '/img/vegans.jpg'];
    }

}
