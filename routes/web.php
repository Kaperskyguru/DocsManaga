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

Route::get('/', function () {
    return view('index');
});

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about', function () {
    return view('about');
})->name('about');

Auth::routes();

Route::post('/login', [
    'uses' => 'Auth\LoginController@login',
    'middleware' => 'status',
]);

Route::get('/home', 'HomeController@index')->middleware('admin')->name('home');
Route::get('/users', 'HomeController@users')->middleware('admin')->name('users');
Route::get('/logs', 'HomeController@logs')->middleware('admin')->name('logs');
Route::get('/documents', 'HomeController@documents')->middleware('admin')->name('documents');

Route::post('/documents', 'HomeController@addDocuments')->name('documents');
Route::post('/users', 'HomeController@addUser')->name('users');
Route::patch('/approveUser', 'HomeController@approveUser')->name('approveUser');
Route::delete('/deleteUser/{id}', 'HomeController@deleteUser')->name('deleteUser');
Route::get('/clear', 'HomeController@clearLogs')->name('clear');
Route::delete('/trash/{id}', 'HomeController@trashDocument')->name('trash');
Route::get('/restore/{id}', 'HomeController@restoreTrashDocument')->name('restore');
Route::delete('/remove/{id}', 'HomeController@deleteDocument')->name('remove');
Route::get('/linkBox', 'HomeController@displayLinkBox')->name('showBox');
Route::get('/editBox/{id}', 'HomeController@displayUpdateBox')->name('showEditBox');
Route::get('/download/{name}', 'HomeController@download')->name('download');
Route::patch('/edit/{id}', 'HomeController@updateDocument')->name('updateDocument');

Route::get('/user', 'UsersController@index')->middleware('user')->name('user');
Route::get('/user/document', 'UsersController@documents')->middleware('user')->name('document');

Route::get('/share/{file}', function ($file) {
    // Get the document from link
    $link = \App\Link::where('link', $file)->first();
    $document = \App\Document::find($link->document_id);
    return view('share')->with('document', $document);
})->name('share');

Route::post('backup', 'SystemController@postDbBackUp')->name('backup');
