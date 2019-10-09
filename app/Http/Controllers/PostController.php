<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\BlogPost;
use App\Models\Category;

class PostController extends Controller
{
    public function post($rubric, $post) {
        if(!$cat = Category::where('alias', $rubric)->first()) return abort(404);
        if(!$post = BlogPost::where('category_id', $cat->id)->where('alias', $post)->first()) return abort(404);
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $is_admin = Auth::user()->role == 'admin';
            $editButton = $user_id == $post->user_id || $is_admin;
        } else {
            $user_id = 0;
            $is_admin = false;
            $editButton = false;
        }
        $category_id = $post->category_id;
        return view('pages.post', [
            'headers' => $this->getPostHeaders($cat, $post),
            'currentCategory' => $category_id,
            'categoryName' => $cat->name,
            'categoryUrn' => $cat->alias,
            'blogPost' => $post,
            'edit' => $editButton,
            'user_id' => $user_id,
            'is_admin' => $is_admin,
        ]);
    }

    // HEADERS Preparing headers for Post-Page
    private function getPostHeaders(Category $cat, BlogPost $post)
    {
        return [
            'pageTitle' => $post->title . ' | ' .$cat->name . ' | Vegans Freedom',
            'url' => asset($cat->alias . '/' . $post->alias),
            'title' => $post->title,
            'description' => $this->postDescription($post->text),
            'image' => $post->image
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
