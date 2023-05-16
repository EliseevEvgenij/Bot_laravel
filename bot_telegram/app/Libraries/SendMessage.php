<?php

namespace App\Libraries;


use Illuminate\Support\Facades\Http;


class SendMessage
{
    private $unclearChec = true;

    public function __construct(public $text)
    {
    }

    public function unclear()
    {
        if ($this->unclearChec) {
            Http::get('https://api.telegram.org/bot6263769832:AAHstAwCtRfZJgnO545kJ-706y2Fw991ODM/sendMessage', [
                'chat_id' => 5162972303,
                'text' => 'Я вас не понимаю'
            ]);
        }
    }

    public function helloGoodAfternoon()
    {
        if ($this->text == 'Привет') {
            $send_message = 'Добрый день';
            Http::get('https://api.telegram.org/bot6263769832:AAHstAwCtRfZJgnO545kJ-706y2Fw991ODM/sendMessage', [
                'chat_id' => 5162972303,
                'text' => $send_message
            ]);
            $this->unclearChec = false;
        }
    }

    public function sendFoto()
    {
        if ($this->text == 'Фото') {
            Http::get('https://api.telegram.org/bot6263769832:AAHstAwCtRfZJgnO545kJ-706y2Fw991ODM/sendPhoto', [
                'chat_id' => 5162972303,
                'photo' => 'https://www.xaxis.com/wp-content/uploads/2021/06/10x10-logo@2x.png'
            ]);
            $this->unclearChec = false;
        }
    }

    public function weatherAction()
    {
        if ($this->text == 'Погода') {
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
            $send_message = '🌡️ Погода в городе Новокузнецк ' . round($temp) . ' °C';
            Http::get('https://api.telegram.org/bot6263769832:AAHstAwCtRfZJgnO545kJ-706y2Fw991ODM/sendMessage', [
                'chat_id' => 5162972303,
                'text' => $send_message
            ]);
            $this->unclearChec = false;
        }
    }
}
