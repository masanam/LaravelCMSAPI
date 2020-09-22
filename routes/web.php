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

Route::get('admin/roles', ['as'=> 'admin.roles.index', 'uses' => 'Admin\RoleController@index']);
Route::post('admin/roles', ['as'=> 'admin.roles.store', 'uses' => 'Admin\RoleController@store']);
Route::get('admin/roles/create', ['as'=> 'admin.roles.create', 'uses' => 'Admin\RoleController@create']);
Route::put('admin/roles/{roles}', ['as'=> 'admin.roles.update', 'uses' => 'Admin\RoleController@update']);
Route::patch('admin/roles/{roles}', ['as'=> 'admin.roles.update', 'uses' => 'Admin\RoleController@update']);
Route::delete('admin/roles/{roles}', ['as'=> 'admin.roles.destroy', 'uses' => 'Admin\RoleController@destroy']);
Route::get('admin/roles/{roles}', ['as'=> 'admin.roles.show', 'uses' => 'Admin\RoleController@show']);
Route::get('admin/roles/{roles}/edit', ['as'=> 'admin.roles.edit', 'uses' => 'Admin\RoleController@edit']);
// Route::post('importRole', 'Admin\RoleController@import');

Route::get('admin/users', ['as'=> 'admin.users.index', 'uses' => 'Admin\UserController@index']);
Route::post('admin/users', ['as'=> 'admin.users.store', 'uses' => 'Admin\UserController@store']);
Route::get('admin/users/create', ['as'=> 'admin.users.create', 'uses' => 'Admin\UserController@create']);
Route::put('admin/users/{users}', ['as'=> 'admin.users.update', 'uses' => 'Admin\UserController@update']);
Route::patch('admin/users/{users}', ['as'=> 'admin.users.update', 'uses' => 'Admin\UserController@update']);
Route::delete('admin/users/{users}', ['as'=> 'admin.users.destroy', 'uses' => 'Admin\UserController@destroy']);
Route::get('admin/users/{users}', ['as'=> 'admin.users.show', 'uses' => 'Admin\UserController@show']);
Route::get('admin/users/{users}/edit', ['as'=> 'admin.users.edit', 'uses' => 'Admin\UserController@edit']);
// Route::post('importUser', 'Admin\UserController@import');

Route::get('admin/permissions', ['as'=> 'admin.permissions.index', 'uses' => 'Admin\PermissionController@index']);
Route::post('admin/permissions', ['as'=> 'admin.permissions.store', 'uses' => 'Admin\PermissionController@store']);
Route::get('admin/permissions/create', ['as'=> 'admin.permissions.create', 'uses' => 'Admin\PermissionController@create']);
Route::put('admin/permissions/{permissions}', ['as'=> 'admin.permissions.update', 'uses' => 'Admin\PermissionController@update']);
Route::patch('admin/permissions/{permissions}', ['as'=> 'admin.permissions.update', 'uses' => 'Admin\PermissionController@update']);
Route::delete('admin/permissions/{permissions}', ['as'=> 'admin.permissions.destroy', 'uses' => 'Admin\PermissionController@destroy']);
Route::get('admin/permissions/{permissions}', ['as'=> 'admin.permissions.show', 'uses' => 'Admin\PermissionController@show']);
Route::get('admin/permissions/{permissions}/edit', ['as'=> 'admin.permissions.edit', 'uses' => 'Admin\PermissionController@edit']);
// Route::post('importPermission', 'Admin\PermissionController@import');

Route::get('admin/headers', ['as'=> 'admin.headers.index', 'uses' => 'Admin\HeaderController@index']);
Route::post('admin/headers', ['as'=> 'admin.headers.store', 'uses' => 'Admin\HeaderController@store']);
Route::get('admin/headers/create', ['as'=> 'admin.headers.create', 'uses' => 'Admin\HeaderController@create']);
Route::put('admin/headers/{headers}', ['as'=> 'admin.headers.update', 'uses' => 'Admin\HeaderController@update']);
Route::patch('admin/headers/{headers}', ['as'=> 'admin.headers.update', 'uses' => 'Admin\HeaderController@update']);
Route::delete('admin/headers/{headers}', ['as'=> 'admin.headers.destroy', 'uses' => 'Admin\HeaderController@destroy']);
Route::get('admin/headers/{headers}', ['as'=> 'admin.headers.show', 'uses' => 'Admin\HeaderController@show']);
Route::get('admin/headers/{headers}/edit', ['as'=> 'admin.headers.edit', 'uses' => 'Admin\HeaderController@edit']);
// Route::post('importHeader', 'Admin\HeaderController@import');

Route::get('admin/categories', ['as'=> 'admin.categories.index', 'uses' => 'Admin\CategoryController@index']);
Route::post('admin/categories', ['as'=> 'admin.categories.store', 'uses' => 'Admin\CategoryController@store']);
Route::get('admin/categories/create', ['as'=> 'admin.categories.create', 'uses' => 'Admin\CategoryController@create']);
Route::put('admin/categories/{categories}', ['as'=> 'admin.categories.update', 'uses' => 'Admin\CategoryController@update']);
Route::patch('admin/categories/{categories}', ['as'=> 'admin.categories.update', 'uses' => 'Admin\CategoryController@update']);
Route::delete('admin/categories/{categories}', ['as'=> 'admin.categories.destroy', 'uses' => 'Admin\CategoryController@destroy']);
Route::get('admin/categories/{categories}', ['as'=> 'admin.categories.show', 'uses' => 'Admin\CategoryController@show']);
Route::get('admin/categories/{categories}/edit', ['as'=> 'admin.categories.edit', 'uses' => 'Admin\CategoryController@edit']);
// Route::post('importCategory', 'Admin\CategoryController@import');

