<?php

namespace App\Http\Middleware;

use App\Models\BlogPost;
use Closure;

class Edit
{
    public function handle($request, Closure $next)
    {
        $postId = $request->route('id');
        if ($postId == null) {
            $uri = $request->getUri();
            $arr = explode('/', $uri);
            $postId = trim(array_pop($arr));
        }
        $blogPost = BlogPost::getPost($postId);
        $user = $request->user();
        if($blogPost == null || $user == null) {
            return redirect()->back();
        }
        $userId = $user->id;
        $userRole = $user->role;
        $postUser = $blogPost->user_id;
        if($userRole != 'admin')
            if ($userId != $postUser)
                return redirect()->back();
        return $next($request);
    }
}
