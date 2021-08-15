<?php

use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {

    // $users = DB::table('users')->select()->get();
    // $comments = DB::table('comments')->get();

    $user = DB::table('users')
            ->select(['name', 'email'])
            ->where('id', 1)
            ->get();
    dump($user);

    return view('welcome');
});
