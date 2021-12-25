<?php

use App\Http\Controllers\ChatController;
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
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'chat'], function() {
    Route::get('', [ChatController::class, 'index'])->name('chat');
    Route::get('user', [ChatController::class, 'getUsers']);
    Route::post('message/send', [ChatController::class, 'sendMessage']);
    Route::get('conversation', [ChatController::class, 'getConversations']);
    Route::post('conversation/create', [ChatController::class, 'createConversation']);
    Route::get('conversation/{conversation}', [ChatController::class, 'getConversationDetail']);
    Route::get('conversation/{conversation}/message', [ChatController::class, 'getMessages']);
});

