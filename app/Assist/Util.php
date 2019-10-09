<?php


namespace App\Assist;
use Illuminate\Database\Eloquent\Model;

class Util
{

    public static function uploadImage(Model $item, string $storage) {

        if (is_uploaded_file($_FILES['image']['tmp_name'])){
            $fileName = $_FILES['image']['name'];
            $array = explode('.', $fileName);
            $extension = trim(array_pop($array));
            $imageDirectory = $storage . $item->id;
            $imagePath = $imageDirectory .  "/{$item->alias}." . $extension;
            self::delDir($imageDirectory);
            mkdir($_SERVER['DOCUMENT_ROOT'] . $imageDirectory);
            move_uploaded_file($_FILES['image']['tmp_name'],
                $_SERVER['DOCUMENT_ROOT'] . $imagePath
            );
            $item->setAttribute('image', $imagePath);
            $item->save();
        }

    }

    public static function textProcessor(string $text){
        $lines = trim(preg_replace('/[\n\r]{2,}/', "\n", $text));
        return trim(preg_replace('/\s{3,}/', ' ', $lines));
    }

    public static function delDir($directory)
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $directory)) {
            self::delTree($_SERVER['DOCUMENT_ROOT'] . $directory);
        }
    }

    public static function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    // Alias Processing
    public static function aliasProcessor(string $text){
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

    public static function aliasUpdate($alias, Model $model){
        if($alias == $model->alias){
            return $alias;
        }
        $alias = self::aliasProcessor($alias);
        return self::aliasUnique($alias, $model);
    }

    private static function changeSymbol($symbol){
        $map = [' ' => '_','а' => 'a','б' => 'b','в' => 'v','г' =>'g','д' => 'd','е' => 'e','ё' => 'yo','.'=>'','%'=>'pc','='=>'',
            'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'j', 'і' => 'i', 'ї' => 'j', 'к' => 'k','л' => 'l',
            'м' => 'm','н' => 'n','о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch','ш' => 'sh', 'щ' => 'shch', 'ъ' => '','ы' => 'y',
            'ь' => '', 'э' => 'e', 'ю' => 'yu','я' => 'ya','?' => '','!' => '', '/' => '', '\\' => '', ',' => '','"' => '', "'" => ''];
        return array_key_exists($symbol, $map) ? $map[$symbol] : $symbol;
    }

    public static function aliasUnique($alias, Model $model){
        $result = $alias;
        while ($model::where('alias', $result)->exists())
            $result .= 'I';
        return $result;
    }

}