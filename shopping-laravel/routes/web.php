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

Route::get('/',"PostsController@index" );
Route::get('/basket',"PostsController@basket" );
Route::get('/admin',"PostsController@admin" );
Route::get('/orders',"OrdersController@index" );
Route::get('/login',"PostsController@login" );
Route::get('/reg',"PostsController@reg" );
Route::get('/prod', 'ProdController@index');
/*

Route::get('/tasks',"TasksController@index" );
Route::get('/tasks/{task}',"TasksController@show" );


Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('products',[
        'name'=>'ainur'
    ])->with('surename','sekerbekova');
});



Route::get('/tasks', function () {
    //$tasks = DB::table('tasks')->get();
    //$tasks = \App\Task::all();
    $tasks = \App\Task::incomplete();
    return view('tasks',compact('tasks'));
});

Route::get('/tasks/{task}', function ($id) {
    //$task = DB::table('tasks')->find($id);

    $task = \App\Task::find($id);
    return view('show',compact('task'));
});

*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
