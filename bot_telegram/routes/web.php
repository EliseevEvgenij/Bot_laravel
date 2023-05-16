<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $response = Http::get('https://api.telegram.org/bot6263769832:AAHstAwCtRfZJgnO545kJ-706y2Fw991ODM/sendMessage', [
        'chat_id' => 5162972303 ,
        'text' => 'Привет !'  
    ]); 
});