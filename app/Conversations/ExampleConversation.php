<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class ExampleConversation extends Conversation
{
    /**
     * First question
     */
    public function askReason()
    {
        $question = Question::create("Huh - you woke me up. What do you need?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Tell a joke')->value('chiste'),
                Button::create('Give me a fancy quote')->value('quote'),
            ]);

            $this->ask($question, $this->commonQuestions());
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askReason();
    }

    private function commonQuestions()
    {
        return [
            [
                'pattern' => '/^chiste/|Chiste',
                'callback' => function(){ $this->tellAJoke(); }
            ]
        ];
    }

    public function tellAJoke()
    {
        $this->say("waaa");
    }
}