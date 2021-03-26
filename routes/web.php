<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'IndexController@getHome')->name('home.index');

Route::get('/search', 'IndexController@getSearch')->name('home.search');

Route::get('/gioi-thieu', 'IndexController@getListAbout')->name('home.about');

Route::get('san-pham', 'IndexController@getProducts')->name('home.list.product');

Route::get('san-pham/{slug}', 'IndexController@getSingleProduct')->name('home.single.product');

Route::get('danh-muc-san-pham/{slug}', 'IndexController@categoryProducts')->name('home.archive.product');

Route::get('linh-kien', 'IndexController@getAccessories')->name('home.list.accessories');

Route::get('linh-kien/{slug}', 'IndexController@getSingleAccessories')->name('home.single.accessories');

Route::get('danh-muc-linh-kien/{slug}', 'IndexController@categoryAccessories')->name('home.archive.accessories');

Route::get('/dich-vu', 'IndexController@getServices')->name('home.services');

Route::get('/dich-vu/{slug}', 'IndexController@servicesDetail')->name('home.services-detail');

Route::get('/lien-he', 'IndexController@getContact')->name('home.contact');

Route::post('/lien-he/gui', 'IndexController@postContact')->name('home.post-contact');

Route::get('filter-products', 'IndexController@getFilterProductsAjax')->name('home.filterProducts');

Route::get('tin-tuc', 'IndexController@getListNews')->name('home.news');

Route::get('/tin-tuc/{slug}', 'IndexController@getSingleNews')->name('home.news-single');

Route::get('/chinh-sach/{slug}', 'IndexController@policy')->name('home.policy');



