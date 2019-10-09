<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Assist\Pager;

class RubricController extends Controller
{

    public function rubric0($rubric){

        return redirect('/'.$rubric);

    }

    public function rubric($rubric, $page = 0) {

        if(!$category = Category::where('alias', $rubric)->first()) return abort(404);
        if($page < 0) return abort(404);
        if(Pager::isLast($category->id, $page)) return redirect('/' . $category->alias);
        if(!$pages = Pager::feed($category->id, $page)) return abort(404);
        $blogPosts = $pages['result_set'];

        return view('pages.rubric', [

            'headers' => $this->getRubricHeaders($category),
            'currentCategory' => $category->id,
            'blogPosts' => $blogPosts,
            'pager' => $pages['pager']

        ]);

    }

    private function getRubricHeaders(Category $category) {
        if ($category) {
            if(trim($category->image))
                $image = $category->image;
            else
                $image = '/img/vegans.jpg';
            return [
                'pageTitle' => $category->name  . ' на Веганс Фридом | Vegans Freedom',
                'url' => asset($category->alias) . '/',
                'title' => $category->name,
                'description' => $category->descr,
                'image' => asset($image)
            ];
        } else {
            return ['url' => '', 'title' => '', 'description' => '', 'image' => ''];
        }
    }
}



