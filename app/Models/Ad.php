<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Assist\Util;
use Illuminate\Http\Request;

class Ad extends Model
{
    protected $fillable = ['label', 'inner_id', 'url', 'image', 'title', 'text', 'order', 'status'];

    private static $_IMG_STORAGE = '/public/up/img/ads/';

    /**
     * @param $request
     */
    public static function advertStore($request)
    {
        $data = $request->except('image', 'alias', '_token');
        $ad = new Ad();
        self::fillData($data, $ad);
        $ad->save();
        $id = $ad->id;
        $alias = null;
        if($request->get('alias')) {
            $alias = $request->get('alias');
        }
        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            $imageDirectory = self::$_IMG_STORAGE . $id;
            Util::delDir($imageDirectory);
            $fileName = $_FILES['image']['name'];
            $array = explode('.', $fileName);
            $extension = trim(array_pop($array));

            if($alias) {
                $imagePath = $imageDirectory . "/{$alias}." . $extension;
            } else {
                $imagePath = $imageDirectory . "/image_{$id}." . $extension;
            }
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imageDirectory)) {
                mkdir($_SERVER['DOCUMENT_ROOT'] . $imageDirectory);
            }
            move_uploaded_file($_FILES['image']['tmp_name'],
                $_SERVER['DOCUMENT_ROOT'] . $imagePath
            );
            $ad->setAttribute('image', $imagePath);
        }
        $ad->save();
    }

    public static function adUpdate(Ad $ad, Request $request)
    {
        $data = $request->except('image', 'alias', 'image_del', '_token');
        self::fillData($data, $ad);
        $image_del = $request->get('image_del');
        $id = $ad->getAttribute('id');
        $alias = null;
        if($request->get('alias')) {
            $alias = $request->get('alias');
        }
        if ($image_del) {
            $ad->setAttribute('image', '');
            $imageDirectory = self::$_IMG_STORAGE . $id;
            Util::delDir($imageDirectory);
        }
        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            $imageDirectory = self::$_IMG_STORAGE . $id;
            Util::delDir($imageDirectory);
            $fileName = $_FILES['image']['name'];
            $array = explode('.', $fileName);
            $extension = trim(array_pop($array));
            if($alias) {
                $imagePath = $imageDirectory . "/{$alias}." . $extension;
            } else {
                $imagePath = $imageDirectory . "/image_{$id}." . $extension;
            }
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imageDirectory)) {
                mkdir($_SERVER['DOCUMENT_ROOT'] . $imageDirectory);
            }
            move_uploaded_file($_FILES['image']['tmp_name'],
                $_SERVER['DOCUMENT_ROOT'] . $imagePath
            );
            $ad->setAttribute('image', $imagePath);
        }
        $ad->save();
    }

    public static function adDel(Ad $ad)
    {
        $imageDirectory = self::$_IMG_STORAGE . $ad->id;
        $ad->delete();
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imageDirectory)) {
            Util::delTree($_SERVER['DOCUMENT_ROOT'] . $imageDirectory);
        }
    }

    /**
     * Fills the data from request into Model except nulls
     * @param $data
     * @param $ad
     */
    private static function fillData($data, $ad) {
        foreach($data as $k => $v) {
            if($v !== null) {
                $ad[$k] = $v == '_' ? ' ' : $v;
            }
        }
    }
}
