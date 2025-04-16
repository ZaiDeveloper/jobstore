<?php

use App\Http\Controllers\{TodoController};
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index']);
Route::group([
    'prefix' => 'todos',
    'as' => 'todos.'
], function () {
    Route::post('/', [TodoController::class, 'store']);
    Route::put('/{id}', [TodoController::class, 'update']);
});
