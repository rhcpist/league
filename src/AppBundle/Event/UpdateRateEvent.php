<?php

namespace AppBundle\Event;
use Symfony\Component\EventDispatcher\Event;


class UpdateRateEvent extends Event {

    protected $dataMatch;

    public function __construct($dataMatch, $option)
    {
        $rate = array();

        if ($dataMatch->getScored1() > $dataMatch->getScored2()) {
            $rate["win"]["id"] = $dataMatch->getTeam1();
            $rate["win"]["scored"] = $dataMatch->getScored1();
            $rate["win"]["missed"] = $dataMatch->getScored2();
            $rate["loss"]["id"] = $dataMatch->getTeam2();
            $rate["loss"]["scored"] = $dataMatch->getScored2();
            $rate["loss"]["missed"] = $dataMatch->getScored1();
        }
        if ($dataMatch->getScored1() < $dataMatch->getScored2()) {
            $rate["win"]["id"] = $dataMatch->getTeam2();
            $rate["win"]["scored"] = $dataMatch->getScored2();
            $rate["win"]["missed"] = $dataMatch->getScored1();
            $rate["loss"]["id"] = $dataMatch->getTeam1();
            $rate["loss"]["scored"] = $dataMatch->getScored1();
            $rate["loss"]["missed"] = $dataMatch->getScored2();
        }
        if ($dataMatch->getScored1() == $dataMatch->getScored2()) {
            $rate["draw"][0]["id"] = $dataMatch->getTeam1();
            $rate["draw"][0]["scored"] = $dataMatch->getScored1();
            $rate["draw"][0]["missed"] = $dataMatch->getScored2();
            $rate["draw"][1]["id"] = $dataMatch->getTeam2();
            $rate["draw"][1]["scored"] = $dataMatch->getScored2();
            $rate["draw"][1]["missed"] = $dataMatch->getScored1();
        }

        switch ($option){
            case 'edit':
                $rate["option"] = $option;
                $this->dataMatch = $rate;
                break;
            case 'add':
                $rate["option"] = $option;
                $this->dataMatch = $rate;
                break;
            case 'delete':
                $rate["option"] = $option;
                $this->dataMatch = $rate;
                break;
        }
    }

    public function getDataMatch()
    {
        return $this->dataMatch;
    }
}