Route::get('admin/types', ['as'=> 'admin.types.index', 'uses' => 'Admin\TypeController@index']);
Route::post('admin/types', ['as'=> 'admin.types.store', 'uses' => 'Admin\TypeController@store']);
Route::get('admin/types/create', ['as'=> 'admin.types.create', 'uses' => 'Admin\TypeController@create']);
Route::put('admin/types/{types}', ['as'=> 'admin.types.update', 'uses' => 'Admin\TypeController@update']);
Route::patch('admin/types/{types}', ['as'=> 'admin.types.update', 'uses' => 'Admin\TypeController@update']);
Route::delete('admin/types/{types}', ['as'=> 'admin.types.destroy', 'uses' => 'Admin\TypeController@destroy']);
Route::get('admin/types/{types}', ['as'=> 'admin.types.show', 'uses' => 'Admin\TypeController@show']);
Route::get('admin/types/{types}/edit', ['as'=> 'admin.types.edit', 'uses' => 'Admin\TypeController@edit']);
// Route::post('importType', 'Admin\TypeController@import');

Route::get('admin/statuses', ['as'=> 'admin.statuses.index', 'uses' => 'Admin\StatusController@index']);
Route::post('admin/statuses', ['as'=> 'admin.statuses.store', 'uses' => 'Admin\StatusController@store']);
Route::get('admin/statuses/create', ['as'=> 'admin.statuses.create', 'uses' => 'Admin\StatusController@create']);
Route::put('admin/statuses/{statuses}', ['as'=> 'admin.statuses.update', 'uses' => 'Admin\StatusController@update']);
Route::patch('admin/statuses/{statuses}', ['as'=> 'admin.statuses.update', 'uses' => 'Admin\StatusController@update']);
Route::delete('admin/statuses/{statuses}', ['as'=> 'admin.statuses.destroy', 'uses' => 'Admin\StatusController@destroy']);
Route::get('admin/statuses/{statuses}', ['as'=> 'admin.statuses.show', 'uses' => 'Admin\StatusController@show']);
Route::get('admin/statuses/{statuses}/edit', ['as'=> 'admin.statuses.edit', 'uses' => 'Admin\StatusController@edit']);
// Route::post('importStatus', 'Admin\StatusController@import');

Route::get('admin/groups', ['as'=> 'admin.groups.index', 'uses' => 'Admin\GroupController@index']);
Route::post('admin/groups', ['as'=> 'admin.groups.store', 'uses' => 'Admin\GroupController@store']);
Route::get('admin/groups/create', ['as'=> 'admin.groups.create', 'uses' => 'Admin\GroupController@create']);
Route::put('admin/groups/{groups}', ['as'=> 'admin.groups.update', 'uses' => 'Admin\GroupController@update']);
Route::patch('admin/groups/{groups}', ['as'=> 'admin.groups.update', 'uses' => 'Admin\GroupController@update']);
Route::delete('admin/groups/{groups}', ['as'=> 'admin.groups.destroy', 'uses' => 'Admin\GroupController@destroy']);
Route::get('admin/groups/{groups}', ['as'=> 'admin.groups.show', 'uses' => 'Admin\GroupController@show']);
Route::get('admin/groups/{groups}/edit', ['as'=> 'admin.groups.edit', 'uses' => 'Admin\GroupController@edit']);
// Route::post('importGroup', 'Admin\GroupController@import');

Route::get('admin/managements', ['as'=> 'admin.managements.index', 'uses' => 'Admin\ManagementController@index']);
Route::post('admin/managements', ['as'=> 'admin.managements.store', 'uses' => 'Admin\ManagementController@store']);
Route::get('admin/managements/create', ['as'=> 'admin.managements.create', 'uses' => 'Admin\ManagementController@create']);
Route::put('admin/managements/{managements}', ['as'=> 'admin.managements.update', 'uses' => 'Admin\ManagementController@update']);
Route::patch('admin/managements/{managements}', ['as'=> 'admin.managements.update', 'uses' => 'Admin\ManagementController@update']);
Route::delete('admin/managements/{managements}', ['as'=> 'admin.managements.destroy', 'uses' => 'Admin\ManagementController@destroy']);
Route::get('admin/managements/{managements}', ['as'=> 'admin.managements.show', 'uses' => 'Admin\ManagementController@show']);
Route::get('admin/managements/{managements}/edit', ['as'=> 'admin.managements.edit', 'uses' => 'Admin\ManagementController@edit']);
// Route::post('importManagement', 'Admin\ManagementController@import');

Route::get('admin/contents', ['as'=> 'admin.contents.index', 'uses' => 'Admin\ContentController@index']);
Route::post('admin/contents', ['as'=> 'admin.contents.store', 'uses' => 'Admin\ContentController@store']);
Route::get('admin/contents/create', ['as'=> 'admin.contents.create', 'uses' => 'Admin\ContentController@create']);
Route::put('admin/contents/{contents}', ['as'=> 'admin.contents.update', 'uses' => 'Admin\ContentController@update']);
Route::patch('admin/contents/{contents}', ['as'=> 'admin.contents.update', 'uses' => 'Admin\ContentController@update']);
Route::delete('admin/contents/{contents}', ['as'=> 'admin.contents.destroy', 'uses' => 'Admin\ContentController@destroy']);
Route::get('admin/contents/{contents}', ['as'=> 'admin.contents.show', 'uses' => 'Admin\ContentController@show']);
Route::get('admin/contents/{contents}/edit', ['as'=> 'admin.contents.edit', 'uses' => 'Admin\ContentController@edit']);
// Route::post('importContent', 'Admin\ContentController@import');

