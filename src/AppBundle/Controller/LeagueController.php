<?php

namespace AppBundle\Controller;

use AppBundle\Event\EmailEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Teams;
use AppBundle\Entity\Matches;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LeagueController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
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

    /**
     * @Route("/edit/{id}", name="edit_match")
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository(Matches::class)->find($id);
        if (empty($match)) {
            return Response::HTTP_NOT_FOUND;
        }

        $form = $this->createFormBuilder($match)
            ->add('scored1', IntegerType::class)
            ->add('scored2', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Edit match'))
            ->getForm();

        return $this->render('league/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}