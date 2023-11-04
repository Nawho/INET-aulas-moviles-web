<?php

namespace App\Conversations;

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
                    $this->aulasMovilesCerca();
                }
            ],
            [
                'pattern' => '/Sitio Web/|sitio web',
                'callback' => function () {
                    $this->sitioWebInet();
                }
            ],
            [
                'pattern' => 'sin_informacion',
                'callback' => function () {
                    $this->sinInformacion();
                }
            ],
        ];
    }

    public function aulasMovilesCerca()
    {
        //En este lugar se podría integrar con la base de datos
        $this->say(($this->generarLink("/map", "Hacé click acá para ir al Mapa Interactivo", "target='_PARENT'")) . ' <br> <br>' . ($this->generarLink("/list", "Hacé click acá para ver el Listado", "target='_PARENT'")));
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

        $this->say(($this->generarLink("https://www.inet.edu.ar", "Haciendo click accedé al Sitio Web de Inet", "target='_blank'")));
        $this->askAnotherReason();
    }

    private function generarLink($href, $text = 'Link', $options)
    {

        return "<a href='{$href}' {$options} >{$text}</a>";
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