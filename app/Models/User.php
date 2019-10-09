<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    private static $defAva = 'avatar.jpg';
    private static $imgDirBig = '/public/avabig/';
    private static $imgDirSmall = '/public/avatars/';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function get($id) {
        return User::select()->where('id', $id)->first();
    }

    public static function name($id) {
        if($user = User::select()->where('id', $id)->first())
            return $user->name;
        else return 'User deleted';
    }

    public static function avatar($id) {
        if($user = User::find($id))
            return $user->avatar;
        else return self::$defAva;
    }

    public static function updateUser(User $user, Request $request) {
        if ($request->name) {
            $user->setAttribute('name', $request->name);
        }
        if ($request->email) {
            $user->setAttribute('email', $request->email);
        }
        if ($request->about) {
            $user->setAttribute('about', $request->about);
        }
        $image_del = $request->get('image_del');
        $id = $user->id;
        if ($image_del) {
            if ($user->avatar != self::$defAva) {
                self::delDir(self::$imgDirBig . $id);
                self::delDir(self::$imgDirSmall . $id);
                $user->setAttribute('avatar', self::$defAva);
            }
        }
        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            $fileName = $_FILES['image']['name'];
            $array = explode('.', $fileName);
            $extension = trim(array_pop($array));
            $imageName = hash('md5', time()) . '.' . $extension;
            $imageDirOriginal = self::$imgDirBig . $id;
            $imagePathOriginal = $imageDirOriginal . '/' . $imageName;
            $imageDirSmall = self::$imgDirSmall . $id;
            self::delDir($imageDirOriginal);
            self::delDir($imageDirSmall);
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imageDirOriginal)) {
                mkdir($_SERVER['DOCUMENT_ROOT'] . $imageDirOriginal);
            }
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imageDirSmall)) {
                mkdir($_SERVER['DOCUMENT_ROOT'] . $imageDirSmall);
            }
            move_uploaded_file($_FILES['image']['tmp_name'],
                $_SERVER['DOCUMENT_ROOT'] . $imagePathOriginal
            );
            self::avatarSmall($_SERVER['DOCUMENT_ROOT'] . $imagePathOriginal, $id . '/' . $imageName);
            $user->setAttribute('avatar', $id . '/' . $imageName);
        }
        $user->save();
    }

    private static function avatarSmall($source, $imageName){
        // https://zhitenev.ru/php-proportsionalnoe-umenshenie-izobrazheniya/
        $size=GetImageSize ($source); //initial size of img
        $src=ImageCreateFromJPEG ($source); //intermediate image
        $iw=$size[0]; //image width
        $ih=$size[1]; //image height
        $ratio=$iw/150; //ratio of pixels amounts
        $new_h=ceil ($ih/$ratio); //divide height by the ratio and round up to an integer
        $dst=ImageCreateTrueColor (150, $new_h); //creates an empty picture
        ImageCopyResampled ($dst, $src, 0, 0, 0, 0, 150, $new_h, $iw, $ih); //copy rectangular area
        ImageJPEG ($dst, $_SERVER['DOCUMENT_ROOT']. self::$imgDirSmall . $imageName, 100); //save the image
        imagedestroy($src); //erase the intermediate
    }

    public static function userDelete(User $user)
    {
        $avatar = $user->avatar;
        $user->setAttribute('name', 'DELETED_X');
        $user->setAttribute('avatar', self::$defAva);
        $user->save();
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $avatar)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $avatar);
        }
    }

    public static function getUsers() {
        return User::all()->where('name', '!=', 'DELETED_X')->sortByDesc('created_at');
    }

    public static function getUsersAdmin() {
        return User::all()->sortByDesc('created_at');
    }

    private static function delDir($directory)
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $directory)) {
            self::delTree($_SERVER['DOCUMENT_ROOT'] . $directory);
        }
    }

    private static function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }


}