Route::get('admin/documents', ['as'=> 'admin.documents.index', 'uses' => 'Admin\DocumentController@index']);
Route::post('admin/documents', ['as'=> 'admin.documents.store', 'uses' => 'Admin\DocumentController@store']);
Route::get('admin/documents/create', ['as'=> 'admin.documents.create', 'uses' => 'Admin\DocumentController@create']);
Route::put('admin/documents/{documents}', ['as'=> 'admin.documents.update', 'uses' => 'Admin\DocumentController@update']);
Route::patch('admin/documents/{documents}', ['as'=> 'admin.documents.update', 'uses' => 'Admin\DocumentController@update']);
Route::delete('admin/documents/{documents}', ['as'=> 'admin.documents.destroy', 'uses' => 'Admin\DocumentController@destroy']);
Route::get('admin/documents/{documents}', ['as'=> 'admin.documents.show', 'uses' => 'Admin\DocumentController@show']);
Route::get('admin/documents/{documents}/edit', ['as'=> 'admin.documents.edit', 'uses' => 'Admin\DocumentController@edit']);
// Route::post('importDocument', 'Admin\DocumentController@import');

Route::get('admin/brands', ['as'=> 'admin.brands.index', 'uses' => 'Admin\BrandController@index']);
Route::post('admin/brands', ['as'=> 'admin.brands.store', 'uses' => 'Admin\BrandController@store']);
Route::get('admin/brands/create', ['as'=> 'admin.brands.create', 'uses' => 'Admin\BrandController@create']);
Route::put('admin/brands/{brands}', ['as'=> 'admin.brands.update', 'uses' => 'Admin\BrandController@update']);
Route::patch('admin/brands/{brands}', ['as'=> 'admin.brands.update', 'uses' => 'Admin\BrandController@update']);
Route::delete('admin/brands/{brands}', ['as'=> 'admin.brands.destroy', 'uses' => 'Admin\BrandController@destroy']);
Route::get('admin/brands/{brands}', ['as'=> 'admin.brands.show', 'uses' => 'Admin\BrandController@show']);
Route::get('admin/brands/{brands}/edit', ['as'=> 'admin.brands.edit', 'uses' => 'Admin\BrandController@edit']);
// Route::post('importBrand', 'Admin\BrandController@import');

Route::get('admin/careers', ['as'=> 'admin.careers.index', 'uses' => 'Admin\CareerController@index']);
Route::post('admin/careers', ['as'=> 'admin.careers.store', 'uses' => 'Admin\CareerController@store']);
Route::get('admin/careers/create', ['as'=> 'admin.careers.create', 'uses' => 'Admin\CareerController@create']);
Route::put('admin/careers/{careers}', ['as'=> 'admin.careers.update', 'uses' => 'Admin\CareerController@update']);
Route::patch('admin/careers/{careers}', ['as'=> 'admin.careers.update', 'uses' => 'Admin\CareerController@update']);
Route::delete('admin/careers/{careers}', ['as'=> 'admin.careers.destroy', 'uses' => 'Admin\CareerController@destroy']);
Route::get('admin/careers/{careers}', ['as'=> 'admin.careers.show', 'uses' => 'Admin\CareerController@show']);
Route::get('admin/careers/{careers}/edit', ['as'=> 'admin.careers.edit', 'uses' => 'Admin\CareerController@edit']);
// Route::post('importCareer', 'Admin\CareerController@import');

Route::get('admin/achievements', ['as'=> 'admin.achievements.index', 'uses' => 'Admin\AchievementController@index']);
Route::post('admin/achievements', ['as'=> 'admin.achievements.store', 'uses' => 'Admin\AchievementController@store']);
Route::get('admin/achievements/create', ['as'=> 'admin.achievements.create', 'uses' => 'Admin\AchievementController@create']);
Route::put('admin/achievements/{achievements}', ['as'=> 'admin.achievements.update', 'uses' => 'Admin\AchievementController@update']);
Route::patch('admin/achievements/{achievements}', ['as'=> 'admin.achievements.update', 'uses' => 'Admin\AchievementController@update']);
Route::delete('admin/achievements/{achievements}', ['as'=> 'admin.achievements.destroy', 'uses' => 'Admin\AchievementController@destroy']);
Route::get('admin/achievements/{achievements}', ['as'=> 'admin.achievements.show', 'uses' => 'Admin\AchievementController@show']);
Route::get('admin/achievements/{achievements}/edit', ['as'=> 'admin.achievements.edit', 'uses' => 'Admin\AchievementController@edit']);
// Route::post('importAchievement', 'Admin\AchievementController@import');

