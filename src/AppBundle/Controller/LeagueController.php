<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Teams;
use AppBundle\Entity\Matches;

class LeagueController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $message = (new \Swift_Message('Hello email'))
            ->setSubject('My subject123')
            ->setFrom(['govnarev@ukr.net' => 'Govnarev'])
            ->setTo('lysak.posta@gmail.com')
            ->setBody('Here is the message itself');
        $this->get('mailer')->send($message);

        $em = $this->getDoctrine()->getManager();
        $matches = $em->getRepository(Matches::class)->getAllMatches();
        dump($matches);

        return $this->render('league/index.html.twig', array('matches' => $matches));
    }
}