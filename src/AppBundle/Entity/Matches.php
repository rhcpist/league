<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matches
 *
 * @ORM\Table(name="matches")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MatchesRepository")
 */
class Matches
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="team1", type="integer", nullable=true)
     */

    private $team1;

    /**
     * @var int
     *
     * @ORM\Column(name="scored1", type="integer", nullable=true)
     */
    private $scored1;

    /**
     * @var int
     *
     * @ORM\Column(name="team2", type="integer", nullable=true)
     */
    private $team2;

    /**
     * @var int
     *
     * @ORM\Column(name="scored2", type="integer", nullable=true)
     */
    private $scored2;

    /**
     * Many Matches have One Team.
     * @ORM\ManyToOne(targetEntity="Teams", fetch="EAGER")
     * @ORM\JoinColumn(name="team1", referencedColumnName="id")
     *
     */
    public $team_1;

    /**
     * Many Matches have One Team.
     * @ORM\ManyToOne(targetEntity="Teams", fetch="EAGER")
     * @ORM\JoinColumn(name="team2", referencedColumnName="id")
     *
     */
    private $team_2;

    /**
     * Set Team1
     * @param object Teams
     * @return object
     */

    public function setTeam_1($team) {
        $this->team_1 = $team;

        return $this->team_1;
    }

    /**
     * Set Team2
     * @param object Teams
     * @return object
     */

    public function setTeam_2($team) {
        $this->team_2 = $team;

        return $this->team_2;
    }

    /**
     * Get Team1
     * @return object
     */
    public function getTeam_1()
    {
        return $this->team_1;
    }

    /**
     * Get Team2
     * @return object
     */
    public function getTeam_2()
    {
        return $this->team_2;
    }

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
     * Set date
     *
     * @param \DateTime $date
     * @return Matches
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set team1
     *
     * @param integer $team1
     * @return Matches
     */
    public function setTeam1($team1)
    {
        $this->team1 = $team1;

        return $this;
    }

    /**
     * Get team1
     *
     * @return integer 
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Set scored1
     *
     * @param integer $scored1
     * @return Matches
     */
    public function setScored1($scored1)
    {
        $this->scored1 = $scored1;

        return $this;
    }

    /**
     * Get scored1
     *
     * @return integer 
     */
    public function getScored1()
    {
        return $this->scored1;
    }

    /**
     * Set team2
     *
     * @param integer $team2
     * @return Matches
     */
    public function setTeam2($team2)
    {
        $this->team2 = $team2;

        return $this;
    }

    /**
     * Get team2
     *
     * @return integer 
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * Set scored2
     *
     * @param integer $scored2
     * @return Matches
     */
    public function setScored2($scored2)
    {
        $this->scored2 = $scored2;

        return $this;
    }

    /**
     * Get scored2
     *
     * @return integer 
     */
    public function getScored2()
    {
        return $this->scored2;
    }
}