Route::get('admin/certifications', ['as'=> 'admin.certifications.index', 'uses' => 'Admin\CertificationController@index']);
Route::post('admin/certifications', ['as'=> 'admin.certifications.store', 'uses' => 'Admin\CertificationController@store']);
Route::get('admin/certifications/create', ['as'=> 'admin.certifications.create', 'uses' => 'Admin\CertificationController@create']);
Route::put('admin/certifications/{certifications}', ['as'=> 'admin.certifications.update', 'uses' => 'Admin\CertificationController@update']);
Route::patch('admin/certifications/{certifications}', ['as'=> 'admin.certifications.update', 'uses' => 'Admin\CertificationController@update']);
Route::delete('admin/certifications/{certifications}', ['as'=> 'admin.certifications.destroy', 'uses' => 'Admin\CertificationController@destroy']);
Route::get('admin/certifications/{certifications}', ['as'=> 'admin.certifications.show', 'uses' => 'Admin\CertificationController@show']);
Route::get('admin/certifications/{certifications}/edit', ['as'=> 'admin.certifications.edit', 'uses' => 'Admin\CertificationController@edit']);
// Route::post('importCertification', 'Admin\CertificationController@import');

Route::get('admin/testimonies', ['as'=> 'admin.testimonies.index', 'uses' => 'Admin\TestimonyController@index']);
Route::post('admin/testimonies', ['as'=> 'admin.testimonies.store', 'uses' => 'Admin\TestimonyController@store']);
Route::get('admin/testimonies/create', ['as'=> 'admin.testimonies.create', 'uses' => 'Admin\TestimonyController@create']);
Route::put('admin/testimonies/{testimonies}', ['as'=> 'admin.testimonies.update', 'uses' => 'Admin\TestimonyController@update']);
Route::patch('admin/testimonies/{testimonies}', ['as'=> 'admin.testimonies.update', 'uses' => 'Admin\TestimonyController@update']);
Route::delete('admin/testimonies/{testimonies}', ['as'=> 'admin.testimonies.destroy', 'uses' => 'Admin\TestimonyController@destroy']);
Route::get('admin/testimonies/{testimonies}', ['as'=> 'admin.testimonies.show', 'uses' => 'Admin\TestimonyController@show']);
Route::get('admin/testimonies/{testimonies}/edit', ['as'=> 'admin.testimonies.edit', 'uses' => 'Admin\TestimonyController@edit']);
// Route::post('importTestimony', 'Admin\TestimonyController@import');

Route::get('admin/announcements', ['as'=> 'admin.announcements.index', 'uses' => 'Admin\AnnouncementController@index']);
Route::post('admin/announcements', ['as'=> 'admin.announcements.store', 'uses' => 'Admin\AnnouncementController@store']);
Route::get('admin/announcements/create', ['as'=> 'admin.announcements.create', 'uses' => 'Admin\AnnouncementController@create']);
Route::put('admin/announcements/{announcements}', ['as'=> 'admin.announcements.update', 'uses' => 'Admin\AnnouncementController@update']);
Route::patch('admin/announcements/{announcements}', ['as'=> 'admin.announcements.update', 'uses' => 'Admin\AnnouncementController@update']);
Route::delete('admin/announcements/{announcements}', ['as'=> 'admin.announcements.destroy', 'uses' => 'Admin\AnnouncementController@destroy']);
Route::get('admin/announcements/{announcements}', ['as'=> 'admin.announcements.show', 'uses' => 'Admin\AnnouncementController@show']);
Route::get('admin/announcements/{announcements}/edit', ['as'=> 'admin.announcements.edit', 'uses' => 'Admin\AnnouncementController@edit']);
// Route::post('importAnnouncement', 'Admin\AnnouncementController@import');

Route::get('admin/releases', ['as'=> 'admin.releases.index', 'uses' => 'Admin\ReleaseController@index']);
Route::post('admin/releases', ['as'=> 'admin.releases.store', 'uses' => 'Admin\ReleaseController@store']);
Route::get('admin/releases/create', ['as'=> 'admin.releases.create', 'uses' => 'Admin\ReleaseController@create']);
Route::put('admin/releases/{releases}', ['as'=> 'admin.releases.update', 'uses' => 'Admin\ReleaseController@update']);
Route::patch('admin/releases/{releases}', ['as'=> 'admin.releases.update', 'uses' => 'Admin\ReleaseController@update']);
Route::delete('admin/releases/{releases}', ['as'=> 'admin.releases.destroy', 'uses' => 'Admin\ReleaseController@destroy']);
Route::get('admin/releases/{releases}', ['as'=> 'admin.releases.show', 'uses' => 'Admin\ReleaseController@show']);
Route::get('admin/releases/{releases}/edit', ['as'=> 'admin.releases.edit', 'uses' => 'Admin\ReleaseController@edit']);
// Route::post('importRelease', 'Admin\ReleaseController@import');

Route::get('admin/menus', ['as'=> 'admin.menus.index', 'uses' => 'Admin\MenuController@index']);
Route::post('admin/menus', ['as'=> 'admin.menus.store', 'uses' => 'Admin\MenuController@store']);
Route::get('admin/menus/create', ['as'=> 'admin.menus.create', 'uses' => 'Admin\MenuController@create']);
Route::put('admin/menus/{menus}', ['as'=> 'admin.menus.update', 'uses' => 'Admin\MenuController@update']);
Route::patch('admin/menus/{menus}', ['as'=> 'admin.menus.update', 'uses' => 'Admin\MenuController@update']);
Route::delete('admin/menus/{menus}', ['as'=> 'admin.menus.destroy', 'uses' => 'Admin\MenuController@destroy']);
Route::get('admin/menus/{menus}', ['as'=> 'admin.menus.show', 'uses' => 'Admin\MenuController@show']);
Route::get('admin/menus/{menus}/edit', ['as'=> 'admin.menus.edit', 'uses' => 'Admin\MenuController@edit']);
// Route::post('importMenu', 'Admin\MenuController@import');

