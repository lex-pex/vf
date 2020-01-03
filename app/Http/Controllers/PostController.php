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

        if(!$is_admin || Auth::user()->role == 'client')
            $this->checkPrepaid($post);

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

    private function checkPrepaid($post)
    {
        $message = $this->prepaidMessage();
        $trimOl = $this->trimOlContent($post->text, $message);
        $trimUl = $this->trimUlContent($trimOl, $message);
        $trimPrepaid = $this->trimPrepaidContent($trimUl, $message);
        $post->text = $trimPrepaid;
    }

    // Trimming prepaid content

    private function trimOlContent($text, $message) {
        $resultOl = '';
        $chunkOl = explode('<ol>', $text);
        if(count($chunkOl) > 1) {
            $resultOl .= $chunkOl[0];
            for ($i = 1; $i < count($chunkOl); $i++) {
                $slice = explode('</ol>', $chunkOl[$i]);
                $resultOl .= $message;
                $resultOl .= isset($slice[1]) ? $slice[1] : '';
            }
        } else {
            $resultOl = $text;
        }
        return $resultOl;
    }

    private function trimUlContent($text, $message) {
        $resultUl = '';
        $chunkUl = explode('<ul>', $text);
        if(count($chunkUl) > 1) {
            $resultUl .= $chunkUl[0];
            for ($i = 1; $i < count($chunkUl); $i++) {
                $slice = explode('</ul>', $chunkUl[$i]);
                $resultUl .= $message;
                $resultUl .= isset($slice[1]) ? $slice[1] : '';
            }
        } else {
            $resultUl = $text;
        }
        return $resultUl;
    }


    private function trimPrepaidContent($text, $message) {
        $resultPrepaid = '';
        $chunkPrepaid = explode('<prepaid-content>', $text);
        if(count($chunkPrepaid) > 1) {
            $resultPrepaid .= $chunkPrepaid[0];
            for ($i = 1; $i < count($chunkPrepaid); $i++) {
                $slice = explode('</prepaid-content>', $chunkPrepaid[$i]);
                $resultPrepaid .= $message;
                $resultPrepaid .= isset($slice[1]) ? $slice[1] : '';
            }
        } else {
            $resultPrepaid = $text;
        }
        return $resultPrepaid;
    }

    private function prepaidMessage() {
        $message =
            '. . . . . . <em class="text-muted">оформляй подписку:</em>' .
            '<div style="border-radius:15px;border:1px dotted green; font-size: 20px;color:limegreen;text-align:center">'.
            '<span style="font-size:12px;color:firebrick;"> платный контент </span><br/>'.
            '<span style="font-size: 25px;color:#c44ec4;"> Планируешь Жить Долго? </span><br/>'.
            'У нас классные идеи блюд <br/>'.
            'рецептов и секретов <br/>'.
            'здоровья и долголетия <br/>'.
            'оформляйте подписку <br/>'.
            'всего <span class="cyphers"> $1<sup>00</sup> в месяц </span><br/>'.
            '<hr/>'.
            '<p><a href="/subscription" style="border-radius: 0" class="btn btn-success"> КУПИТЬ </a> </p>'.
            '</div>';
        return $message;
    }
}




















