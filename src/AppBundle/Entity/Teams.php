<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teams
 *
 * @ORM\Table(name="teams")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamsRepository")
 */
class Teams
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="team", type="string", length=255, unique=true, nullable=true)
     */
    private $team;

    /**
     * @var int
     *
     * @ORM\Column(name="played", type="integer", options={"default":0})
     */
    private $played;

    /**
     * @var int
     *
     * @ORM\Column(name="wins", type="integer", options={"default":0})
     */
    private $wins;

    /**
     * @var int
     *
     * @ORM\Column(name="draws", type="integer", options={"default":0})
     */
    private $draws;

    /**
     * @var int
     *
     * @ORM\Column(name="losses", type="integer", options={"default":0})
     */
    private $losses;

    /**
     * @var int
     *
     * @ORM\Column(name="scored", type="integer", options={"default":0})
     */
    private $scored;

    /**
     * @var int
     *
     * @ORM\Column(name="missed", type="integer", options={"default":0})
     */
    private $missed;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set team
     *
     * @param string $team
     * @return Teams
     */
    public function setTeam($team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return string 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set played
     *
     * @param integer $played
     * @return Teams
     */
    public function setPlayed($played)
    {
        $this->played = $played;

        return $this;
    }

    /**
     * Get played
     *
     * @return integer 
     */
    public function getPlayed()
    {
        return $this->played;
    }

    /**
     * Set wins
     *
     * @param integer $wins
     * @return Teams
     */
    public function setWins($wins)
    {
        $this->wins = $wins;

        return $this;
    }

    /**
     * Get wins
     *
     * @return integer 
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * Set draws
     *
     * @param integer $draws
     * @return Teams
     */
    public function setDraws($draws)
    {
        $this->draws = $draws;

        return $this;
    }

    /**
     * Get draws
     *
     * @return integer 
     */
    public function getDraws()
    {
        return $this->draws;
    }

    /**
     * Set losses
     *
     * @param integer $losses
     * @return Teams
     */
    public function setLosses($losses)
    {
        $this->losses = $losses;

        return $this;
    }

    /**
     * Get losses
     *
     * @return integer 
     */
    public function getLosses()
    {
        return $this->losses;
    }

    /**
     * Set scored
     *
     * @param integer
     * @return Teams
     */
    public function setScored($scored)
    {
        $this->scored = $scored;

        return $this;
    }

    /**
     * Get scored
     *
     * @return integer 
     */
    public function getScored()
    {
        return $this->scored;
    }

    /**
     * Set missed
     *
     * @param integer $missed
     * @return Teams
     */
    public function setMissed($missed)
    {
        $this->missed = $missed;

        return $this;
    }

    /**
     * Get missed
     *
     * @return integer 
     */
    public function getMissed()
    {
        return $this->missed;
    }
}
