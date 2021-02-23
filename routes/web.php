<?php

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;

use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;

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

// Route::get('/', function () {
//     // if(Auth::check()) {
//     //     return redirect(route('home'));
//     // }
//     return view('welcome');
// });

Route::redirect('/', '/login');

// Route::get('/', function () {
//     View::addExtension('html','php');
//     return View::make('index');
// });

Route::get('sendemail', function () {

    $data = array(
        'name' => "Learning Laravel",
    );

    Mail::send('emails.welcome', $data, function ($message) {

        $message->from('masanam@yahoo.com', 'Learning Laravel');

        $message->to('masanam@gmail.com')->subject('Learning Laravel test email');

    });

    return "Your email has been sent successfully";

});


Route::fallback(function () {
    return view('index');
});

Route::get('/img/{path}', function(Filesystem $filesystem, $path) {
    $server = ServerFactory::create([
        'response' => new LaravelResponseFactory(app('request')),
        // 'source' => $filesystem->getDriver(),
        // 'cache' => $filesystem->getDriver(),
        'source' => Storage::disk("public")->getDriver(),
        'cache' => Storage::disk("public")->getDriver(),
        'cache_path_prefix' => '.cache',
        'base_url' => 'img',
    ]);

    return $server->getImageResponse($path, request()->all());
})->where('path', '.*');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('admin/users', ['as'=> 'admin.users.index', 'uses' => 'Admin\UsersController@index']);
Route::post('admin/users', ['as'=> 'admin.users.store', 'uses' => 'Admin\UsersController@store']);
Route::get('admin/users/create', ['as'=> 'admin.users.create', 'uses' => 'Admin\UsersController@create']);
Route::put('admin/users/{users}', ['as'=> 'admin.users.update', 'uses' => 'Admin\UsersController@update']);
Route::patch('admin/users/{users}', ['as'=> 'admin.users.update', 'uses' => 'Admin\UsersController@update']);
Route::delete('admin/users/{users}', ['as'=> 'admin.users.destroy', 'uses' => 'Admin\UsersController@destroy']);
Route::get('admin/users/{users}', ['as'=> 'admin.users.show', 'uses' => 'Admin\UsersController@show']);
Route::get('admin/users/{users}/edit', ['as'=> 'admin.users.edit', 'uses' => 'Admin\UsersController@edit']);
// Route::post('importUsers', 'Admin\UsersController@import');