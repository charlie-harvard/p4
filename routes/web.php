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

// Browse and Search
Route::get('/', 'PostController@browser');
Route::post('/', 'PostController@search');
Route::get('/posts/', 'PostController@browser');
Route::post('/posts/', 'PostController@search');

// Create New Post
Route::get('/posts/create/', 'PostController@create');
Route::post('/posts/create/', 'PostController@store');

// Show Post Detail
Route::get('/posts/{id}', 'PostController@show');

// Edit Post
Route::put('/posts/{id}/edit/', 'PostController@update');
Route::get('/posts/{id}/edit/', 'PostController@edit');

Route::get('/debug-db', function () {
    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});

