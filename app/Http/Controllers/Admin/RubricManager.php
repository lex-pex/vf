<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class RubricManager extends Controller
{
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

    public function rubricEdit(Category $category) {
        $categories = Category::getCategories();
        $category_id = 0;
        return view('admin.rubric.edit', [
            'headers' => $this->rubricEditHeaders($category),
            'currentCategory' => $category_id,
            'categories' => $categories,
            'category' => $category,
        ]);
    }

    public function rubricAdd() {
        $categories = Category::getCategories();
        $category_id = 0;
        return view('admin.rubric.add', [
            'headers' => $this->rubricAddHeaders(),
            'currentCategory' => $category_id,
            'categories' => $categories,
        ]);
    }

    public function rubricStore(Request $request) {
        $this->validate($request, [
            'name' => 'unique:categories|required|max:100',
            'alias' => 'unique:categories|required|max:100'
        ]);
        if($request->post()) {
            Category::categoryCreate($request);
        }
        return redirect(route('rubrics'));
    }

    public function rubricUpdate(Request $request, Category $category) {
        $this->validate($request, [
            'name' => 'required|max:100',
            'alias' => 'required|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'descr' => 'required|min:5|max:255'
        ]);
        if($request->post()) {
            Category::categoryUpdate($category, $request);
        }
        return redirect(route('rubrics'));
    }

    public function rubricDelete(Category $category) {
        Category::categoryDelete($category);
        return redirect(route('rubrics'));
    }

    /* Pages Headers */

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

    private function rubricAddHeaders()
    {
        return [
            'pageTitle' => 'Добавление Рубрики VegansFreedom',
            'url' => '/admin/rubric/add',
            'title' => 'Создание Рубрики',
            'description' => 'Создание Новой Рубрики Vegans Freedom | Admin',
            'image' => '/img/vegans.jpg',
        ];
    }

    private function rubricEditHeaders($cat)
    {
        return [
            'pageTitle' => 'Редактирование Рубрики | VegansFreedom',
            'url' => '/admin/rubric/edit/' . $cat->id,
            'title' => 'Измененние Рубрики',
            'description' => 'Измененние Рубрики Vegans Freedom | Admin',
            'image' => '/img/vegans.jpg',
        ];
    }

}
