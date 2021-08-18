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
    //paginationはreturnaが自動的にたjsonに変換される。
    //$result = DB::table('comments')->paginate(3);
    //$result = DB::table('comments')->simplePaginate(3);
    $sortBy = null;
    // $result = DB::table('rooms')
    //             ->when($sortBy, function($q, $sortBy) {
    //                 $q->orderBy($sortBy);
    //             }, function ($q) {
    //                 $q->orderBy('price');
    //             })
    //             ->get();
    $result = DB::table('comments')
            ->orderBy('id')
            ->chunk(2, function ($comments) {
                foreach($comments as $comment) {
                    if($comment->id === 5) return false;
                }
            });

    dump($user, $result);

    return view('welcome');
});