Route::get('admin/jenis', ['as'=> 'admin.jenis.index', 'uses' => 'Admin\JenisController@index']);
Route::post('admin/jenis', ['as'=> 'admin.jenis.store', 'uses' => 'Admin\JenisController@store']);
Route::get('admin/jenis/create', ['as'=> 'admin.jenis.create', 'uses' => 'Admin\JenisController@create']);
Route::put('admin/jenis/{jenis}', ['as'=> 'admin.jenis.update', 'uses' => 'Admin\JenisController@update']);
Route::patch('admin/jenis/{jenis}', ['as'=> 'admin.jenis.update', 'uses' => 'Admin\JenisController@update']);
Route::delete('admin/jenis/{jenis}', ['as'=> 'admin.jenis.destroy', 'uses' => 'Admin\JenisController@destroy']);
Route::get('admin/jenis/{jenis}', ['as'=> 'admin.jenis.show', 'uses' => 'Admin\JenisController@show']);
Route::get('admin/jenis/{jenis}/edit', ['as'=> 'admin.jenis.edit', 'uses' => 'Admin\JenisController@edit']);
// Route::post('importJenis', 'Admin\JenisController@import');

Route::get('admin/dividens', ['as'=> 'admin.dividens.index', 'uses' => 'Admin\DividenController@index']);
Route::post('admin/dividens', ['as'=> 'admin.dividens.store', 'uses' => 'Admin\DividenController@store']);
Route::get('admin/dividens/create', ['as'=> 'admin.dividens.create', 'uses' => 'Admin\DividenController@create']);
Route::put('admin/dividens/{dividens}', ['as'=> 'admin.dividens.update', 'uses' => 'Admin\DividenController@update']);
Route::patch('admin/dividens/{dividens}', ['as'=> 'admin.dividens.update', 'uses' => 'Admin\DividenController@update']);
Route::delete('admin/dividens/{dividens}', ['as'=> 'admin.dividens.destroy', 'uses' => 'Admin\DividenController@destroy']);
Route::get('admin/dividens/{dividens}', ['as'=> 'admin.dividens.show', 'uses' => 'Admin\DividenController@show']);
Route::get('admin/dividens/{dividens}/edit', ['as'=> 'admin.dividens.edit', 'uses' => 'Admin\DividenController@edit']);
// Route::post('importDividen', 'Admin\DividenController@import');

Route::get('admin/dividens', ['as'=> 'admin.dividens.index', 'uses' => 'Admin\DividenController@index']);
Route::post('admin/dividens', ['as'=> 'admin.dividens.store', 'uses' => 'Admin\DividenController@store']);
Route::get('admin/dividens/create', ['as'=> 'admin.dividens.create', 'uses' => 'Admin\DividenController@create']);
Route::put('admin/dividens/{dividens}', ['as'=> 'admin.dividens.update', 'uses' => 'Admin\DividenController@update']);
Route::patch('admin/dividens/{dividens}', ['as'=> 'admin.dividens.update', 'uses' => 'Admin\DividenController@update']);
Route::delete('admin/dividens/{dividens}', ['as'=> 'admin.dividens.destroy', 'uses' => 'Admin\DividenController@destroy']);
Route::get('admin/dividens/{dividens}', ['as'=> 'admin.dividens.show', 'uses' => 'Admin\DividenController@show']);
Route::get('admin/dividens/{dividens}/edit', ['as'=> 'admin.dividens.edit', 'uses' => 'Admin\DividenController@edit']);
// Route::post('importDividen', 'Admin\DividenController@import');

Route::get('admin/contacts', ['as'=> 'admin.contacts.index', 'uses' => 'Admin\ContactController@index']);
Route::post('admin/contacts', ['as'=> 'admin.contacts.store', 'uses' => 'Admin\ContactController@store']);
Route::get('admin/contacts/create', ['as'=> 'admin.contacts.create', 'uses' => 'Admin\ContactController@create']);
Route::put('admin/contacts/{contacts}', ['as'=> 'admin.contacts.update', 'uses' => 'Admin\ContactController@update']);
Route::patch('admin/contacts/{contacts}', ['as'=> 'admin.contacts.update', 'uses' => 'Admin\ContactController@update']);
Route::delete('admin/contacts/{contacts}', ['as'=> 'admin.contacts.destroy', 'uses' => 'Admin\ContactController@destroy']);
Route::get('admin/contacts/{contacts}', ['as'=> 'admin.contacts.show', 'uses' => 'Admin\ContactController@show']);
Route::get('admin/contacts/{contacts}/edit', ['as'=> 'admin.contacts.edit', 'uses' => 'Admin\ContactController@edit']);
// Route::post('importContact', 'Admin\ContactController@import');

Route::get('admin/products', ['as'=> 'admin.products.index', 'uses' => 'Admin\ProductController@index']);
Route::post('admin/products', ['as'=> 'admin.products.store', 'uses' => 'Admin\ProductController@store']);
Route::get('admin/products/create', ['as'=> 'admin.products.create', 'uses' => 'Admin\ProductController@create']);
Route::put('admin/products/{products}', ['as'=> 'admin.products.update', 'uses' => 'Admin\ProductController@update']);
Route::patch('admin/products/{products}', ['as'=> 'admin.products.update', 'uses' => 'Admin\ProductController@update']);
Route::delete('admin/products/{products}', ['as'=> 'admin.products.destroy', 'uses' => 'Admin\ProductController@destroy']);
Route::get('admin/products/{products}', ['as'=> 'admin.products.show', 'uses' => 'Admin\ProductController@show']);
Route::get('admin/products/{products}/edit', ['as'=> 'admin.products.edit', 'uses' => 'Admin\ProductController@edit']);
// Route::post('importProduct', 'Admin\ProductController@import');

