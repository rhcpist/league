<?php

namespace AppBundle\EventListener;

use AppBundle\Event\UpdateRateEvent;
use AppBundle\Entity\Teams;
use Doctrine\ORM\EntityManager;

class UpdateRateListener {

    protected $em;
    protected $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(Teams::class);
    }

    public function postUpdate(UpdateRateEvent $event)
    {
        $data = $event->getDataMatch();
        dump($data);

        switch ($data["option"]) {
            case "edit":
                $this->editMatch($data);
                break;
            case "add":
                $this->addMatch($data);
                break;
            case "delete":
                $this->deleteMatch($data);
                break;
        }
    }

    private function editMatch($data)
    {
        if (\array_key_exists("draw", $data)) {
            $team1 = $this->repository->find($data["draw"][0]["id"]);
            $team1->setPlayed(1);
            $team1->setDraws(1);
            $team1->setWins(0);
            $team1->setLosses(0);
            $team1->setScored($data["draw"][0]["scored"]);
            $team1->setMissed($data["draw"][0]["missed"]);

            $team2 = $this->repository->find($data["draw"][1]["id"]);
            $team2->setPlayed(1);
            $team2->setDraws(1);
            $team2->setWins(0);
            $team2->setLosses(0);
            $team2->setScored($data["draw"][1]["missed"]);
            $team2->setMissed($data["draw"][1]["missed"]);

            $this->em->persist($team1);
            $this->em->persist($team2);
            $this->em->flush();
        }
        else {
            $teamWin = $this->repository->find($data["win"]["id"]);
            $teamWin->setPlayed(1);
            $teamWin->setWins(1);
            $teamWin->setDraws(0);
            $teamWin->setLosses(0);
            $teamWin->setScored($data["win"]["scored"]);
            $teamWin->setMissed($data["win"]["missed"]);

            $teamLoss = $this->repository->find($data["loss"]["id"]);
            $teamLoss->setPlayed(1);
            $teamLoss->setLosses(1);
            $teamLoss->setDraws(0);
            $teamLoss->setWins(0);
            $teamLoss->setScored($data["loss"]["scored"]);
            $teamLoss->setMissed($data["loss"]["missed"]);

            $this->em->persist($teamWin);
            $this->em->persist($teamLoss);
            $this->em->flush();
        }
    }

    private function deleteMatch($data)
    {
        if (\array_key_exists("draw", $data)) {
            $team1 = $this->repository->find($data["draw"][0]["id"]);
            $team1->setPlayed($team1->getPlayed() - 1);
            $team1->setDraws($team1->getDraws() - 1);
            $team1->setWins($team1->getWins());
            $team1->setLosses($team1->getLosses());
            $team1->setScored($team1->getScored() - $data["draw"][0]["scored"]);
            $team1->setMissed($team1->getMissed() - $data["draw"][0]["missed"]);

            $team2 = $this->repository->find($data["draw"][1]["id"]);
            $team2->setPlayed($team2->getPlayed() - 1);
            $team2->setDraws($team2->getDraws() - 1);
            $team2->setWins($team2->getWins());
            $team2->setLosses($team2->getLosses());
            $team2->setScored($team2->getScored() - $data["draw"][1]["missed"]);
            $team2->setMissed($team2->getMissed() - $data["draw"][1]["missed"]);

            $this->em->persist($team1);
            $this->em->persist($team2);
            $this->em->flush();
        }
        else {
            $teamWin = $this->repository->find($data["win"]["id"]);
            $teamWin->setPlayed($teamWin->getPlayed() - 1);
            $teamWin->setWins($teamWin->getWins() - 1);
            $teamWin->setDraws($teamWin->getDraws());
            $teamWin->setLosses($teamWin->getLosses());
            $teamWin->setScored($teamWin->getScored() - $data["win"]["scored"]);
            $teamWin->setMissed($teamWin->getMissed() - $data["win"]["missed"]);

            $teamLoss = $this->repository->find($data["loss"]["id"]);
            $teamLoss->setPlayed($teamLoss->getPlayed() - 1);
            $teamLoss->setLosses($teamLoss->getLosses() - 1);
            $teamLoss->setDraws($teamLoss->getDraws());
            $teamLoss->setWins($teamLoss->getWins());
            $teamLoss->setScored($teamLoss->getScored() - $data["loss"]["scored"]);
            $teamLoss->setMissed($teamLoss->getMissed() - $data["loss"]["missed"]);

            $this->em->persist($teamWin);
            $this->em->persist($teamLoss);
            $this->em->flush();
        }
    }

    private function addMatch($data)
    {
        if (\array_key_exists("draw", $data)) {
            $team1 = $this->repository->find($data["draw"][0]["id"]);
            $team1->setPlayed($team1->getPlayed() + 1);
            $team1->setDraws($team1->getDraws() + 1);
            $team1->setWins($team1->getWins());
            $team1->setLosses($team1->getLosses());
            $team1->setScored($team1->getScored() + $data["draw"][0]["scored"]);
            $team1->setMissed($team1->getMissed() + $data["draw"][0]["missed"]);

            $team2 = $this->repository->find($data["draw"][1]["id"]);
            $team2->setPlayed($team2->getPlayed() + 1);
            $team2->setDraws($team2->getDraws() + 1);
            $team2->setWins($team2->getWins());
            $team2->setLosses($team2->getLosses());
            $team2->setScored($team2->getScored() + $data["draw"][1]["missed"]);
            $team2->setMissed($team2->getMissed() + $data["draw"][1]["missed"]);

            $this->em->persist($team1);
            $this->em->persist($team2);
            $this->em->flush();
        }
        else {
            $teamWin = $this->repository->find($data["win"]["id"]);
            $teamWin->setPlayed($teamWin->getPlayed() + 1);
            $teamWin->setWins($teamWin->getWins() + 1);
            $teamWin->setDraws($teamWin->getDraws());
            $teamWin->setLosses($teamWin->getLosses());
            $teamWin->setScored($teamWin->getScored() + $data["win"]["scored"]);
            $teamWin->setMissed($teamWin->getMissed() + $data["win"]["missed"]);

            $teamLoss = $this->repository->find($data["loss"]["id"]);
            $teamLoss->setPlayed($teamLoss->getPlayed() + 1);
            $teamLoss->setLosses($teamLoss->getLosses() + 1);
            $teamLoss->setDraws($teamLoss->getDraws());
            $teamLoss->setWins($teamLoss->getWins());
            $teamLoss->setScored($teamLoss->getScored() + $data["loss"]["scored"]);
            $teamLoss->setMissed($teamLoss->getMissed() + $data["loss"]["missed"]);

            $this->em->persist($teamWin);
            $this->em->persist($teamLoss);
            $this->em->flush();
        }
    }
}