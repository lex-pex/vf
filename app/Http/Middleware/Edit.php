<?php
namespace App\Http\Middleware;
use App\Models\BlogPost;
use Closure;
class Edit
{
    public function handle($request, Closure $next)
    {
        $blogPost = null;
        // In case request with 'id' parameter
        if ($postId = $request->route('id')) {
            $blogPost = BlogPost::getPost($postId);
        }
        // In case request with 'blogPost' as id parameter
        if($blogPost == null) {
            $blogPost = $request->route('blogPost');
            if(is_numeric($blogPost)) {
                $blogPost = BlogPost::getPost($blogPost);
            }
        }
        // In case request doesn't specify variable 
        if($blogPost == null) {
            $uri = $request->getUri();
            $arr = explode('/', $uri);
            $postId = trim(array_pop($arr));
            for($i = 0; $i < count($arr); $i++)
                if(is_numeric($arr[$i]))
                    $blogPost = BlogPost::getPost($postId);
        }
        // Is User Available 
        $user = $request->user();
        if($user == null) {
            return abort(401);
        }
        // Is Check Blog available
        if($blogPost == null) {
            return abort(401);
        }
        // Actual Check Rights 
        $authId = $user->id;
        $role = $user->role;
        $author = $blogPost->user_id;
        if($role != 'admin')
            if ($authId != $author)
                return abort(401);
        return $next($request);
    }
}