Route::get('admin/registrants', ['as'=> 'admin.registrants.index', 'uses' => 'Admin\RegistrantController@index']);
Route::post('admin/registrants', ['as'=> 'admin.registrants.store', 'uses' => 'Admin\RegistrantController@store']);
Route::get('admin/registrants/create', ['as'=> 'admin.registrants.create', 'uses' => 'Admin\RegistrantController@create']);
Route::put('admin/registrants/{registrants}', ['as'=> 'admin.registrants.update', 'uses' => 'Admin\RegistrantController@update']);
Route::patch('admin/registrants/{registrants}', ['as'=> 'admin.registrants.update', 'uses' => 'Admin\RegistrantController@update']);
Route::delete('admin/registrants/{registrants}', ['as'=> 'admin.registrants.destroy', 'uses' => 'Admin\RegistrantController@destroy']);
Route::get('admin/registrants/{registrants}', ['as'=> 'admin.registrants.show', 'uses' => 'Admin\RegistrantController@show']);
Route::get('admin/registrants/{registrants}/edit', ['as'=> 'admin.registrants.edit', 'uses' => 'Admin\RegistrantController@edit']);
// Route::post('importRegistrant', 'Admin\RegistrantController@import');

Route::get('admin/sliders', ['as'=> 'admin.sliders.index', 'uses' => 'Admin\SliderController@index']);
Route::post('admin/sliders', ['as'=> 'admin.sliders.store', 'uses' => 'Admin\SliderController@store']);
Route::get('admin/sliders/create', ['as'=> 'admin.sliders.create', 'uses' => 'Admin\SliderController@create']);
Route::put('admin/sliders/{sliders}', ['as'=> 'admin.sliders.update', 'uses' => 'Admin\SliderController@update']);
Route::patch('admin/sliders/{sliders}', ['as'=> 'admin.sliders.update', 'uses' => 'Admin\SliderController@update']);
Route::delete('admin/sliders/{sliders}', ['as'=> 'admin.sliders.destroy', 'uses' => 'Admin\SliderController@destroy']);
Route::get('admin/sliders/{sliders}', ['as'=> 'admin.sliders.show', 'uses' => 'Admin\SliderController@show']);
Route::get('admin/sliders/{sliders}/edit', ['as'=> 'admin.sliders.edit', 'uses' => 'Admin\SliderController@edit']);
// Route::post('importSlider', 'Admin\SliderController@import');



Route::get('admin/advisors', ['as'=> 'admin.advisors.index', 'uses' => 'Admin\AdvisorController@index']);
Route::post('admin/advisors', ['as'=> 'admin.advisors.store', 'uses' => 'Admin\AdvisorController@store']);
Route::get('admin/advisors/create', ['as'=> 'admin.advisors.create', 'uses' => 'Admin\AdvisorController@create']);
Route::put('admin/advisors/{advisors}', ['as'=> 'admin.advisors.update', 'uses' => 'Admin\AdvisorController@update']);
Route::patch('admin/advisors/{advisors}', ['as'=> 'admin.advisors.update', 'uses' => 'Admin\AdvisorController@update']);
Route::delete('admin/advisors/{advisors}', ['as'=> 'admin.advisors.destroy', 'uses' => 'Admin\AdvisorController@destroy']);
Route::get('admin/advisors/{advisors}', ['as'=> 'admin.advisors.show', 'uses' => 'Admin\AdvisorController@show']);
Route::get('admin/advisors/{advisors}/edit', ['as'=> 'admin.advisors.edit', 'uses' => 'Admin\AdvisorController@edit']);
// Route::post('importAdvisor', 'Admin\AdvisorController@import');

Route::get('admin/milestones', ['as'=> 'admin.milestones.index', 'uses' => 'Admin\MilestoneController@index']);
Route::post('admin/milestones', ['as'=> 'admin.milestones.store', 'uses' => 'Admin\MilestoneController@store']);
Route::get('admin/milestones/create', ['as'=> 'admin.milestones.create', 'uses' => 'Admin\MilestoneController@create']);
Route::put('admin/milestones/{milestones}', ['as'=> 'admin.milestones.update', 'uses' => 'Admin\MilestoneController@update']);
Route::patch('admin/milestones/{milestones}', ['as'=> 'admin.milestones.update', 'uses' => 'Admin\MilestoneController@update']);
Route::delete('admin/milestones/{milestones}', ['as'=> 'admin.milestones.destroy', 'uses' => 'Admin\MilestoneController@destroy']);
Route::get('admin/milestones/{milestones}', ['as'=> 'admin.milestones.show', 'uses' => 'Admin\MilestoneController@show']);
Route::get('admin/milestones/{milestones}/edit', ['as'=> 'admin.milestones.edit', 'uses' => 'Admin\MilestoneController@edit']);
// Route::post('importMilestone', 'Admin\MilestoneController@import');

