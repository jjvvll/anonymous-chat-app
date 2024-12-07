<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicRoomController;
use App\Http\Controllers\UsernameController;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('index'); // 'public_rooms/index' corresponds to 'resources/views/public_rooms/index.blade.php'
})->name('index');


Route::resource('/public_rooms',PublicRoomController::class);

Route::resource('/usernames',UsernameController::class);

Route::get('/set-join-session', [PublicRoomController::class, 'setJoinSession'])->name('setJoinSession');

Route::resource('public_rooms.messages', MessageController::class)
    ->scoped(['message' => 'publicRoom']);
