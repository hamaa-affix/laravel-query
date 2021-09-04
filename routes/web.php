<?php

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Room;
use App\Models\User;
use App\Models\Comment;

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
    $rooms = Room::where('id', 1)
        ->first();

    $users = User::select('name', 'id')
        ->addSelect(['worst_content' => Comment::select('content')
            ->whereColumn('user_id', 'users.id')
            ->orderBy('created_at', 'asc')
            ->limit(1)
        ])
        ->get()
        ->toArray();

    $comments = Comment::all();
    $results = $comments->map(function($comment) {
        return $comment->content;
    });

    // $data = [];
    // foreach($results as $result) {
    //     $data[] = [
    //         'word' => $result[0]
    //     ];
    // }
    ddd($results);
   //dump($rooms->price, $users);

    return view('welcome');
});
