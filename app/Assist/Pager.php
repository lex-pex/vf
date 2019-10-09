<?php

namespace App\Assist;

use App\Models\BlogPost;

class Pager
{
    private static $limit = 10;

    public static function search(string $query, int $num) {

        $limit = self::$limit;
        $blogPosts =
            BlogPost::where('status', 1)->where('title', 'like', '%' . $query . '%')
                ->orWhere('text', 'like', '%' . $query . '%')
                ->orderByDesc('id');
        $total = $blogPosts->count();
        $amountPages = self::actualPages($limit, $total);
        if($num > $amountPages || $num < 1) return null;
        $skip = ($num - 1) * $limit;
        $rs = $blogPosts->skip($skip)->take($limit)->get();
        return (['pager' => self::searchPager($query, $amountPages, $num), 'result_set' => $rs]);
    }

    private static function searchPager($q, $amount, $active) {
        if($active == 0) $active = 1;
        $res = [];
        if($amount <= 1) return $res;  // Empty it is one page
        $p = 'search?query=' . $q . '&page=';
        $res[] = ['label' => '<', 'urn' => $p . ($active - 1), 'class' => ($active == 1 ? 'disabled' : '')];
        if($amount < 6) {
            for ($i = 1; $i <= $amount; $i++)
                $res[] = ['label' => $i, 'urn' => $p . $i, 'class' => ($active == $i ? 'active' : '')];
        } else {

            if ($active < 4) {
                $res[] = ['label' => 1, 'urn' => $p . 1, 'class' => ($active == 1 ? 'active' : '')];
                $res[] = ['label' => 2, 'urn' => $p . 2, 'class' => ($active == 2 ? 'active' : '')];
                $res[] = ['label' => 3, 'urn' => $p . 3, 'class' => ($active == 3 ? 'active' : '')];
                $res[] = ['label' => '...', 'urn' => '', 'class' => 'disabled'];
                $res[] = ['label' => $amount, 'urn' => $p . $amount, 'class' => ($active == $amount ? 'active' : '')];
            } elseif (($amount - $active) < 3) {
                $res[] = ['label' => 1, 'urn' => $p . 1, 'class' => ($active == 1 ? 'active' : '')];
                $res[] = ['label' => '...', 'urn' => '', 'class' => 'disabled'];
                $res[] = ['label' => ($amount - 2), 'urn' => $p . ($amount - 2), 'class' => ($active == ($amount - 2) ? 'active' : '')];
                $res[] = ['label' => ($amount - 1), 'urn' => $p . ($amount - 1), 'class' => ($active == ($amount - 1) ? 'active' : '')];
                $res[] = ['label' => ($amount), 'urn' => $p . ($amount), 'class' => ($active == $amount ? 'active' : '')];
            } else {
                $res[] = ['label' => 1, 'urn' => $p . 1, 'class' => ($active == 1 ? 'active' : '')];
                $res[] = ['label' => '...', 'urn' => '',  'class' => 'disabled'];
                $res[] = ['label' => $active, 'urn' => $p . $active, 'class' => 'active'];
                $res[] = ['label' => '...', 'urn' => '',  'class' => 'disabled'];
                $res[] = ['label' => $amount, 'urn' => $p . $amount, 'class' => ($active == $amount ? 'active' : '')];
            }
        }
        $res[] = ['label' => '>', 'urn' => $p . ($active + 1), 'class' => ($active == $amount ? 'disabled' : '')];
        return $res;
    }

    public static function feed(int $category, int $num) {
        $limit = self::$limit;
        if($category > 0) $query = ['status' => 1, 'category_id' => $category];
        else $query = ['status' => 1];
        $total = BlogPost::where($query)->count();
        $amountPages = self::actualPages($limit, $total);
        if($num > $amountPages) return null;
        if($num == 0 || $num == $amountPages) { // Title Page Content
            $rs = BlogPost::where($query)->orderBy('id', 'desc')->take($limit)->get();
        } else { // Previous Page Contend
            $skip = ($num - 1) * $limit;
            $rs = BlogPost::where($query)->skip($skip)->take($limit)->get();
        }
        $rs = $rs->sortByDesc('id');
        return (['pager' => self::pager($amountPages, $num), 'result_set' => $rs]);
    }

    private static function pager($amount, $active) {
        if($active == 0) $active = $amount;
        $res = [];
        if($amount <= 1) return $res;  // Empty it is one page
        $res[] = ['label' => '<', 'urn' => 'page/'. ($active + 1), 'class' => ($active == $amount ? 'disabled' : '')];
        if($amount < 6) {
            for ($i = $amount; $i > 0; $i--)
                $res[] = ['label' => $i, 'urn' => ($i == $amount ? '' : 'page/' . $i), 'class' => ($active == $i ? 'active' : '')];
        } else {
            if(($amount - $active) < 3) {
                $res[] = ['label' => $amount, 'urn' => '', 'class' => ($active == $amount ? 'active' : '')];
                $res[] = ['label' => ($amount - 1), 'urn' => 'page/'.($amount - 1), 'class' => ($active == ($amount - 1) ? 'active' : '')];
                $res[] = ['label' => ($amount - 2), 'urn' => 'page/'.($amount - 2), 'class' => ($active == ($amount - 2) ? 'active' : '')];
                $res[] = ['label' => '...', 'urn' => '',  'class' => 'disabled'];
                $res[] = ['label' => 1, 'urn' => 'page/1', 'class' => ($active == 1 ? 'active' : '')];
            } elseif ($active < 3) {
                $res[] = ['label' => $amount, 'urn' => '', 'class' => ($active == $amount ? 'active' : '')];
                $res[] = ['label' => ($amount - 1), 'urn' => 'page/'.($amount - 1), 'class' => ($active == ($amount - 1) ? 'active' : '')];
                $res[] = ['label' => '...', 'urn' => '',  'class' => 'disabled'];
                $res[] = ['label' => 2, 'urn' => 'page/2', 'class' => ($active == 2 ? 'active' : '')];
                $res[] = ['label' => 1, 'urn' => 'page/1', 'class' => ($active == 1 ? 'active' : '')];
            } else {
                $res[] = ['label' => $amount, 'urn' => '', 'class' => ($active == $amount ? 'active' : '')];
                $res[] = ['label' => '...', 'urn' => '',  'class' => 'disabled'];
                $res[] = ['label' => $active, 'urn' => 'page/'.$active, 'class' => 'active'];
                $res[] = ['label' => '...', 'urn' => '',  'class' => 'disabled'];
                $res[] = ['label' => 1, 'urn' => 'page/1', 'class' => ($active == 1 ? 'active' : '')];
            }
        }
        $res[] = ['label' => '>', 'urn' => 'page/'. ($active - 1), 'class' => ($active == 1 ? 'disabled' : '')];
        return $res;
    }

    // Calculate Actual Amount of Pages
    private static function actualPages($limit, $total)
    {
        $additionalPage = $total % $limit;
        $actual = ($total - ($additionalPage)) / $limit;
        if($additionalPage) $actual++;
        return $actual;
    }
    // Calculate either page is last
    public static function isLast($category, $page) {
        $limit = self::$limit;
        if($category > 0) $query = ['status' => 1, 'category_id' => $category];
        else $query = ['status' => 1];
        $total = BlogPost::where($query)->count();
        $amountPages = self::actualPages($limit, $total);
        return $page == $amountPages;
    }
}
