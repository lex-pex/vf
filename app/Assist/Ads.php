<?php

namespace App\Assist;

use App\Models\Ad;
use App\Models\BlogPost;
use App\Models\Category;

class Ads
{
    public static function getAll() {

        $ads = Ad::all()->sortBy('id')->sortBy('order');

        foreach($ads as $ad) {

            if($inner_id = $ad->inner_id) {
                $bp = BlogPost::find($inner_id);
                $ad->url = $ad->url ? $ad->url : '/' . Category::find($bp->category_id)->alias . '/' . $bp->alias;
                $ad->image = $ad->image ? $ad->image : $bp->image;
                $ad->title = $ad->title ? $ad->title : $bp->title;
                $ad->text = $ad->text ? $ad->text : $bp->text;
            }

        }
        return $ads;
    }
}