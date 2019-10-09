<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Category;

class CategoryManager extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }

    public function categoryEdit(Category $category) {
        $categories = Category::getCategories();
        $category_id = 0;
        return view('shop.category.edit', [
            'headers' => $this->categoryEditHeaders($category),
            'currentCategory' => $category_id,
            'categories' => $categories,
            'category' => $category,
        ]);
    }

    public function categoryAdd() {

        $categories = Category::getCategories();
        $category_id = 0;

        return view('shop.category.add', [
            'headers' => $this->categoryAddHeaders(),
            'currentCategory' => $category_id,
            'categories' => $categories,
        ]);
    }

    public function categoryStore(Request $request) {
        $this->validate($request, [
            'name' => 'unique:categories|required|max:100',
            'alias' => 'unique:categories|required|max:100'
        ]);
        if($request->post()) {
            Category::categoryStore($request);
        }
        return redirect(route('categories'));
    }

    public function categoryUpdate(Request $request, Category $category) {
        $this->validate($request, [
            'name' => 'required|max:100',
            'alias' => 'required|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->post()) {
            Category::categoryUpdate($category, $request);
        }
        return redirect(route('categories'));
    }

    public function categoryDelete(Category $category) {
        Category::categoryDelete($category);
        return redirect(route('categories'));
    }

    /* Pages Headers */

    private function categoryAddHeaders()
    {
        return [
            'pageTitle' => 'Добавление Категории VegansFreedom',
            'url' => '/admin/shop/category/add',
            'title' => 'Создание Категории Товаров',
            'description' => 'Создание Новой Категории Товаров Vegans Freedom | Admin',
            'image' => '/img/vegans.jpg',
        ];
    }

    private function categoryEditHeaders($cat)
    {
        return [
            'pageTitle' => 'Редактирование Категории Товаров | VegansFreedom',
            'url' => '/admin/shop/category/edit/' . $cat->id,
            'title' => 'Измененние Рубрики',
            'description' => 'Измененние Категории Товаров | Admin',
            'image' => '/img/vegans.jpg',
        ];
    }

    /*

     public function rubrics() {
        $categories = Category::getCategories();
        $adminCategories = Category::getAdminCategories();
        $category_id = 0;

        return view('admin.rubric.rubrics', [
            'headers' => $this->rubricsHeaders(),
            'currentCategory' => $category_id,
            'categories' => $categories,
            'adminCategories' => $adminCategories,
        ]);
    }

    private function rubricsHeaders()
    {
        return [
            'pageTitle' => 'Список Рубрик VegansFreedom',
            'url' => '/admin/posts',
            'title' => 'Список Рубрик',
            'description' => 'Рубрики Vegans Freedom | Admin',
            'image' => '/img/vegans.jpg',
        ];
    }

     */

}


