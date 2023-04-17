<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {     
        $input = $request->input();
        $text = $input['message']['text'];
        
        if($text == 'Привет') {
            $send_message = 'Добрый день';     
        } 
        else{
				$send_message = 'я вас не понимаю';
			}		

        if($text == 'Погода'){
            $api_key = '13bb54b06ab462c9156e592f2700a9cf';
            $res_cordinate = Http::get('http://api.openweathermap.org/geo/1.0/direct', [
                'q' => 'Новокузнецк',
                'appid' => $api_key 
            ]);
            
            $res_cordinate = json_decode($res_cordinate, true);
            $lat = $res_cordinate[0]['lat'];
            $lon = $res_cordinate[0]['lon'];

            $res_pogoda = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => $api_key
            ]);
            
            $res_pogoda = json_decode($res_pogoda, true);
            $temp = 273.15 - $res_pogoda['main']['temp'];
            $send_message = '🌡️ Погода в городе Новокузнецк '. round($temp) . ' °C';   
        }
        
        Http::get('https://api.telegram.org/bot6263769832:AAHstAwCtRfZJgnO545kJ-706y2Fw991ODM/sendMessage', [
            'chat_id' => 5162972303,
            'text' => $send_message  
        ]);  
    }
}
