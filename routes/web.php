<?php

use Illuminate\Support\Facades\Route;

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

// use App\Weed;

Route::get('/', function () {
    // $weeds=Weed::all();
    // foreach($weeds as $weed ){
    //     echo $weed->breed."<br/>";
    //     echo $weed->description."<br/>";
    //     echo "<hr/>";

    //     echo "<strong>Comentarios</strong><br/>";
    //     foreach($weed->comments as $comments){
    //         echo $comments->comments."<br/>";
    //     }
    // }
        
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/confiweedation', 'UserController@config')->name('config');

Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/user/profile/{id}', 'UserController@profile')->name('user.profile');
Route::get('/user/index/{user?}', 'UserController@users')->name('user.index');

Route::get('/upload-weed', 'WeedController@create')->name('weed.create');
Route::post('/weed/save', 'WeedController@save')->name('weed.save');
Route::get('/weed/image/{weedName}', 'WeedController@getWeed')->name('weed.image');
Route::get('/weed/{id}', 'WeedController@detail')->name('weed.detail');
Route::get('/weed/delete/{id}', 'WeedController@delete')->name('weed.delete');
Route::get('/edit-weed/{id}', 'WeedController@edit')->name('weed.edit');
Route::post('/update-weed', 'WeedController@update')->name('weed.update');

Route::post('/comment/save', 'CommentsController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentsController@delete')->name('comment.delete');

Route::get('/like/like', 'LikeController@like')->name('like.like');
Route::get('/likes', 'LikeController@likes')->name('like.likes');




