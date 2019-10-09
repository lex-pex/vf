<?php

namespace App\Models\Board;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class BoardAd extends Model
{

    protected $fillable = [ 'title', 'alias', 'cat_id', 'text', 'image', 'order', 'status' ];

    private static $_IMG_STORAGE = '/img/board/ads/';

    public static function getAd($id){
        return BlogPost::all()->where('id', $id)->first();
    }

    public static function getPostByAlias($alias){
        return BoardAd::all()->where('alias', $alias)->where('status', 1)->first();
    }

    // GET POSTS BY PARTICULAR USER
    public static function getAdsByUser($user_id){
        if($user_id) {
            return $posts = BoardAd::all()->where('user_id', $user_id)->sortByDesc('id');
        }
        return null;
    }

    public static function adStore(Request $request){
        $data = $request->except('image', 'alias', 'text', 'hidden');
        $text = BoardAd::textProcessor($request->get('text'));
        $alias = $request->get('alias');
        if(!$alias) {
            $title = $request->get('title');
            $alias = self::aliasProcessor($title);
        }
        $alias = self::aliasUnique($alias);

        $blogPost = new BoardAd();
        $blogPost->setAttribute('text', $text);
        $blogPost->setAttribute('alias', $alias);
        $blogPost->setAttribute('user_id', $request->user()->id);
        $blogPost->fill($data);
        $blogPost->save();
        $id = $blogPost->getAttribute('id');
        $alias = self::getAliasById($id);
        if (is_uploaded_file($_FILES['image']['tmp_name'])){
            $fileName = $_FILES['image']['name'];
            $array = explode('.', $fileName);
            $extension = trim(array_pop($array));
            $imageDirectory = self::$_IMG_STORAGE . $id;
            $imagePath = $imageDirectory . "/{$alias}." . $extension;
            self::delDir($imageDirectory);
            mkdir($_SERVER['DOCUMENT_ROOT'] . $imageDirectory);
            move_uploaded_file($_FILES['image']['tmp_name'],
                $_SERVER['DOCUMENT_ROOT'] . $imagePath
            );
            $blogPost->setAttribute('image', $imagePath);
        }
        $blogPost->save();
        return $blogPost;
    }

    public static function adUpdate(BoardAd $blogPost, Request $request){

        $data = $request->except('image', 'image_del', 'text', 'alias', 'user_id', 'hidden');

        $text = self::textProcessor($request->get('text'));
        $blogPost->setAttribute('text', $text);

        if($alias = $request->get('alias')){
            $alias = self::aliasUpdate($request->get('alias'), $blogPost->alias);
            $blogPost->setAttribute('alias', $alias);
        }
        $image_del = $request->get('image_del');
        $blogPost->fill($data);
        $blogPost->save();
        $id = $blogPost->getAttribute('id');
        $alias = self::getAliasById($id);
        if ($image_del) {
            $blogPost->setAttribute('image', '');
            $imageDirectory = self::$_IMG_STORAGE . $id;
            self::delDir($imageDirectory);
        }
        if (is_uploaded_file($_FILES['image']['tmp_name'])){
            $imageDirectory = self::$_IMG_STORAGE . $id;
            self::delDir($imageDirectory);
            $fileName = $_FILES['image']['name'];
            $array = explode('.', $fileName);
            $extension = trim(array_pop($array));
            $imagePath = $imageDirectory . "/{$alias}." . $extension;
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imageDirectory)){
                mkdir($_SERVER['DOCUMENT_ROOT'] . $imageDirectory);
            }
            move_uploaded_file($_FILES['image']['tmp_name'],
                $_SERVER['DOCUMENT_ROOT'] . $imagePath
            );
            $blogPost->setAttribute('image', $imagePath);
        }
        $blogPost->save();
    }

    public static function adDelete(BoardAd $blogPost){
        $imageDirectory = self::$_IMG_STORAGE . $blogPost->id;
        $blogPost->delete();
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imageDirectory)){
            self::delTree($_SERVER['DOCUMENT_ROOT'] . $imageDirectory);
        }
    }

    // SERVICE METHODS OF THIS
    private static function textProcessor($text){
//        $lines = trim(preg_replace('/[\n\r]{2,}/', "\n", $text));
//        return trim(preg_replace('/\s{3,}/', ' ', $lines));
        return $text;
    }

    private static function delDir($directory){
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $directory)){
            self::delTree($_SERVER['DOCUMENT_ROOT'] . $directory);
        }
    }

    private static function delTree($dir){
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    public static function getAllAds(){
        return BoardAd::all()->sortByDesc('id');
    }

    public static function getAll(){
        return BoardAd::all('id', 'title')->sortByDesc('id');
    }

    public static function getStatus($id){
        return BoardAd::all()->where('id', $id)->first()->status;
    }

    public static function getAliasById($post_id){
        return BoardAd::select('alias')->where('id', $post_id)->first()->alias;
    }

    // Alias Processing
    private static function aliasProcessor($text){

        $symbols = trim(preg_replace('/[\n\r]{2,}/', "\n", $text));

        $wordsArray = explode(' ', $symbols);
        $wordsArray = array_slice($wordsArray, 0, 5);
        $symbols = implode(' ', $wordsArray);

        $symbols = mb_strtolower($symbols);
        $str = $symbols;
        $len = mb_strlen($str);
        $chars = array();
        for ($k = 0; $k < $len; $k++){
            $chars[] = mb_substr($str, $k, 1);
        }
        $result = '';
        for ($i = 0; $i < count($chars); $i ++){
            $result .= self::changeSymbol($chars[$i]);
        }
        return $result;
    }

    private static function changeSymbol($symbol){
        $map = [' ' => '_','а' => 'a','б' => 'b','в' => 'v','г' =>'g','д' => 'd','е' => 'e','ё' => 'yo','.'=>'','%'=>'pc','='=>'',
            'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'j', 'і' => 'i', 'ї' => 'j', 'к' => 'k','л' => 'l',
            'м' => 'm','н' => 'n','о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch','ш' => 'sh', 'щ' => 'shch', 'ъ' => '','ы' => 'y',
            'ь' => '', 'э' => 'e', 'ю' => 'yu','я' => 'ya','?' => '','!' => '', '/' => '', '\\' => '', ',' => '','"' => '', "'" => ''];
        return array_key_exists($symbol, $map) ? $map[$symbol] : $symbol;
    }

    private static function aliasUpdate($alias, $native){
        if($alias == $native){
            return $alias;
        }
        $alias = self::aliasProcessor($alias);
        return self::aliasUnique($alias);
    }

    private static function aliasUnique($alias){
        $result = $alias;
        while (BoardAd::where('alias', '=', $result)->exists()){
            $result .= 'I';
        }
        return $result;
    }
}
