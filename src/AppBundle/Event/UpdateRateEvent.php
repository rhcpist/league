<?php

namespace AppBundle\Event;
use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\Teams;

class UpdateRateEvent extends Event {

    protected $dataMatch;

    protected $em;

    public function __construct($dataMatch)
    {
        $rate = array();
        if ($dataMatch->getScored1() > $dataMatch->getScored2()) {
            $rate["win"]["id"] = $dataMatch->getTeam1();
            $rate["win"]["scored"] = $dataMatch->getScored1();
            $rate["win"]["missed"] = $dataMatch->getScored2();
            $rate["loss"]["id"] = $dataMatch->getTeam2();
            $rate["loss"]["scored"] = $dataMatch->getScored2();
            $rate["loss"]["missed"] = $dataMatch->getScored1();
            #dump($rate);
        }
        if ($dataMatch->getScored1() < $dataMatch->getScored2()) {
            $rate["win"]["id"] = $dataMatch->getTeam2();
            $rate["win"]["scored"] = $dataMatch->getScored2();
            $rate["win"]["missed"] = $dataMatch->getScored1();
            $rate["loss"]["id"] = $dataMatch->getTeam1();
            $rate["loss"]["scored"] = $dataMatch->getScored1();
            $rate["loss"]["missed"] = $dataMatch->getScored2();
            #dump($rate);
        }
        if ($dataMatch->getScored1() == $dataMatch->getScored2()) {
            $rate["draw"][0]["id"] = $dataMatch->getTeam1();
            $rate["draw"][0]["scored"] = $dataMatch->getScored1();
            $rate["draw"][0]["missed"] = $dataMatch->getScored2();
            $rate["draw"][1]["id"] = $dataMatch->getTeam2();
            $rate["draw"][1]["scored"] = $dataMatch->getScored2();
            $rate["draw"][1]["missed"] = $dataMatch->getScored1();
            #dump($rate);
        }
        $this->dataMatch = $rate;
    }

    public function getDataMatch()
    {
        return $this->dataMatch;
    }
}