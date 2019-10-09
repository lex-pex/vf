<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BlogPost;
use Auth;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{
    public function profile($id) {
        $category_id = 1;
        if(!$user = User::get($id)) return abort(404);
        if($currentUser = Auth::user()) {
            $editButton = $currentUser->role == 'admin' || $user->id == $currentUser->id;
        } else {
            $editButton = false;
        }
        $posts = BlogPost::getPostsByUser($user->id);
        if ($user) {
            return view('profile.profile', [
                'headers' => $this->getProfileHeaders($user),
                'currentCategory' => $category_id,
                'user' => $user,
                'edit' => $editButton,
                'posts' => $posts,
            ]);
        } else return redirect(route('index')); // 404
    }
    public function profiles() {
        $category_id = 1;
        return view('profile.profiles', [
            'headers' => $this->getProfilesHeaders(),
            'users' => User::getUsers(),
            'currentCategory' => $category_id,
        ]);
    }
    // Preparing profile headers
    private function getProfileHeaders($user)
    {
        return [
            'pageTitle' => 'Участник проэкта ' . $user->name . ' | Vegan Freedom',
            'url' => route('profile', ['id' => $user->id]),
            'title' => 'профиль пользователя',
            'description' => $this->postDescription($user->about),
            'image' => URL::asset($user->avatar)
        ];
    }
    private function getProfilesHeaders()
    {
        return [
            'pageTitle' => 'Участники Vegans Freedom',
            'url' => route('profiles'),
            'title' => 'Участники и Пользователи',
            'description' => 'Участники и пользователи сайта Vegan Freedom. Тут представлен список пользователей, авторов и участников проекта Веганс Фридом. Каждый зарегистрированный пользователь может предложить свою статью к публикации, для поддержки проэкта и тем самым представить себя сообществу, расширить круг друзей и познакомится с близкими по духу людьми',
            'image' => '/img/vegans.jpg',
        ];
    }
    // Preparing description for header
    private function postDescription($text)
    {
        $descriptionArray = explode(' ', $text);
        $descriptionArray = array_slice($descriptionArray, 0, 30);
        return implode(' ', $descriptionArray);
    }
}
