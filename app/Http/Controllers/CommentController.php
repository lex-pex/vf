<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function commentAdd(Request $request) {
        $this->validate($request, [
            'author' => 'required|min:2|max:70', // unique:blog_posts|
            'text' => 'required|min:3|max:1000',
        ]);
        if(!Auth::check() && $request->capcha != '123') {
            return redirect()->back()->withErrors(['capcha' => ['Проверочный код введен не правильно']]);
        }
        Comment::commentStore($request);
        return redirect()->back();
    }

    public function commentEdit(Request $request) {
        $this->validate($request, [
            'author' => 'required|min:2|max:70', // unique:blog_posts|
            'text' => 'required|min:3|max:1000',
        ]);
        if(!Auth::check() && $request->capcha != 123) {
            return redirect()->back()->withErrors(['capcha' => ['Проверочный код введен не правильно']]);
        }
        Comment::commentUpdate($request);
        return redirect()->back();
    }

    public function commentDelete($id) {
        Comment::commentDelete($id);
        return redirect()->back();
    }

    // CATEGORIES LIST
    public function commentsAdmin() {
        $comments = Comment::getAdminComments();
        $category_id = 0;
        $user = Auth::user();
        if ($user) {
            return view('admin.comments.comments', [
                'headers' => $this->adminCommentsHeaders(),
                'currentCategory' => $category_id,
                'comments' => $comments,
                'user' => $user,
            ]);
        } else return redirect(route('index')); // 404
    }

    private function adminCommentsHeaders(){
        return [
            'pageTitle' => 'Комментарии | Admin | Vegans Freedom',
            'url' => 'admin/comments',
            'title' => 'Все комментарии',
            'description' => 'Все Комментарии Сайта | Admin | Vegans Freedom',
            'image' => '/img/vegans.jpg'
        ];
    }
}