Route::get('admin/directors', ['as'=> 'admin.directors.index', 'uses' => 'Admin\DirectorController@index']);
Route::post('admin/directors', ['as'=> 'admin.directors.store', 'uses' => 'Admin\DirectorController@store']);
Route::get('admin/directors/create', ['as'=> 'admin.directors.create', 'uses' => 'Admin\DirectorController@create']);
Route::put('admin/directors/{directors}', ['as'=> 'admin.directors.update', 'uses' => 'Admin\DirectorController@update']);
Route::patch('admin/directors/{directors}', ['as'=> 'admin.directors.update', 'uses' => 'Admin\DirectorController@update']);
Route::delete('admin/directors/{directors}', ['as'=> 'admin.directors.destroy', 'uses' => 'Admin\DirectorController@destroy']);
Route::get('admin/directors/{directors}', ['as'=> 'admin.directors.show', 'uses' => 'Admin\DirectorController@show']);
Route::get('admin/directors/{directors}/edit', ['as'=> 'admin.directors.edit', 'uses' => 'Admin\DirectorController@edit']);
// Route::post('importDirector', 'Admin\DirectorController@import');

Route::get('admin/sections', ['as'=> 'admin.sections.index', 'uses' => 'Admin\SectionController@index']);
Route::post('admin/sections', ['as'=> 'admin.sections.store', 'uses' => 'Admin\SectionController@store']);
Route::get('admin/sections/create', ['as'=> 'admin.sections.create', 'uses' => 'Admin\SectionController@create']);
Route::put('admin/sections/{sections}', ['as'=> 'admin.sections.update', 'uses' => 'Admin\SectionController@update']);
Route::patch('admin/sections/{sections}', ['as'=> 'admin.sections.update', 'uses' => 'Admin\SectionController@update']);
Route::delete('admin/sections/{sections}', ['as'=> 'admin.sections.destroy', 'uses' => 'Admin\SectionController@destroy']);
Route::get('admin/sections/{sections}', ['as'=> 'admin.sections.show', 'uses' => 'Admin\SectionController@show']);
Route::get('admin/sections/{sections}/edit', ['as'=> 'admin.sections.edit', 'uses' => 'Admin\SectionController@edit']);
// Route::post('importSection', 'Admin\SectionController@import');

Route::get('admin/varians', ['as'=> 'admin.varians.index', 'uses' => 'Admin\VarianController@index']);
Route::post('admin/varians', ['as'=> 'admin.varians.store', 'uses' => 'Admin\VarianController@store']);
Route::get('admin/varians/create', ['as'=> 'admin.varians.create', 'uses' => 'Admin\VarianController@create']);
Route::put('admin/varians/{varians}', ['as'=> 'admin.varians.update', 'uses' => 'Admin\VarianController@update']);
Route::patch('admin/varians/{varians}', ['as'=> 'admin.varians.update', 'uses' => 'Admin\VarianController@update']);
Route::delete('admin/varians/{varians}', ['as'=> 'admin.varians.destroy', 'uses' => 'Admin\VarianController@destroy']);
Route::get('admin/varians/{varians}', ['as'=> 'admin.varians.show', 'uses' => 'Admin\VarianController@show']);
Route::get('admin/varians/{varians}/edit', ['as'=> 'admin.varians.edit', 'uses' => 'Admin\VarianController@edit']);
// Route::post('importVarian', 'Admin\VarianController@import');

Route::get('admin/investors', ['as'=> 'admin.investors.index', 'uses' => 'Admin\InvestorController@index']);
Route::post('admin/investors', ['as'=> 'admin.investors.store', 'uses' => 'Admin\InvestorController@store']);
Route::get('admin/investors/create', ['as'=> 'admin.investors.create', 'uses' => 'Admin\InvestorController@create']);
Route::put('admin/investors/{investors}', ['as'=> 'admin.investors.update', 'uses' => 'Admin\InvestorController@update']);
Route::patch('admin/investors/{investors}', ['as'=> 'admin.investors.update', 'uses' => 'Admin\InvestorController@update']);
Route::delete('admin/investors/{investors}', ['as'=> 'admin.investors.destroy', 'uses' => 'Admin\InvestorController@destroy']);
Route::get('admin/investors/{investors}', ['as'=> 'admin.investors.show', 'uses' => 'Admin\InvestorController@show']);
Route::get('admin/investors/{investors}/edit', ['as'=> 'admin.investors.edit', 'uses' => 'Admin\InvestorController@edit']);
// Route::post('importInvestor', 'Admin\InvestorController@import');

Route::get('admin/shares', ['as'=> 'admin.shares.index', 'uses' => 'Admin\ShareController@index']);
Route::post('admin/shares', ['as'=> 'admin.shares.store', 'uses' => 'Admin\ShareController@store']);
Route::get('admin/shares/create', ['as'=> 'admin.shares.create', 'uses' => 'Admin\ShareController@create']);
Route::put('admin/shares/{shares}', ['as'=> 'admin.shares.update', 'uses' => 'Admin\ShareController@update']);
Route::patch('admin/shares/{shares}', ['as'=> 'admin.shares.update', 'uses' => 'Admin\ShareController@update']);
Route::delete('admin/shares/{shares}', ['as'=> 'admin.shares.destroy', 'uses' => 'Admin\ShareController@destroy']);
Route::get('admin/shares/{shares}', ['as'=> 'admin.shares.show', 'uses' => 'Admin\ShareController@show']);
Route::get('admin/shares/{shares}/edit', ['as'=> 'admin.shares.edit', 'uses' => 'Admin\ShareController@edit']);
// Route::post('importShare', 'Admin\ShareController@import');

