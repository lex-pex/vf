<?php

namespace App\Http\Controllers;

use App\Assist\Pager;

class MainController extends Controller
{
    public function page0(){
        return redirect('/');
    }

    public function main($page = 0) {
        if($page < 0) return abort(404);
        if(Pager::isLast(0, $page)) return redirect('/');
        if(!$pages = Pager::feed(0, $page)) return abort(404);
        $blogPosts = $pages['result_set'];
        return view('pages.main', [
            'headers' => $this->getMainHeaders(),
            'currentCategory' => 0,
            'blogPosts' => $blogPosts,
            'pager' => $pages['pager']
        ]);
    }

    public function subscription() {
        return view('pages.subscription', [
            'headers' => $this->getSubscriptionHeaders(),
            'currentCategory' => 0,
        ]);
    }

    public function about() {
        return view('pages.about', [
            'headers' => $this->getAboutHeaders(),
            'currentCategory' => 0,
        ]);
    }

    private function getMainHeaders() {
        return [
            'pageTitle' => 'Vegans Freedom | Свобода Веганов | Веган сообщество, вегетарианский сайт, веганские рецепты, постные блюда',
            'url' => asset(''),
            'title' => 'Веганский сайт, Веган сообщество',
            'description' => "Сайт об этичности, питании и здоровье. Для веганов и вегетарианцев. Веган рецепты и лайфаки. Статьи о полезном питании и здоровом образе жизни.",
            'image' => asset('img/vegans.jpg')
        ];
    }

    private function getSubscriptionHeaders()
    {
        return [
            'pageTitle' => 'Оформление подписки на Vegans Freedom',
            'url' => asset('/subscription'),
            'title' => 'Оформление подписки на Vegans Freedom',
            'description' => 'Проект Vegans Freedom это познавательный проект о правильном питании и переходе на этичный и здоровый образ жизни. Информация собираемая и распространяемая проектом важна и полезна для всех без исключения, но главным образом для тех кто имеет сострадание и кому не безразлична судьба животных',
            'image' => asset('img/vegans.jpg')
        ];
    }

    private function getAboutHeaders()
    {
        return [
            'pageTitle' => 'О проекте Vegans Freedom',
            'url' => asset('/about'),
            'title' => 'О проекте Vegans Freedom',
            'description' => 'Проект Vegans Freedom это познавательный проект о правильном питании и переходе на этичный и здоровый образ жизни. Информация собираемая и распространяемая проектом важна и полезна для всех без исключения, но главным образом для тех кто имеет сострадание и кому не безразлична судьба животных',
            'image' => asset('img/vegans.jpg')
        ];
    }
}
