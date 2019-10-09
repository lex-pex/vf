<?php

Auth::routes();

Route::group(['prefix' => 'cabinet', 'middleware' => ['counter', 'auth']], function () {
    Route::get('/', 'UserController@cabinet')->name('cabinet');
    Route::get('edit/{user_id?}', 'UserController@userEdit')->name('profileEdit');
    Route::post('update/{user?}', 'UserController@update')->name('profileUpdate');
    Route::delete('delete/{user}', 'UserController@profileDelete')->name('profileDelete');
    Route::get('pass/reset', 'UserController@passwordReset')->name('passwordReset');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'auth'], function () {
    Route::get('/', 'Admin\AdminController@panel')->name('admin');
    Route::get('posts', 'Admin\AdminController@posts')->name('posts');
    // Rubric
    Route::get('rubrics', 'Admin\RubricManager@rubrics')->name('rubrics');
    Route::get('rubric/edit/{category}', 'Admin\RubricManager@rubricEdit')->name('rubricEdit');
    Route::post('rubric/update/{category}', 'Admin\RubricManager@rubricUpdate')->name('rubricUpdate');
    Route::get('rubric/add/', 'Admin\RubricManager@rubricAdd')->name('rubricAdd');
    Route::post('rubric/store', 'Admin\RubricManager@rubricStore')->name('rubricStore');
    Route::delete('rubric/delete/{category}', 'Admin\RubricManager@rubricDelete')->name('rubricDelete');
    // Ad
    Route::get('ads', 'Admin\AdController@ads')->name('ads');
    Route::get('ad/add', 'Admin\AdController@adAdd')->name('adAdd');
    Route::post('ad/store', 'Admin\AdController@adStore')->name('adStore');
    Route::get('ad/edit/{ad}', 'Admin\AdController@adEdit')->name('adEdit');
    Route::post('ad/update/{ad}', 'Admin\AdController@adUpdate')->name('adUpdate');
    Route::delete('ad/delete/{ad}', 'Admin\AdController@adDel')->name('adDel');
    // Shop Products
    Route::get('shop', 'Shop\ShopController@products');
    // Orders
    Route::get('shop/orders', 'Shop\ShopController@orders')->name('orders');
    Route::get('shop/order/{order}', 'Shop\OrderController@order')->name('order');
    Route::get('shop/order/edit/{order}', 'Shop\OrderController@orderEdit')->name('orderEdit');
    Route::post('shop/order/store/{order}', 'Shop\OrderController@orderStore')->name('orderStore');
    Route::post('shop/order/delete/{order}', 'Shop\OrderController@orderDelete')->name('orderDelete');
    // Category
    Route::get('shop/categories', 'Shop\ShopController@categories')->name('categories');
    Route::get('shop/category/edit/{category}', 'Shop\CategoryManager@categoryEdit')->name('categoryEdit');
    Route::post('shop/category/update/{category}', 'Shop\CategoryManager@categoryUpdate')->name('categoryUpdate');
    Route::get('shop/category/add/', 'Shop\CategoryManager@categoryAdd')->name('categoryAdd');
    Route::post('shop/category/store', 'Shop\CategoryManager@categoryStore')->name('categoryStore');
    Route::delete('shop/category/delete/{category}', 'Shop\CategoryManager@categoryDelete')->name('categoryDelete');
    // Comments
    Route::get('comments', 'CommentController@commentsAdmin')->name('comments');
    // Profile manage
    Route::get('users', 'Admin\AdminController@usersAdmin')->name('users');
    // Messages
    Route::get('/messages', 'Admin\MessageController@messages');
    Route::get('/feedback/read/{id}', 'Admin\MessageController@readFeedback');
    Route::post('/feedback/del/{item}', 'Admin\MessageController@messageDel')->name('messageDel');
});

