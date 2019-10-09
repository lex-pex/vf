<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostManager extends Controller
{

    public function postAdd(){
        if(!Auth::check()) return abort(404);
        $hiddenOption = Auth::user()->role == 'admin';
        if($hiddenOption)
            $categories = Category::getAdminCategories();
        else
            $categories = Category::getCategories();
        return view('post.add', [
            'headers' => $this->getAddHeaders(),
            'currentCategory' => 0,
            'categories' => $categories
        ]);
    }

    public function postEdit($id) {
        $blogPost = BlogPost::getPost($id);
        $category_id = $blogPost->category_id;
        $this->headers = $this->getPostHeaders($blogPost);

        $hiddenOption = Auth::user()->role == 'admin';
        if($hiddenOption)
            $categories = Category::getAdminCategories();
        else
            $categories = Category::getCategories();


        return view('post.edit', [
            'headers' => $this->getEditHeaders($id),
            'currentCategory' => $category_id,
            'blogPost' => $blogPost,
            'categories' => $categories,
            'hiddenOption' => $hiddenOption
        ]);
    }

    public function postStore(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:200', // unique:blog_posts|
            'text' => 'required|max:40000',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $blogPost = BlogPost::postStore($request);
        return redirect('preview/' . $blogPost->id);
    }

    public function preview($post_id) {
        $blogPost = BlogPost::getPost($post_id);
        $category_id = $blogPost->category_id;
        return view('post.preview', [
            'headers' => $this->getPostHeaders($blogPost),
            'currentCategory' => $category_id,
            'blogPost' => $blogPost
        ]);
    }

    public function postDelete(BlogPost $blogPost, $confirm = false) {
        $category_id = $blogPost->getAttribute('category_id');
        BlogPost::postDelete($blogPost);
        return redirect(route('index', Category::getAliasById($category_id)));
    }

    public function confirmDelete(BlogPost $blogPost) {

//        dd('Confirm Page');

        $category_id = $blogPost->category_id;

        return view('post.del', [
            'headers' => $this->getDelHeaders(),
            'currentCategory' => $category_id,
            'blogPost' => $blogPost
        ]);
    }

    public function postUpdate(BlogPost $blogPost, Request $request) {
        $post_id = $blogPost->id;
        $this->validate($request, [
            'title' => 'required|max:200',
            'text' => 'required|max:40000',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        BlogPost::postUpdate($blogPost, $request);
        return redirect('preview/' . $blogPost->id);
    }

    /* Pages Headers */

    private function getPostHeaders(BlogPost $blogPost)
    {
        $category = Category::find($blogPost->category_id);
        return [
            'pageTitle' => $blogPost->title . ' | ' .$category->name . ' | Vegans Freedom',
            'url' => asset($category->alias . '/' . $blogPost->alias),
            'title' => $blogPost->title,
            'description' => $this->postDescription($blogPost->text),
            'image' => asset($blogPost->image)
        ];
    }

    private function getAddHeaders()
    {
        return [
            'pageTitle' => 'Добавление публикации | Vegans Freedom',
            'url' => asset('/add'),
            'title' => 'Добавление публикации',
            'description' => 'Добавление публикации на сайт | Vegans Freedom',
            'image' => asset('/img/vegans.jpg'),
        ];
    }

    private function getEditHeaders(int $id)
    {
        return [
            'pageTitle' => 'Изменение публикации | Vegans Freedom',
            'url' => asset('/edit/'.$id),
            'title' => 'Изменение публикации',
            'description' => 'Добавление публикации на сайт | Vegans Freedom',
            'image' => '/img/vegans.jpg',
        ];
    }

    private function getDelHeaders()
    {
        return [
            'pageTitle' => 'Удаление публикации | Vegans Freedom',
            'url' => '/',
            'title' => 'Подтвердить Удаление Публикации',
            'description' => 'Удаление публикации на сайт | Vegans Freedom',
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