Route::get('admin/parts', ['as'=> 'admin.parts.index', 'uses' => 'Admin\PartController@index']);
Route::post('admin/parts', ['as'=> 'admin.parts.store', 'uses' => 'Admin\PartController@store']);
Route::get('admin/parts/create', ['as'=> 'admin.parts.create', 'uses' => 'Admin\PartController@create']);
Route::put('admin/parts/{parts}', ['as'=> 'admin.parts.update', 'uses' => 'Admin\PartController@update']);
Route::patch('admin/parts/{parts}', ['as'=> 'admin.parts.update', 'uses' => 'Admin\PartController@update']);
Route::delete('admin/parts/{parts}', ['as'=> 'admin.parts.destroy', 'uses' => 'Admin\PartController@destroy']);
Route::get('admin/parts/{parts}', ['as'=> 'admin.parts.show', 'uses' => 'Admin\PartController@show']);
Route::get('admin/parts/{parts}/edit', ['as'=> 'admin.parts.edit', 'uses' => 'Admin\PartController@edit']);
// Route::post('importPart', 'Admin\PartController@import');

Route::get('admin/ownerships', ['as'=> 'admin.ownerships.index', 'uses' => 'Admin\OwnershipController@index']);
Route::post('admin/ownerships', ['as'=> 'admin.ownerships.store', 'uses' => 'Admin\OwnershipController@store']);
Route::get('admin/ownerships/create', ['as'=> 'admin.ownerships.create', 'uses' => 'Admin\OwnershipController@create']);
Route::put('admin/ownerships/{ownerships}', ['as'=> 'admin.ownerships.update', 'uses' => 'Admin\OwnershipController@update']);
Route::patch('admin/ownerships/{ownerships}', ['as'=> 'admin.ownerships.update', 'uses' => 'Admin\OwnershipController@update']);
Route::delete('admin/ownerships/{ownerships}', ['as'=> 'admin.ownerships.destroy', 'uses' => 'Admin\OwnershipController@destroy']);
Route::get('admin/ownerships/{ownerships}', ['as'=> 'admin.ownerships.show', 'uses' => 'Admin\OwnershipController@show']);
Route::get('admin/ownerships/{ownerships}/edit', ['as'=> 'admin.ownerships.edit', 'uses' => 'Admin\OwnershipController@edit']);
// Route::post('importOwnership', 'Admin\OwnershipController@import');

Route::get('admin/positions', ['as'=> 'admin.positions.index', 'uses' => 'Admin\PositionController@index']);
Route::post('admin/positions', ['as'=> 'admin.positions.store', 'uses' => 'Admin\PositionController@store']);
Route::get('admin/positions/create', ['as'=> 'admin.positions.create', 'uses' => 'Admin\PositionController@create']);
Route::put('admin/positions/{positions}', ['as'=> 'admin.positions.update', 'uses' => 'Admin\PositionController@update']);
Route::patch('admin/positions/{positions}', ['as'=> 'admin.positions.update', 'uses' => 'Admin\PositionController@update']);
Route::delete('admin/positions/{positions}', ['as'=> 'admin.positions.destroy', 'uses' => 'Admin\PositionController@destroy']);
Route::get('admin/positions/{positions}', ['as'=> 'admin.positions.show', 'uses' => 'Admin\PositionController@show']);
Route::get('admin/positions/{positions}/edit', ['as'=> 'admin.positions.edit', 'uses' => 'Admin\PositionController@edit']);
// Route::post('importPosition', 'Admin\PositionController@import');

Route::get('admin/compositions', ['as'=> 'admin.compositions.index', 'uses' => 'Admin\CompositionController@index']);
Route::post('admin/compositions', ['as'=> 'admin.compositions.store', 'uses' => 'Admin\CompositionController@store']);
Route::get('admin/compositions/create', ['as'=> 'admin.compositions.create', 'uses' => 'Admin\CompositionController@create']);
Route::put('admin/compositions/{compositions}', ['as'=> 'admin.compositions.update', 'uses' => 'Admin\CompositionController@update']);
Route::patch('admin/compositions/{compositions}', ['as'=> 'admin.compositions.update', 'uses' => 'Admin\CompositionController@update']);
Route::delete('admin/compositions/{compositions}', ['as'=> 'admin.compositions.destroy', 'uses' => 'Admin\CompositionController@destroy']);
Route::get('admin/compositions/{compositions}', ['as'=> 'admin.compositions.show', 'uses' => 'Admin\CompositionController@show']);
Route::get('admin/compositions/{compositions}/edit', ['as'=> 'admin.compositions.edit', 'uses' => 'Admin\CompositionController@edit']);
// Route::post('importComposition', 'Admin\CompositionController@import');

Route::get('admin/distributions', ['as'=> 'admin.distributions.index', 'uses' => 'Admin\DistributionController@index']);
Route::post('admin/distributions', ['as'=> 'admin.distributions.store', 'uses' => 'Admin\DistributionController@store']);
Route::get('admin/distributions/create', ['as'=> 'admin.distributions.create', 'uses' => 'Admin\DistributionController@create']);
Route::put('admin/distributions/{distributions}', ['as'=> 'admin.distributions.update', 'uses' => 'Admin\DistributionController@update']);
Route::patch('admin/distributions/{distributions}', ['as'=> 'admin.distributions.update', 'uses' => 'Admin\DistributionController@update']);
Route::delete('admin/distributions/{distributions}', ['as'=> 'admin.distributions.destroy', 'uses' => 'Admin\DistributionController@destroy']);
Route::get('admin/distributions/{distributions}', ['as'=> 'admin.distributions.show', 'uses' => 'Admin\DistributionController@show']);
Route::get('admin/distributions/{distributions}/edit', ['as'=> 'admin.distributions.edit', 'uses' => 'Admin\DistributionController@edit']);
// Route::post('importDistribution', 'Admin\DistributionController@import');