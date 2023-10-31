<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class MainConversation extends Conversation
{

    protected $firstname;

    public function greet()
    {
        $this->ask('¿Cuál es tu nombre?', function (Answer $answer) {
            $this->firstname = $answer->getText();

            $this->say('Hola ' . $this->firstname);

            $this->initialOptions();
        });
    }

    public function initialOptions()
    {
        $question = Question::create("¿En qué puedo ayudarte? Puedes seleccionar una opción a continuación o escribirlo tú mismo.")
            ->fallback('Unable to ask question')
            ->callbackId('intial_options')
            ->addButtons([
                Button::create('Aulas móviles cerca mío')->value('cerca'),
                Button::create('Aulas móviles en el país')->value('aulas'),
                Button::create('Catálogo de Instituciones y oferta formativa')->value('sin_informacion'),
                Button::create('Albergues y residencias estudiantiles')->value('sin_informacion'),
                Button::create('Vinculación laboral local para egresados')->value('sin_informacion'),
                Button::create('Centros de Estudiantes')->value('sin_informacion'),
                Button::create('Sitio Web INET')->value('sitio web'),
            ]);

        $this->ask($question, $this->commonQuestions());
    }

    public function askAnotherReason()
    {

        $question = Question::create($this->firstname . ', ¿puedo ayudarte con algo más?')
            ->fallback('Unable to ask question')
            ->callbackId('intial_options')
            ->addButtons([
                Button::create('si')->value('yes'),
                Button::create('no')->value('no')
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() == 'yes') {
                    $this->initialOptions();
                } else {
                    $this->showOk();
                }
            } else {
                $this->askAnotherReason();
            }
        });
    }

    private function commonQuestions()
    {
        return [
            [
                'pattern' => '/^cerca/|Cerca',
                'callback' => function () {
                    $this->aulasMovilesCerca(); }
            ],
            [
                'pattern' => '/^aulas/|Aulas',
                'callback' => function () {
                    $this->aulasMovilesPais(); }
            ],
            [
                'pattern' => '/Sitio Web/|sitio web',
                'callback' => function () {
                    $this->sitioWebInet(); }
            ],
            [
                'pattern' => 'sin_informacion',
                'callback' => function () {
                    $this->sinInformacion(); }
            ],
        ];

    }

    private function provinciaPatterns()
    {
        return [
            [
                'pattern' => '/caba/|CABA',
                'callback' => function () {
                    $this->aulasMovilesPorProvincia("CABA"); }
            ],
            [
                'pattern' => '/Buenos Aires/|Aulas',
                'callback' => function () {
                    $this->aulasMovilesPais(); }
            ]
        ];
    }

    public function aulasMovilesPorProvincia($provincia)
    {
        //En este lugar se podría integrar con la base de datos
        $this->say("Las aulas móviles disponibles para $provincia son la 13, 14 y 15!");

        $this->againOptions();
    }

    public function aulasMovilesCerca()
    {
        //En este lugar se podría integrar con la base de datos
        $this->say("En la localidad de CABA, tienes cerca el Aula Móvil N°15, para aprender Mecatrónica avanzada con Arduino!");
        $this->askAnotherReason();
    }

    public function aulasMovilesPais()
    {
        $this->ask("¿En qué provincia?", $this->provinciaPatterns());
        $this->askAnotherReason();
    }

    public function sinInformacion()
    {
        //Integrar el resto de los proyectos
        $this->say("Muy pronto tendré información de esta sección");
        $this->askAnotherReason();
    }

    public function sitioWebInet()
    {
        $this->say($this->generarLink("https://www.inet.edu.ar", "Haciendo click accedé al Sitio Web de Inet"));
        $this->askAnotherReason();
    }

    private function generarLink($href, $text = 'Link')
    {
        return "<a href='{$href}' target='_blank'>{$text}</a>";
    }

    public function showOk()
    {
        $this->say($this->firstname . " muchas Gracias por conversar conmigo. ¡Te espero la próxima!");
    }

    public function run()
    {
        return $this->greet();
    }
}