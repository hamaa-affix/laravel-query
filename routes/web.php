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
    // $result = DB::table('comments')
    //         ->orderBy('id')
    //         ->chunk(2, function ($comments) {
    //             foreach($comments as $comment) {
    //                 if($comment->id === 5) return false;
    //             }
    //         });

    // $result = DB::table('resevations')
    //         ->join('rooms', 'resevations.room_id', '=', 'rooms.id')
    //         ->join('users', 'resevations.user_id', '=', 'users.id')
    //         ->where('rooms.id', '>', 3)
    //         ->where('users.id', '>', 1)
    //         ->get();

    // $result = DB::table('resevations')
    //         ->leftJoin('rooms', 'rooms.id', '=', 'resevations.room_id')
    //         ->leftJoin('cities', 'cities.id', '=', 'resevations.city_id')
    //         ->selectRaw('room_size, count(resevations.id) as resevation_count')
    //         ->groupBy('room_size', 'cities.name')
    //         ->orderByRaw('count(resevations.id) DESC')
    //         ->get();

        // $result = DB::table('resevations')
        //         ->crossJoin('cities')
        //         ->where('resevations.city_id', 'cities.is')
        //         ->get();

        // $rooms = DB::table('rooms')
        //         ->where('id', '>', 3);

        // $users = DB::table('users')
        //         ->where('id', '>', 1);

        // $result = DB::table('resevations')
        //         ->joinSub($rooms, 'rooms', function($join) {
        //                 $join->on('resevations.room_id', 'rooms.id');
        //         })
        //         ->joinSub($users, 'users', function($join) {
        //                 $join->on('resevations.user_id', 'users.id');
        //         })
        //         ->toSql();

        $result = DB::table('rooms')
                ->selectRaw('room_size, price, count(resevations.id) as resevations_count')
                ->leftJoin('resevations', 'rooms.id', '=', 'resevations.room_id')
                ->orderByRaw('count(resevations.id) DESC')
                ->groupBy('room_size', 'price')
                ->get();


    dump($user, $result);

    return view('welcome');
});
