<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ad;

class AdController extends Controller
{
    public function ads() {
        $category_id = 0;
        return view('admin.ads.ads', [
            'headers' => $this->getListHeaders(),
            'currentCategory' => $category_id,
        ]);

    }

    public function adAdd() {
        $category_id = 0;
        return view('admin.ads.add', [
            'headers' => $this->getAddHeaders(),
            'currentCategory' => $category_id,
        ]);
    }

    public function adStore(Request $request) {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        Ad::advertStore($request);
        return redirect(route('ads'));
    }

    public function adEdit(Ad $ad) {
        $category_id = 1;
        return view('admin.ads.edit', [
            'headers' => $this->getEditHeaders($ad),
            'currentCategory' => $category_id,
            'ad' => $ad,
        ]);
    }

    public function adUpdate(Request $request, Ad $ad) {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        Ad::adUpdate($ad, $request);
        return redirect(route('ads'));
    }

    public function adDel(Ad $ad) {
        if ($ad) {
            Ad::adDel($ad);
        }
        return redirect(route('ads'));
    }

    /* * * Pages Headers * * */

    private function getListHeaders() {
        return [
            'pageTitle' => 'Объявления | Admin VF',
            'url' => '/admin/ads/ads/',
            'title' => 'Список Объявлений',
            'description' => 'Список Всех Объявлений | VegansFreedom',
            'image' => '/img/vegans.jpg'];
    }

    private function getAddHeaders() {
        return [
            'pageTitle' => 'Добавить Объявление | Admin VF',
            'url' => '/admin/ad/add/',
            'title' => 'Добавить Объявление',
            'description' => 'Добавление Объявления | VegansFreedom',
            'image' => '/img/vegans.jpg'];
    }

    private function getEditHeaders($ad) {
        return [
            'pageTitle' => 'Редактировать Объявление | Admin VF',
            'url' => '/admin/ad/edit/' . $ad->id,
            'title' => 'Редактировать Объявление',
            'description' => 'Редактировать Объявления | VegansFreedom',
            'image' => '/img/vegans.jpg'];
    }
}
