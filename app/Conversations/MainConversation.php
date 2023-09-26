<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class MainConversation extends Conversation
{

    public function __invoke() {
        return $this->initialOptions();
    }
    public function initialOptions()
    {
        $question = Question::create("¿Qué necesitas? Puedes seleccoinar una opción a continuación o escribirlo tú mismo.")
            ->fallback('Unable to ask question')
            ->callbackId('intial_options')
            ->addButtons([
                Button::create('Aulas móviles cerca mío')->value('cerca'),
                Button::create('Aulas móviles en el país')->value('aulas'),
                Button::create('Fechas')->value('fechas'),
            ]);

        $this->ask($question, $this->commonQuestions());
    }

    public function againOptions() {
        $question = Question::create("¿Algo más? Puedes seleccoinar una opción a continuación o escribirlo tú mismo.")
        ->fallback('Unable to ask question')
        ->callbackId('intial_options')
        ->addButtons([
            Button::create('Aulas móviles cerca mío')->value('cerca'),
            Button::create('Aulas móviles en el país')->value('aulas'),
            Button::create('Fechas')->value('fechas'),
        ]);

    $this->ask($question, $this->commonQuestions());
    }



    private function commonQuestions()
    {
        return [
            [
                'pattern' => '/^cerca/|Cerca',
                'callback' => function(){ $this->aulasMovilesCerca(); }
            ],
            [
                'pattern' => '/^aulas/|Aulas',
                'callback' => function(){ $this->aulasMovilesPais(); }
            ],
        ];
    }

    private function provinciaPatterns() {
        return [
            [
                'pattern' => '/caba/|CABA',
                'callback' => function(){ $this->aulasMovilesPorProvincia("CABA"); }
            ],
            [
                'pattern' => '/Buenos Aires/|Aulas',
                'callback' => function(){ $this->aulasMovilesPais(); }
            ],
        ];
    }

    public function aulasMovilesPorProvincia($provincia) {
        //dbb request
        $this->say("Las aulas móviles disponibles para $provincia son la 13, 14 y 15!");
        
        $this->againOptions();
    }

    public function aulasMovilesCerca()
    {
        $this->say("En la localidad de CABA, tienes cerca el Aula Móvil N°15, para aprender Mecatrónica avanzada con Arduino!");
    }

    public function aulasMovilesPais() {
        $this->ask("¿En qué provincia?", $this->provinciaPatterns());
    }

    public function run()
    {
        $this->initialOptions();
    }
}