<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;

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
//Route::get('/', function () {
//    return view('home.index', []);
//})->name('home.index');

Route::get('/', [HomeController::class, 'home'])
    ->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])
    ->name('home.contact');

Route::get('/single', AboutController::class);

//Route::get('/contact', function () {
//    return view('home.contact');
//})->name('home.contact');


$posts = [
    1 => [
        'title' => 'Intro to laravel',
        'content' => 'This is the short intro to laravel',
        'is_new' => true,
        'has_comments'=> true
    ],
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is the short intro to PHP',
        'is_new' => false
    ],
    3=> [
        'title' => 'Intro to Golang',
        'content' => 'This is the short intro to Golang',
        'is_new' => false
    ]
];

Route::resource('posts', PostsController::class);
//    ->only(['index','show', 'create', 'store', 'edit', 'update' ]);

//Route::get('/posts', function () use ($posts){
////    dd(request()->all());
//    dd((int)request()->query('page',1));
//    //compact($posts) === ['posts'=> $posts]
//    return view('posts.index', ['posts'=> $posts]);
//});
//
//Route::get('/posts/{id}', function($id) use($posts){
//        abort_if(!isset($posts[$id]), 404);
//
//    return  view('posts.show', ['post' => $posts[$id]]);
// })->name('posts.show');
// ->where([
// //     'id' => '[0-9]+'
// // ])


Route::get('/recent-posts/{days_ago?}',function($days_ago=20){
    return 'Posts from ' .$days_ago .  ' days ago';
})->name('posts.recent.index');

Route::prefix('/fun')->name('fun.')->group(function() use($posts){
    Route::get('responses', function () use($posts){
        return response($posts, 201)->header('Content-Type', 'application/json')->cookie('My_Cookie', 'Laurent', 3600);
    })->name('responses');


    Route::get('/named-routes', function (){
        return redirect()->route('posts.show', ['id' => 1]);
    })->name('named-routes');

    Route::get('/away', function (){
        return redirect()->away('https://google.com');
    })->name('away');

    Route::get('/json', function () use ($posts){
        return response()->json($posts);
    })->name('json');
    Route::get('/download', function () use ($posts){
        return response()->download(public_path('/dragon.jpg'), 'Dragon Ball');
    })->name('download');
});