Route::group(['namespace' => 'Admin'], function () {

    Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function () {
       	Route::get('/home', 'HomeController@index')->name('backend.home');

        Route::resource('users', 'UserController', ['except' => [
            'show'
        ]]);

        /*  Sản phẩm  */
        Route::resource('category', 'CategoryController', ['except' => ['show']]);

        Route::resource('products', 'ProductsController', ['except' => [
            'show'
        ]]);
        Route::post('products/postMultiDel', ['as' => 'products.postMultiDel', 'uses' => 'ProductsController@deleteMuti']);

        Route::get('products/get-slug', 'ProductsController@getAjaxSlug')->name('products.get-slug');

        /*  Linh kiện  */
        Route::resource('category_accessories', 'CategoryAccessoriesController', ['except' => ['show']]);

        Route::resource('accessories', 'AccessoriesController', ['except' => [
            'show'
        ]]);
        Route::post('accessories/postMultiDel', ['as' => 'accessories.postMultiDel', 'uses' => 'AccessoriesController@deleteMuti']);

        Route::get('accessories/get-slug', 'AccessoriesController@getAjaxSlug')->name('accessories.get-slug');


        Route::resource('image', 'ImageController', ['except' => [
            'show'
        ]]);
        Route::post('image/postMultiDel', ['as' => 'image.postMultiDel', 'uses' => 'ImageController@deleteMuti']);
        // Bài viết
        Route::resource('category-post', 'CategoriesPostController', ['except' => ['show']]);

        Route::resource('posts', 'PostController', ['except' => ['show']]);

        Route::post('posts/postMultiDel', ['as' => 'posts.postMultiDel', 'uses' => 'PostController@deleteMuti']);
        Route::get('posts/get-slug', 'PostController@getAjaxSlug')->name('posts.get-slug');

        // Dịch vụ
        Route::resource('services', 'ServicesController', ['except' => ['show']]);
        Route::post('services/postMultiDel', ['as' => 'services.postMultiDel', 'uses' => 'ServicesController@deleteMuti']);
        Route::get('services/get-slug', 'ServicesController@getAjaxSlug')->name('services.get-slug');


        // Liên hệ
        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', ['as' => 'get.list.contact', 'uses' => 'ContactController@getListContact']);
            Route::post('/delete-muti', ['as' => 'contact.postMultiDel', 'uses' => 'ContactController@postDeleteMuti']);
            Route::get('{id}/edit', ['as' => 'contact.edit', 'uses' => 'ContactController@getEdit']);
            Route::post('{id}/edit', ['as' => 'contact.post', 'uses' => 'ContactController@postEdit']);
            Route::delete('{id}/delete', ['as' => 'contact.destroy', 'uses' => 'ContactController@getDelete']);
            Route::get('/danh-sach-dang-ky-nhan-tin-khuyen-mai', ['as' => 'get.list.mail-sale', 'uses' => 'ContactController@getListMailSale']);
            Route::get('/xoa-email/{id}', ['as' => 'get.list.delete-mail-sale', 'uses' => 'ContactController@deleteMailSale']);
        });

        Route::group(['prefix' => 'pages'], function() {
            Route::get('/', ['as' => 'pages.list', 'uses' => 'PagesController@getListPages']);
            Route::get('build', ['as' => 'pages.build', 'uses' => 'PagesController@getBuildPages']);
            Route::post('build', ['as' => 'pages.build.post', 'uses' => 'PagesController@postBuildPages']);
            Route::post('/create', ['as' => 'pages.create', 'uses' => 'PagesController@postCreatePages']);
        });

        Route::group(['prefix' => 'options'], function() {
            Route::get('/general', 'SettingController@getGeneralConfig')->name('backend.options.general');
            Route::post('/general', 'SettingController@postGeneralConfig')->name('backend.options.general.post');

            Route::get('/developer-config', 'SettingController@getDeveloperConfig')->name('backend.options.developer-config');
            Route::post('/developer-config', 'SettingController@postDeveloperConfig')->name('backend.options.developer-config.post');
        });

        Route::group(['prefix' => 'menu'], function () {
            Route::get('/', ['as' => 'setting.menu', 'uses' => 'MenuController@getListMenu']);
            Route::get('edit/{id}', ['as' => 'backend.config.menu.edit', 'uses' => 'MenuController@getEditMenu']);
            Route::post('add-item/{id}', ['as' => 'setting.menu.addItem', 'uses' => 'MenuController@postAddItem']);
            Route::post('update', ['as' => 'setting.menu.update', 'uses' => 'MenuController@postUpdateMenu']);
            Route::get('delete/{id}', ['as' => 'setting.menu.delete', 'uses' => 'MenuController@getDelete']);
            Route::get('edit-item/{id}', ['as' => 'setting.menu.geteditItem', 'uses' => 'MenuController@getEditItem']);
            Route::post('edit', ['as' => 'setting.menu.editItem', 'uses' => 'MenuController@postEditItem']);
        });

        //Chính sách
        Route::group(['prefix' => 'policy'], function () {
            Route::get('/', ['as' => 'policy.list', 'uses' => 'PolicyController@getListPolicy']);
            Route::get('/add-plicy', ['as' => 'policy.add', 'uses' => 'PolicyController@addPolicy']);
            Route::post('/post-add-plicy', ['as' => 'policy.post-add', 'uses' => 'PolicyController@postAddPolicy']);
            Route::get('/edit-policy/{id}', ['as' => 'policy.edit', 'uses' => 'PolicyController@editPolicy']);
            Route::post('/post-edit-policy/{id}', ['as' => 'policy.post-edit', 'uses' => 'PolicyController@postEditPolicy']);
            Route::get('/delete-policy/{id}', ['as' => 'policy.delete', 'uses' => 'PolicyController@deletePolicy']);

            //Liên hệ footer
            Route::get('/ft-ct', ['as' => 'policy.list-ftct', 'uses' => 'PolicyController@getListFooterContact']);
            Route::get('/add-ftct', ['as' => 'policy.add-ftct', 'uses' => 'PolicyController@addFooterContact']);
            Route::post('/post-add-ftct', ['as' => 'policy.post-add-ftct', 'uses' => 'PolicyController@postAddFooterContact']);
            Route::get('/edit-ftct/{id}', ['as' => 'policy.edit-ftct', 'uses' => 'PolicyController@editFooterContact']);
            Route::post('/post-edit-ftct/{id}', ['as' => 'policy.post-edit-ftct', 'uses' => 'PolicyController@postEditFooterContact']);
            Route::get('/delete-ftct/{id}', ['as' => 'policy.delete-ftct', 'uses' => 'PolicyController@deleteFooterContact']);

        });

       Route::get('/get-layout', 'HomeController@getLayOut')->name('get.layout');


    });
});

Auth::routes(
    [
        'register' => false,
        'verify' => false,
        'reset' => false,
    ]
);
