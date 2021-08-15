<?php

use Carbon\CarbonImmutable;
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
    // $rooms = DB::table('rooms')
    //         ->where('price', '<', 400)
    //         ->orWhere(function($query) {
    //             $query->where([
    //                 ['room_size', '>', '1'],
    //                 ['room_size', '<', 4]
    //             ]);
    //         })
    //         ->get();
    // $rooms = \App\Models\Room::where([
    //     ['room_size', 2],
    //     ['price', '<', 400]
    // ])
    // ->get();
    $result = DB::table('users')
            ->whereExists(function($query) {
                $query->select('id')
                    ->from('resevations')
                    ->whereRow('resevations.user_id = users.id')
                    ->where('check_in', '2020-05-30')
                    ->limit(1);
            })
            ->get();
    dump($user, $result);

    return view('welcome');
});
