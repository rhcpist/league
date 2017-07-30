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
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository(Matches::class)->getAllMatches();
        dump($team);

        return new Response(
            '<html><body>Lucky number: '.$team.'</body></html>'
        );
    }
}