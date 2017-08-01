<?php

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;

class EmailEvent extends Event {

    protected $bid;

    protected $em;

    public function __construct(EntityManager $em, $bid)
    {
        if ( (\strtotime($bid['date']) - 86400) <= \time() && $bid['user']['notified'] == 0 ) {
            $userObj = $this->em = $em->getRepository(User::class)->find($bid['user']['id']);
            $userObj->setNotified(1);
            $em->flush();

            $this->bid = $bid;
        }
        else {
            $this->bid = null;
        }
    }

    public function getBid()
    {
        return $this->bid;
    }

}
