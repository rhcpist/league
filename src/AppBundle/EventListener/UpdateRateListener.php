<?php

namespace AppBundle\EventListener;

use AppBundle\Event\UpdateRateEvent;
use AppBundle\Entity\Teams;
use Doctrine\ORM\EntityManager;

class UpdateRateListener {

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;

    }

    public function postUpdate(UpdateRateEvent $event)
    {
        $repository = $this->em->getRepository(Teams::class);
        $data = $event->getDataMatch();
        if (\array_key_exists("draw", $data))
        {
            $team1 = $repository->find($data["draw"][0]["id"]);
            $team1->setPlayed(1);
            $team1->setDraws(1);
            $team1->setScored($data["draw"][0]["scored"]);
            $team1->setMissed($data["draw"][0]["missed"]);

            $team2 = $repository->find($data["draw"][1]["id"]);
            $team2->setPlayed(1);
            $team2->setDraws(1);
            $team2->setScored($data["draw"][1]["missed"]);
            $team2->setMissed($data["draw"][1]["missed"]);

            $this->em->persist($team1);
            $this->em->persist($team2);
            $this->em->flush();
            dump($team1);
            dump($team2);
        }
        else {
            dump($data);
        }
    }

}