Route::group(['prefix' => 'shop', 'middleware' => ['counter', 'web']], function () {
    Route::get('about', 'Shop\HomeController@about')->name('about_shop');
    Route::get('search', 'Shop\SearchController@search')->name('shopSearch');
    Route::get('search/page/0', 'SearchController@search0');
    Route::get('search/page/{page}', 'SearchController@search');

    Route::get('cart', 'Shop\CartController@cart');
    Route::post('cart/add/{id}', 'Shop\CartController@add');
    Route::post('/cart/del/{id}', 'Shop\CartController@del');
    Route::post('/cart/amount/{id}/{amount}', 'Shop\CartController@amount');
    Route::match(['get', 'post'],'/cart/order', 'Shop\CartController@order');

    Route::get('add', 'Shop\ProductManager@productAdd');
    Route::post('store', 'Shop\ProductManager@productStore')->name('productStore');
    Route::get('preview/{id}', 'Shop\ProductManager@preview')->name('productPreview');
    Route::get('edit/{id}', 'Shop\ProductManager@productEdit')->name('productEdit');
    Route::post('update/{product}', 'Shop\ProductManager@productUpdate')->name('productUpdate');
    Route::post('confirm/{product}', 'Shop\ProductManager@confirmDelete')->name('confirmProductDelete');
    Route::delete('prodDel/{product}', 'Shop\ProductManager@productDelete')->name('productDelete');

    Route::get('page/0', 'Shop\HomeController@page_0');
    Route::get('page/{page}', 'Shop\HomeController@main');
    Route::get('{rubric}/page/0', 'Shop\CategoryController@category_0');
    Route::get('{rubric}/page/{page}', 'Shop\CategoryController@category');

    Route::get('prod/{alias}', 'Shop\ProductController@product');
    Route::get('{cat}', 'Shop\CategoryController@category');
    Route::get('/', 'Shop\HomeController@main');
});

Route::group(['prefix' => '/', 'middleware' => ['counter', 'web']], function () {
    Route::get('about', 'MainController@about')->name('about');
    Route::get('contacts', 'MessageController@contacts')->name('contacts');
    // Board
    Route::get('board', 'Board\BoardController@board')->name('board');
    Route::get('board/page/{page}', 'Board\BoardController@board');
    Route::get('board/add', 'Board\BoardManager@add');

    Route::post('feedback', 'MessageController@feedback')->name('feedback');

    Route::get('search', 'SearchController@search')->name('search');
    Route::get('search/page/0', 'SearchController@search0');
    Route::get('search/page/{page}', 'SearchController@search');

    Route::get('add', 'PostManager@postAdd');
    Route::post('store', ['uses' => 'PostManager@postStore', 'middleware' => 'auth'])->name('store');
    Route::get('preview/{blogPost}', ['uses' => 'PostManager@preview', 'middleware' => ['edit']])->name('preview');
    Route::get('edit/{id}', ['uses' => 'PostManager@postEdit', 'middleware' => ['edit', 'auth']])->name('postEdit');
    Route::post('update/{blogPost}', ['uses' => 'PostManager@postUpdate', 'middleware' => ['edit', 'auth']])->name('update');
    Route::post('confirm/{blogPost}', ['uses' => 'PostManager@confirmDelete', 'middleware' => ['edit', 'auth']])->name('confirmDelete');
    Route::delete('postDel/{blogPost}', 'PostManager@postDelete')->name('postDelete');

    Route::post('commentAdd', 'CommentController@commentAdd')->name('commentAdd');
    Route::post('commentDelete/{id}', ['uses' => 'CommentController@commentDelete', 'middleware' => ['auth']])->name('commentDelete');
    Route::post('commentEdit', ['uses' => 'CommentController@commentEdit', 'middleware' => 'auth'])->name('commentEdit');
    Route::get('profile/{id}', 'ProfileController@profile')->name('profile');
    Route::get('profiles', 'ProfileController@profiles')->name('profiles');

    Route::get('page/0', 'MainController@page0');
    Route::get('page/{page}', 'MainController@main')->name('index');
    Route::get('{rubric}/page/0', 'RubricController@rubric0');
    Route::get('{rubric}/page/{page}', 'RubricController@rubric');

    Route::get('{rubric}/{post}', 'PostController@post');
    Route::get('{rubric}', 'RubricController@rubric');
    Route::get('/', 'MainController@main')->name('index');
});

