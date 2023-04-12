<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Junges\Kafka\Facades\Kafka;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/publish', function(){

    /** @var \Junges\Kafka\Producers\ProducerBuilder $producer */
    $producer = Kafka::publishOn('payment')
        ->withBodyKey('id', '99')
        ->withBodyKey('produk', 'Sandal');

    $producer->send();

    return "Topic published";
});

Route::get('/consume', function(){

    
    
    return "consummed";
});

