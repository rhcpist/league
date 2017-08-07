<?php

namespace AppBundle\Controller;

use AppBundle\Event\EmailEvent;
#use Doctrine\DBAL\Types\DateTimeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Teams;
use AppBundle\Entity\Matches;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

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
//        dump($matches);

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
            ->setMethod('PUT')
            ->add('scored1', IntegerType::class, array('label' => $match->getTeam_1()->getTeam()))
            ->add('scored2', IntegerType::class, array('label' => $match->getTeam_2()->getTeam()))
            ->add('save', SubmitType::class, array('label' => 'Change match score', 'attr' => array('class' => 'btn btn-primary')))
            ->getForm();

        if ($request->isMethod('PUT')) {
            $form->submit($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $match->setScored1($data->getScored1());
                $match->setScored2($data->getScored2());
//                $match->setTeam_1($data->getTeam_1())->setScored($data->getScored1());
//                $match->setTeam_2($data->getTeam_2())->setScored($data->getScored2());
                $em->persist($match);
                $em->flush();
                //dump($match);
                return $this->redirectToRoute('homepage');
            }
        }
        return $this->render('league/edit.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/delete/{id}", name="delete_match")
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository(Matches::class)->find($id);
        if (empty($match)) {
            return Response::HTTP_NOT_FOUND;
        }
        $em->remove($match);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/create", name="create_match")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $teams = $em->getRepository(Teams::class)->findAll();
        $match = new Matches();

        $form = $this->createFormBuilder($teams)
            ->setMethod('POST')
            ->add('startDateTime', DateTimeType::class, array(
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                )
            ))
            ->add('team1', EntityType::class, array(
                'label' => 'Choose HomeTeam',
                'class' => 'AppBundle:Teams',
                'choice_label' => 'team',
                'mapped' => true
            ))
            ->add('scored1', IntegerType::class, array('label' => false, 'required' => false))
            ->add('team2', EntityType::class, array(
                'label' => 'Choose GuestTeam',
                'class' => 'AppBundle:Teams',
                'choice_label' => 'team',
                'mapped' => true
            ))
            ->add('scored2', IntegerType::class, array('label' => false, 'required' => false))
            ->add('save', SubmitType::class, array('label' => 'Add new match', 'attr' => array('class' => 'btn btn-primary')))
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->submit($request);
            $isOneNull = is_null($form->getData()["scored1"]) && is_null($form->getData()["scored2"]) || isset($form->getData()["scored1"]) && isset($form->getData()["scored2"] );
            //dump($isOneNull);
            if ( $form->isSubmitted() && $form->isValid() && $form->getData()["team1"]->getId() != $form->getData()["team2"]->getId() && $isOneNull == true  ) {
                $data = $form->getData();
                dump($data);
                $match->setScored1($data["scored1"]);
                $match->setScored2($data["scored2"]);
                $match->setTeam1($data["team1"]->getId());
                $match->setTeam2($data["team2"]->getId());
                $match->setTeam_1($data["team1"]);
                $match->setTeam_2($data["team2"]);
                $match->setDate($data["startDateTime"]);
                $em->persist($match);
                $em->flush();
                dump($match);
                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render('league/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}