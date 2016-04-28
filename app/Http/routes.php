<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/members','MembersController@index');
Route::get('/members/{id}','MembersController@info');
Route::get('/members/{id}/edit','MembersFormController@edit');
Route::post('/members/{id}/submitedit','MembersFormController@applyEdit');
Route::get('/membersDel/{id}','MembersFormController@DeleteMember');

Route::get('/projects','ProjectsController@index');
Route::get('/projects/form','ProjectsFormController@form');
Route::post('/projects/newproject', 'ProjectsFormController@add');
Route::get('/projects/{id}','ProjectsController@info');
Route::get('/projects/{id}/edit','ProjectsFormController@editForm');
Route::post('/projects/{id}/submitedit','ProjectsFormController@edit');

Route::get('/projects/{id}/delete','ProjectsFormController@delete');
Route::get('/projects/{id}/join','ProjectsFormController@join');
Route::get('/projects/{id}/quit','ProjectsFormController@quit');

Route::get('/publications','PublicationsController@index');
Route::get('/publications/form','PublicationsFormController@form');
Route::post('/publications/newpublication','PublicationsFormController@add');
Route::get('/publications/{id}','PublicationsController@info');
Route::get('/publications/{id}/edit','PublicationsFormController@edit');
Route::get('/publications/{id}/submitedit','PublicationsFormController@edit');


Route::get('/old','oldController@index');