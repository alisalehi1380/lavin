<?php

use Illuminate\Support\Facades\Route;


Route::get('/login', 'AuthController@loginPage')->name('loginPage');
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/logout','AuthController@logout')->name('logout');
Route::get('/forgotPass', 'AuthController@forgotPass')->name('forgotPass');
Route::post('/recoveyPass', 'AuthController@recoveyPass')->name('recoveyPass');
Route::get('/changePass/{token}', 'AuthController@changePass')->name('changePass');
Route::PATCH('/changePassword/{token}', 'AuthController@changePassword')->name('changePassword');
Route::get('/fetch_cities', 'HomeController@fetch_cities')->name('fetch_cities');
Route::get('/servicefetch', 'HomeController@servicefetch')->name('servicefetch');
Route::get('/doctorsfetch', 'HomeController@doctorsfetch')->name('doctorsfetch');
Route::get('/detailsfetch', 'HomeController@detailsfetch')->name('detailsfetch');



Route::group(['middleware' => 'auth.admin'], function () {

  Route::get('/', 'HomeController@dashboard')->name('dashboard');

  Route::prefix('admins')->name('admins')->group(function () {
    Route::get('/', 'AdminController@index')->name('.index');
    Route::get('/create', 'AdminController@create')->name('.create');
    Route::post('/sotre', 'AdminController@store')->name('.store');
    Route::get('{admin}/edit', 'AdminController@edit')->name('.edit');
    Route::patch('{admin}/update', 'AdminController@update')->name('.update');
    Route::delete('/destroy/{admin}', 'AdminController@destroy')->name('.destroy');
    Route::post('/recycle/{id}', 'AdminController@recycle')->name('.recycle');

    Route::prefix('{admin}/address')->name('.address')->group(function () {
      Route::get('/', 'AdminAddressAdminController@show')->name('.show');
      Route::patch('{address}/update', 'AdminAddressAdminController@update')->name('.update');
    });

    Route::prefix('{admin}/feilds')->name('.feilds')->group(function () {
      Route::get('/', 'AdminFeildController@index')->name('.index');
      Route::get('/create', 'AdminFeildController@create')->name('.create');
      Route::post('/sotre', 'AdminFeildController@store')->name('.store');
      Route::get('{feild}/edit', 'AdminFeildController@edit')->name('.edit');
      Route::patch('{feild}/update', 'AdminFeildController@update')->name('.update');
      Route::delete('/destroy/{feild}', 'AdminFeildController@destroy')->name('.destroy');
    });

    Route::prefix('{admin}/medias')->name('.medias')->group(function () {
      Route::get('/', 'AdminMediaController@index')->name('.index');
      Route::get('/create', 'AdminMediaController@create')->name('.create');
      Route::post('/sotre', 'AdminMediaController@store')->name('.store');
      Route::get('{media}/edit', 'AdminMediaController@edit')->name('.edit');
      Route::patch('{media}/update', 'AdminMediaController@update')->name('.update');
      Route::delete('/destroy/{media}', 'AdminMediaController@destroy')->name('.destroy');
    });

  });

  

  Route::prefix('users')->name('users.')->group(function () {

    Route::get('/', 'UserController@index')->name('index');
    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/store', 'UserController@store')->name('store');
    Route::get('{user}/edit', 'UserController@edit')->name('edit');
    Route::patch('{user}/update', 'UserController@update')->name('update');
    Route::delete('{user}/destroy', 'UserController@destroy')->name('destroy');
    Route::post('/recycle/{id}', 'UserController@recycle')->name('recycle');
    Route::get('/fetch', 'UserController@fetch')->name('fetch');
  });

  Route::prefix('numbers')->name('numbers.')->group(function () {

    Route::get('/', 'NumberController@index')->name('index');

  });

  Route::prefix('doctors')->name('doctors.')->group(function () {

    Route::get('/', 'DoctorController@index')->name('index');
    Route::get('{doctor}/info', 'DoctorController@info')->name('info');
    Route::patch('{doctor}/update', 'DoctorController@update')->name('update');
    Route::get('{doctor}/video', 'DoctorController@video')->name('video');
    Route::POST('/upload', 'DoctorController@videoupload')->name('upload');
    Route::patch('{doctor}/store_video', 'DoctorController@store_video')->name('video.store');
    Route::delete('delete/{video}', 'DoctorController@videodelete')->name('delete');
  });

  Route::prefix('roles')->name('roles')->group(function () {
    Route::get('/', 'RoleController@index')->name('.index');
    Route::get('/create', 'RoleController@create')->name('.create');
    Route::post('/sotre', 'RoleController@store')->name('.store');
    Route::get('{role}/edit', 'RoleController@edit')->name('.edit');
    Route::patch('{role}/update', 'RoleController@update')->name('.update');
    Route::delete('/destroy/{role}', 'RoleController@destroy')->name('.destroy');
  });

  Route::prefix('levels')->name('levels.')->group(function () {
    Route::get('/', 'LevelController@index')->name('index');
    Route::get('/create', 'LevelController@create')->name('create');
    Route::post('/sotre', 'LevelController@store')->name('store');
    Route::get('{level}/edit', 'LevelController@edit')->name('edit');
    Route::patch('{level}/update', 'LevelController@update')->name('update');
    Route::delete('/destroy/{level}', 'LevelController@destroy')->name('destroy');
    Route::patch('/recycle/{level}', 'LevelController@recycle')->name('recycle');
    Route::get('usersfetch', 'LevelController@usersfetch')->name('usersfetch');

  });


  Route::prefix('galleries')->name('gallery.')->group(function () {
    Route::get('/', 'GalleryController@index')->name('index');
    Route::post('/sotre', 'GalleryController@store')->name('store');
    Route::patch('{gallery}/update', 'GalleryController@update')->name('update');
    Route::delete('/destroy/{gallery}', 'GalleryController@destroy')->name('destroy');

    Route::prefix('{gallery}/images')->name('images.')->group(function () {
      Route::get('/', 'ImageGalleryController@index')->name('index');
      Route::post('/sotre', 'ImageGalleryController@store')->name('store');
      Route::patch('{image}/ImageGalleryController', 'GalleryController@update')->name('update');
      Route::delete('/destroy/{image}', 'ImageGalleryController@destroy')->name('destroy');
    });
  });

  Route::prefix('portfolios')->name('portfolios.')->group(function () {
    Route::get('/', 'PortfolioController@index')->name('index');
    Route::get('/create', 'PortfolioController@create')->name('create');
    Route::post('/sotre', 'PortfolioController@store')->name('store');
    Route::get('{portfolio}/edit', 'PortfolioController@edit')->name('edit');
    Route::patch('{portfolio}/update', 'PortfolioController@update')->name('update');
    Route::delete('/destroy/{portfolio}', 'PortfolioController@destroy')->name('delete');
    Route::patch('/recycle/{portfolio}', 'PortfolioController@recycle')->name('recycle');
    Route::POST('/upload', 'PortfolioController@videoupload')->name('upload');
    Route::delete('{image}/remove_image', 'PortfolioController@remove_image')->name('remove_image');
  });

  Route::prefix('article')->name('article')->group(function () {

    Route::get('/', 'ArticleController@index')->name('.index');
    Route::get('/create', 'ArticleController@create')->name('.create');
    Route::post('/sotre', 'ArticleController@store')->name('.store');
    Route::get('{article}/edit', 'ArticleController@edit')->name('.edit');
    Route::patch('{article}/update', 'ArticleController@update')->name('.update');
    Route::delete('/destroy/{article}', 'ArticleController@destroy')->name('.destroy');
    Route::post('/ckeditor', 'ArticleController@ckeditor')->name('.ckeditor');


      Route::prefix('categories')->name('.categorys.')->group(function () {

        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('/create', 'CategoryController@create')->name('create');
        Route::POST('/store', 'CategoryController@store')->name('store');
        Route::get('{category}/edit', 'CategoryController@edit')->name('edit');
        Route::patch('/update/{category}', 'CategoryController@update')->name('update');
        Route::delete('delete/{category}', 'CategoryController@destroy')->name('delete');
        Route::delete('recycle/{category}', 'CategoryController@recycle')->name('recycle');
        Route::delete('forceDelete/{category}', 'CategoryController@forceDelete')->name('forceDelete');

    });

  });


  Route::prefix('services')->name('services.')->group(function () {

      Route::get('/', 'ServiceController@index')->name('index');
      Route::get('/create', 'ServiceController@create')->name('create');
      Route::post('/sotre', 'ServiceController@store')->name('store');
      Route::get('{service}/edit', 'ServiceController@edit')->name('edit');
      Route::patch('{service}/update', 'ServiceController@update')->name('update');
      Route::delete('/destroy/{service}', 'ServiceController@destroy')->name('delete');
      Route::patch('/recycle/{id}', 'ServiceController@recycle')->name('recycle');
      Route::get('/fetch_details', 'ServiceController@fetch_details')->name('fetch_details');

      Route::prefix('categories')->name('categories.')->group(function () {

        Route::get('/', 'ServiceCategoryController@index')->name('index');
        Route::get('/create', 'ServiceCategoryController@create')->name('create');
        Route::POST('/store', 'ServiceCategoryController@store')->name('store');
        Route::get('{category}/edit', 'ServiceCategoryController@edit')->name('edit');
        Route::patch('/update/{category}', 'ServiceCategoryController@update')->name('update');
        Route::delete('delete/{category}', 'ServiceCategoryController@destroy')->name('delete');
        Route::get('/fetch_child', 'ServiceCategoryController@fetch_child')->name('fetch_child');

        Route::prefix('{parent}/sub')->name('sub.')->group(function () {

          Route::get('/', 'ServiceCategoryController@subindex')->name('index');
          Route::get('/create', 'ServiceCategoryController@subcreate')->name('create');
          Route::POST('/store', 'ServiceCategoryController@substore')->name('store');
          Route::get('{category}/edit', 'ServiceCategoryController@subedit')->name('edit');
          Route::patch('/update/{category}', 'ServiceCategoryController@subupdate')->name('update');
          Route::delete('delete/{category}', 'ServiceCategoryController@subdestroy')->name('delete');

      });

    });

  });

  Route::prefix('service_details')->name('details.')->group(function () {

    Route::get('/', 'ServiceDetailController@index')->name('index');
    Route::get('/create', 'ServiceDetailController@create')->name('create');
    Route::POST('/store', 'ServiceDetailController@store')->name('store');
    Route::get('{detail}/edit', 'ServiceDetailController@edit')->name('edit');
    Route::patch('{detail}/update', 'ServiceDetailController@update')->name('update');
    Route::delete('{detail}/delete', 'ServiceDetailController@destroy')->name('delete');
    Route::patch('/recycle/{id}', 'ServiceDetailController@recycle')->name('recycle');

    Route::prefix('{detail}/images')->name('images.')->group(function () {
      Route::get('/', 'ServiceDetailController@showimages')->name('show');
      Route::POST('/store', 'ServiceDetailController@imagestore')->name('store');
      Route::delete('delete/{image}', 'ServiceDetailController@imagedelete')->name('delete');
    });

    Route::prefix('{detail}/videos')->name('videos.')->group(function () {
      Route::get('/', 'ServiceDetailController@showvideos')->name('show');
      Route::get('/create', 'ServiceDetailController@imagecreate')->name('create');
      Route::POST('/store', 'ServiceDetailController@videostore')->name('store');
      Route::POST('/upload', 'ServiceDetailController@videoupload')->name('upload');
      Route::delete('delete/{video}', 'ServiceDetailController@videodelete')->name('delete');
    });

    Route::prefix('{detail}/luck')->name('luck.')->group(function () {
      Route::get('/', 'ServiceDetailController@luckcreate')->name('create');
      Route::POST('/store', 'ServiceDetailController@luckstore')->name('store');
    });

});

  Route::prefix('comments')->name('comments.')->group(function () {
      Route::get('/', 'CommentsController@index')->name('index');
      Route::PATCH('update/{comment}', 'CommentsController@update')->name('update');
      Route::delete('/destroy/{comment}', 'CommentsController@destroy')->name('destroy');
  });


  Route::prefix('reviews')->name('reviews')->group(function () {
    Route::get('/', 'ReviewController@index')->name('.index');
    Route::PATCH('update/{comment}', 'ReviewController@update')->name('.update');
    Route::delete('/destroy/{comment}', 'ReviewController@destroy')->name('.destroy');
 });

  Route::prefix('luck')->name('luck.')->group(function () {
      Route::get('/', 'LuckController@index')->name('index');
      Route::post('/sotre', 'LuckController@store')->name('store');
      Route::PATCH('/{luck}', 'LuckController@update')->name('update');
      Route::delete('{luck}/delete', 'LuckController@destroy')->name('destroy');
  });


  Route::prefix('discounts')->name('discounts')->group(function () {
    Route::get('/', 'DiscountController@index')->name('.index');
    Route::get('/create', 'DiscountController@create')->name('.create');
    Route::get('/code', 'DiscountController@code')->name('.code');
    Route::post('/sotre', 'DiscountController@store')->name('.store');
    Route::get('{discount}/edit', 'DiscountController@edit')->name('.edit');
    Route::patch('{discount}/update', 'DiscountController@update')->name('.update');
    Route::delete('/destroy/{discount}', 'DiscountController@destroy')->name('.destroy');
    Route::patch('/recycle/{discount}', 'DiscountController@recycle')->name('.recycle');

    Route::prefix('{discount}/users')->name('.users.')->group(function () {
      Route::get('/', 'DiscountController@users_show')->name('show');
      Route::patch('/update', 'DiscountController@users_update')->name('update');
      Route::get('/update', 'LevelController@users')->name('fetch');
    });

    Route::prefix('{discount}/services')->name('.services')->group(function () {
      Route::get('/', 'DiscountController@services_show')->name('.show');
      Route::patch('/update', 'DiscountController@services_update')->name('.update');
    });

  });


  Route::prefix('shop')->name('shop.')->group(function () {

    Route::prefix('/products')->name('products.')->group(function () {

      Route::get('/', 'ProductController@index')->name('index');
      Route::get('/create', 'ProductController@create')->name('create');
      Route::POST('/store', 'ProductController@store')->name('store');
      Route::get('{product}/edit', 'ProductController@edit')->name('edit');
      Route::patch('{product}/update', 'ProductController@update')->name('update');
      Route::delete('{product}/delete', 'ProductController@destroy')->name('delete');
      Route::patch('/recycle/{id}', 'ProductController@recycle')->name('recycle');

      Route::prefix('categories')->name('categories.')->group(function () {

        Route::get('/', 'ProductCategoryController@index')->name('index');
        Route::get('/create', 'ProductCategoryController@create')->name('create');
        Route::POST('/store', 'ProductCategoryController@store')->name('store');
        Route::get('{category}/edit', 'ProductCategoryController@edit')->name('edit');
        Route::patch('/update/{category}', 'ProductCategoryController@update')->name('update');
        Route::delete('delete/{category}', 'ProductCategoryController@destroy')->name('delete');
        Route::get('/fetch_child', 'ProductCategoryController@fetch_child')->name('fetch_child');

          Route::prefix('{parent}/sub')->name('sub.')->group(function () {

            Route::get('/', 'ProductCategoryController@subindex')->name('index');
            Route::get('/create', 'ProductCategoryController@subcreate')->name('create');
            Route::POST('/store', 'ProductCategoryController@substore')->name('store');
            Route::get('{category}/edit', 'ProductCategoryController@subedit')->name('edit');
            Route::patch('/update/{category}', 'ProductCategoryController@subupdate')->name('update');
            Route::delete('delete/{category}', 'ProductCategoryController@subdestroy')->name('delete');

        });


      });

      Route::prefix('{product}/images')->name('images.')->group(function () {

        Route::get('/', 'ProductController@show')->name('show');
        Route::POST('/store', 'ProductController@imagestore')->name('store');
        Route::delete('delete/{image}', 'ProductController@imagedelete')->name('delete');

      });

      Route::prefix('{product}/attributes')->name('attributes.')->group(function () {

        Route::get('/', 'ProductController@show_attributes')->name('show');
        Route::patch('/update', 'ProductController@update_attributes')->name('update');


      });

      Route::prefix('{product}/luck')->name('luck.')->group(function () {
        Route::get('/', 'ProductController@luckcreate')->name('create');
        Route::POST('/store', 'ProductController@luckstore')->name('store');
      });

    });

    Route::prefix('sells')->name('sells.')->group(function () {
      
      Route::get('/', 'SellController@index')->name('index');
      Route::patch('{order}/update', 'SellController@update')->name('update');
 
    });
  });

  Route::prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/', 'NotificationController@index')->name('index');
    Route::get('/create', 'NotificationController@create')->name('create');
    Route::post('/sotre', 'NotificationController@store')->name('store');
    Route::patch('{notification}/update', 'NotificationController@update')->name('update');
    Route::delete('/destroy/{notification}', 'NotificationController@destroy')->name('destroy');
    Route::post('/recycle/{id}', 'NotificationController@recycle')->name('recycle');
  });


  Route::prefix('rewiewGroups')->name('rewiewGroups.')->group(function () {

      Route::get('/', 'ReviewGroupController@index')->name('index');
      Route::get('/create', 'ReviewGroupController@create')->name('create');
      Route::POST('/store', 'ReviewGroupController@store')->name('store');
      Route::get('{group}/edit', 'ReviewGroupController@edit')->name('edit');
      Route::patch('/update/{group}', 'ReviewGroupController@update')->name('update');
      Route::delete('delete/{group}', 'ReviewGroupController@delete')->name('delete');

  });


  Route::prefix('reserves')->name('reserves.')->group(function () {
    Route::get('/', 'ReserveServiceController@index')->name('index');
    Route::get('/create', 'ReserveServiceController@create')->name('create');
    Route::post('/sotre', 'ReserveServiceController@store')->name('store');
    Route::get('{reserve}/edit', 'ReserveServiceController@edit')->name('edit');
    Route::patch('{reserve}/update', 'ReserveServiceController@update')->name('update');
    Route::delete('/destroy/{reserve}', 'ReserveServiceController@destroy')->name('destroy');
    Route::patch('{reserve}/secratry', 'ReserveServiceController@secratry')->name('secratry');
    Route::patch('{reserve}/done', 'ReserveServiceController@done')->name('done');
    Route::get('{reserve}/payment', 'ReserveServiceController@payment')->name('payment');
    Route::post('{payment}/pay', 'ReserveServiceController@pay')->name('pay');

    Route::prefix('{reserve}/upgrade')->name('upgrade.')->group(function () {
      Route::get('/', 'ReserveUpgradeController@index')->name('index');
      Route::get('/create', 'ReserveUpgradeController@create')->name('create');
      Route::post('/store', 'ReserveUpgradeController@store')->name('store');
      Route::get('{upgrade}/edit', 'ReserveUpgradeController@edit')->name('edit');
      Route::patch('{upgrade}/update', 'ReserveUpgradeController@update')->name('update');
      Route::patch('{upgrade}/confirm', 'ReserveUpgradeController@confirm')->name('confirm');
      Route::delete('{upgrade}/delete', 'ReserveUpgradeController@delete')->name('delete');

    });
  });


  Route::prefix('jobs')->name('jobs.')->group(function () {
    Route::get('/', 'JobController@index')->name('index');
    Route::get('/create', 'JobController@create')->name('create');
    Route::post('/sotre', 'JobController@store')->name('store');
    Route::get('{job}/edit', 'JobController@edit')->name('edit');
    Route::patch('{job}/update', 'JobController@update')->name('update');
    Route::delete('/destroy/{job}', 'JobController@destroy')->name('destroy');
    Route::patch('{job}/recycle', 'JobController@recycle')->name('recycle');
  });

  Route::prefix('departments')->name('departments.')->group(function () {

      Route::get('/', 'DepartmentController@index')->name('index');
      Route::get('/create', 'DepartmentController@create')->name('create');
      Route::POST('/store', 'DepartmentController@store')->name('store');
      Route::get('{department}/edit', 'DepartmentController@edit')->name('edit');
      Route::patch('/{department}', 'DepartmentController@update')->name('update');
      Route::delete('delete/{department}', 'DepartmentController@destroy')->name('delete');
  });

  Route::prefix('tickets')->name('tickets.')->group(function () {

    Route::get('/', 'TicketController@index')->name('index');
    Route::get('/create', 'TicketController@create')->name('create');
    Route::POST('/store', 'TicketController@store')->name('store');
    Route::POST('/ticketmessage/{ticket}', 'TicketController@ticketmessage')->name('ticketmessage');
    Route::patch('/{ticket}', 'TicketController@update')->name('update');
    Route::get('{ticket}/show', 'TicketController@show')->name('show');
    Route::delete('delete/{ticket}', 'TicketController@destroy')->name('delete');
    Route::get('/getaudience/{id}', 'TicketController@getaudience')->name('getaudience');
  });

  Route::prefix('provinces')->name('provinces.')->group(function () {
    Route::get('/', 'ProvanceController@index')->name('index');
    Route::get('{provance}/edit', 'ProvanceController@edit')->name('edit');
    Route::patch('{provance}/update', 'ProvanceController@update')->name('update');

    Route::prefix('{province}/cities')->name('cities.')->group(function () {
      Route::get('/', 'CityController@index')->name('index');
      Route::get('/create', 'CityController@create')->name('create');
      Route::post('/store', 'CityController@store')->name('store');
      Route::get('{city}/edit', 'CityController@edit')->name('edit');
      Route::patch('{city}/update', 'CityController@update')->name('update');
      // Route::delete('{city}/remove', 'CityController@remove')->name('remove');
      // Route::post('/destroy/{city}', 'CityController@destroy')->name('destroy');

      Route::prefix('{city}/parts')->name('parts.')->group(function () {
        Route::get('/', 'PartController@index')->name('index');
        Route::get('/create', 'PartController@create')->name('create');
        Route::post('/store', 'PartController@store')->name('store');
        Route::get('{part}/edit', 'PartController@edit')->name('edit');
        Route::patch('{part}/update', 'PartController@update')->name('update');

    });

  });
  });

  Route::prefix('socialmedia')->name('socialmedia.')->group(function () {
    Route::get('/', 'SocialmediaController@index')->name('index');
    Route::get('/create', 'SocialmediaController@create')->name('create');
    Route::POST('/store', 'SocialmediaController@store')->name('store');
    Route::get('{socialmedia}/edit', 'SocialmediaController@edit')->name('edit');
    Route::patch('/{socialmedia}', 'SocialmediaController@update')->name('update');
    Route::delete('delete/{socialmedia}', 'SocialmediaController@destroy')->name('delete');
    Route::post('{socialmedia}/recycle', 'SocialmediaController@recycle')->name('recycle');
  });

  Route::prefix('phones')->name('phones.')->group(function () {
    Route::get('/', 'PhoneController@index')->name('index');
    Route::get('/create', 'PhoneController@create')->name('create');
    Route::POST('/store', 'PhoneController@store')->name('store');
    Route::get('{phone}/edit', 'PhoneController@edit')->name('edit');
    Route::patch('{phone}/update', 'PhoneController@update')->name('update');
    Route::delete('{phone}/delete', 'PhoneController@destroy')->name('delete');
 
  });


  Route::prefix('messages')->name('messages.')->group(function () {
    Route::get('/', 'MessageController@index')->name('index');
    Route::get('{message}/show', 'MessageController@show')->name('show');
    Route::delete('{message}/delete', 'MessageController@destroy')->name('delete');
  });


  Route::prefix('faq')->name('faq.')->group(function () {

    Route::get('/', 'FaqController@index')->name('index');
    Route::get('/create', 'FaqController@create')->name('create');
    Route::post('/store', 'FaqController@store')->name('store');
    Route::get('{faq}/edit', 'FaqController@edit')->name('edit');
    Route::patch('{faq}/update', 'FaqController@update')->name('update');
    Route::delete('{faq}/destroy', 'FaqController@destroy')->name('destroy');
 
  });
  
});
