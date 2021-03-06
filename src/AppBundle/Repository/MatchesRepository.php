<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * MatchesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MatchesRepository extends EntityRepository
{
    public function getAllMatches()
    {
        $query = $this->getEntityManager()->createQuery(
            '
                select 
                  m.id,
                  m.date, 
                  (select tm.team from AppBundle:Teams tm where tm.id = m.team1) homeTeam, 
                  m.scored1, 
                  (select ts.team from AppBundle:Teams ts where ts.id = m.team2) guestTeam, 
                  m.scored2
                from AppBundle:Matches m
                     left join AppBundle:Teams t
                       with t.id = m.team1
                       and t.id = m.team2
            '
        );
        return $query->getResult(Query::HYDRATE_SCALAR);
    }

    public function getMatchById($id)
    {
        $query = $this->getEntityManager()->createQuery(
            '
                select 
                  m.id,
                  m.date, 
                  (select tm.team from AppBundle:Teams tm where tm.id = m.team1) homeTeam, 
                  m.scored1, 
                  (select ts.team from AppBundle:Teams ts where ts.id = m.team2) guestTeam, 
                  m.scored2
                from AppBundle:Matches m
                     left join AppBundle:Teams t
                       with t.id = m.team1
                       and t.id = m.team2
                where m.id = :id
            '
        )->setParameter('id', $id);
        return $query->getResult(Query::HYDRATE_SCALAR);
    }
}
