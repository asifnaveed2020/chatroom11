<?php

use App\Events\sendMessage;
use App\Models\Item;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/', function () {
    
    return view('welcome')->with('item',Item::find(1));
});
Route::get('/do/bc', function () {
    event(new sendMessage('I am herer'));
});

Route::get('/images', [ImageController::class, 'index']);
Route::post('/images/save', [ImageController::class, 'save'])->name('images.save');
Route::post('/images/delete/{index}', [ImageController::class, 'delete'])->name('images.delete');
