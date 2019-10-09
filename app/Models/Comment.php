<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Comment extends Model
{
    protected $fillable = ['author', 'user_id', 'post_id', 'text'];

    public static function getPostComments($post_id) {
//        return Comment::all()->where('post_id', $post_id)->sortBy('created_at');
        return Comment::all()->where('post_id', $post_id)->sortByDesc('created_at');
    }

    public static function commentStore(Request $request)
    {
        $data = $request->except('text', 'hidden');
        $text = Comment::textProcessor($request->get('text'));
        $comment = new Comment();
        $comment->setAttribute('text', $text);
        $comment->fill($data);
        $comment->save();
        return $comment;
    }

    public static function commentUpdate($request)
    {
        $data = $request->except('id', 'text');
        $id = $request->id;
        $text = Comment::textProcessor($request->get('text'));
        $comment = Comment::all()->where('id', $id)->first();
        $comment->setAttribute('text', $text);
        $comment->fill($data);
        $comment->save();
        return $comment;
    }

    public static function commentDelete($id)
    {
        $comment = Comment::all()->where('id', $id)->first();
        $comment->delete();
        return $comment;
    }

    public static function getAdminComments() {
        return Comment::all()->sortByDesc('created_at');
    }

    // SERVICE METHODS OF THIS
    private static function textProcessor($text)
    {
        $lines = trim(preg_replace('/[\n\r]{2,}/', "\n", $text));
        return trim(preg_replace('/\s{3,}/', ' ', $lines));
    }

    public static function amount($post_id) {
        return Comment::all()->where('post_id', $post_id)->count();
    }

}
