<?php

namespace App\Http\Controllers\Bot;

use App\Conversations\MainConversation;
use App\Http\Controllers\Bot\BotController;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;

class GlobalBotController extends BotController
{
    public function __invoke()
    {
        $botman = $this->botman;

        $botman->hears('{message}', function ($botman, $message) {

            if (strtolower($message) == 'hola') {
                $botman->startConversation(new MainConversation());
            } else {
                $botman->reply("Di 'hola' para comenzar");
            }
        });

        $botman->listen();
    }
}
