<?php

namespace App\Http\Controllers;

use App\Conversations\MainConversation;
use App\Http\Controllers\Bot\BotController;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;

class GlobalBotController extends BotController
{
    public function __invoke()
    {
        // You can access the botman object with this line
        $botman = $this->botman;

   
        $botman->hears('{message}', function($botman, $message) {
   
            if ($message == 'hola') {
                $botman->startConversation(new MainConversation());

            }
            
            else {
                $botman->reply("Di 'hola' para comenzar");
            }
        });
   
        $botman->listen();
    }
}
