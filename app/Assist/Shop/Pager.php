<?php
namespace App\Assist\Shop;
use App\Models\Shop\Product;
class Pager
{
    private static $limit = 9;
    public static function feed(int $category, int $num) {
        $limit = self::$limit;
        if($category > 0) $query = ['status' => 1, 'category' => $category];
        else $query = ['status' => 1];
        $products = Product::where($query)->orderBy('sort');
        $total = $products->count();
        $amountPages = self::actualPages($limit, $total);
        if($num > $amountPages) return null;
        $skip = ($num - 1) * $limit;
        $rs = $products->skip($skip)->take($limit)->get();
        $rs = $rs->sortByDesc('sort_order');
        return (['pager' => self::pager($amountPages, $num), 'result_set' => $rs]);
    }

    public static function pager($amount, $active) {
        if($active == 0) $active = 1;
        $res = [];
        if($amount <= 1) return $res;  // Empty when is one page
        $p = 'page/';
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
                $res[] = ['label' => ($amount), 'urn' => $p . $amount, 'class' => ($active == $amount ? 'active' : '')];
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
    // Calculate Actual Amount of Pages
    private static function actualPages($limit, $total)
    {
        $additionalPage = $total % $limit;
        $actual = ($total - ($additionalPage)) / $limit;
        if($additionalPage) $actual++;
        return $actual;
    }

    public static function search(string $query, int $num) {
        $limit = self::$limit;
        $products =
            Product::where('status', 1)->where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%');
        $total = $products->count();
        $amountPages = self::actualPages($limit, $total);
        if($num > $amountPages || $num < 1) return null;
        $skip = ($num - 1) * $limit;
        $rs = $products->skip($skip)->take($limit)->get();
        return (['pager' => self::searchPager($query, $amountPages, $num), 'result_set' => $rs]);
    }

    private static function searchPager($q, $amount, $active) {
        if($active == 0) $active = 1;
        $res = [];
        if($amount <= 1) return $res;  // Empty it is one page
        $p = 'shop/search?query=' . $q . '&page=';
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
}