<?php

namespace AppBundle\EventListener;

use AppBundle\Event\EmailEvent;
use Symfony\Bundle\TwigBundle\TwigEngine;

class EmailSendListener {
    protected $mailer;

    protected $engine;

    public function __construct(\Swift_Mailer $mailer, TwigEngine $engine)
    {
        $this->mailer = $mailer;
        $this->engine = $engine;
    }

    public function onBidEvent(EmailEvent $event)
    {
        $bid = $event->getBid();

        if ($bid) {
            $message = (new \Swift_Message())
                ->setSubject('New match tomorrow')
                ->setFrom(['lysak.posta@gmail.com' => 'Lysak Dmitry'])
                ->setTo('govnarev@ukr.net')
                ->setBody(
                    $this->engine->render(
                        'league/mail/email.html.twig',
                        ['username' => $bid["user"]["name"], 'team1' => $bid["homeTeam"], 'team2' => $bid["guestTeam"]]
                    ),
                    'text/html'
                );
            $this->mailer->send($message);
        }
    }
}