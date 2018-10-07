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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/settings', 'SettingsController@index')->name('settings.index');
Route::post('/settings', 'SettingsController@save')->name('settings.store');

Route::resource('emailaccounts', 'EmailAccountsController');

Route::get('emailaccounts/view/{id}', [
    'as' => 'emailaccounts.view',
    'uses' => 'EmailAccountsController@view'
]);

Route::get('emailaccounts/delete/{id}', [
    'as' => 'emailaccounts.delete',
    'uses' => 'EmailAccountsController@delete'
]);


Route::resource('feeds', 'FeedsController');

Route::get('feeds/delete/{id}', [
    'as' => 'feeds.delete',
    'uses' => 'FeedsController@delete'
]);

Route::get('feeds/refresh/{id}', [
    'as' => 'feeds.refresh',
    'uses' => 'FeedsController@refresh'
]);
