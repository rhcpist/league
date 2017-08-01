<?php

namespace AppBundle\Controller;

use AppBundle\Event\EmailEvent;
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
//        $message = (new \Swift_Message())
//            ->setSubject('My subject new')
//            ->setFrom(['lysak.posta@gmail.com' => 'Lysak Dmitry'])
//            ->setTo('govnarev@ukr.net')
//            ->setBody($this->renderView(
//                'league/mail/email.txt.twig',
//                ['username' => 'Dmitriy', 'team1' => 'Dinamo Kiev', 'team2' => 'Young Boys']
//            ));
//        $this->get('mailer')->send($message);

        $em = $this->getDoctrine()->getManager();
        $matches = $em->getRepository(Matches::class)->getAllMatches();
        $userTeam = $this->getUser()->getTeam();
        foreach ($matches as $match) {
            if ( $match["homeTeam"] == $userTeam || $match["guestTeam"] == $userTeam ) {
                $data = $match;
            }
        }
        $data["user"]["name"] = $this->getUser()->getUsername();
        $data["user"]["id"] = $this->getUser()->getId();
        $data["user"]["team"] = $userTeam;
        $data["user"]["notified"] = $this->getUser()->getNotified();
        dump($data);

        $dispatcher = $this->container->get('event_dispatcher');
        $dispatcher->dispatch('app.email', new EmailEvent($em, $data));

        return $this->render('league/index.html.twig', array('matches' => $matches));
    }
}