<?php

namespace App\Http\Controllers;

use App\Libraries\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



class Message
{
    public function message(Request $request)
    {
        $input = $request->input();
        $text = $input['message']['text'];

        $sendmessage = new SendMessage($text);
        $sendmessage->helloGoodAfternoon();
        $sendmessage->sendFoto();
        $sendmessage->weatherAction();
        $sendmessage->unclear();
    }

    public function webhook()
    {
        Http::get('https://api.telegram.org/bot6263769832:AAHstAwCtRfZJgnO545kJ-706y2Fw991ODM/setwebhook?url=https://telegram.loca.lt/api');
    }
}
