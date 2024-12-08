<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicRoomController;
use App\Http\Controllers\PrivateRoomController;
use App\Http\Controllers\UsernameController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PrivateMessageController;

Route::get('/', function () {
    return view('index'); // 'public_rooms/index' corresponds to 'resources/views/public_rooms/index.blade.php'
})->name('index');


Route::resource('/public_rooms',PublicRoomController::class);

Route::resource('/private_rooms',PrivateRoomController::class);

Route::resource('/usernames',UsernameController::class);

Route::get('/set-join-session', [PublicRoomController::class, 'setJoinSession'])->name('setJoinSession');

Route::get('/private_rooms/{id}/join', [PrivateRoomController::class, 'join'])->name('private_rooms.join');

Route::post('/private-rooms/verify', [PrivateRoomController::class, 'verify'])->name('private_rooms.verify');

Route::resource('public_rooms.messages', MessageController::class)
    ->scoped(['message' => 'publicRoom']);

    Route::resource('private_rooms.privateMessages', PrivateMessageController::class)
    ->scoped(['privateMessage' => 'privateRoom']);
