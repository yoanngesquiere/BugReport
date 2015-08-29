<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\IssueRepository")
 * @ORM\Table(name="issue_aggregation")
 */
class IssueAggregation {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $tracker;

    /**
     * @ORM\Column(type="integer")
     */
    protected $priority;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $software;

    /**
     * @ORM\Column(type="integer")
     */
    protected $year;

    /**
     * @ORM\Column(type="integer")
     */
    protected $week;

    /**
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    protected $openedIssues = 0;

    /**
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    protected $closedIssues = 0;

    /**
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    protected $totalIssues = 0;

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * @param mixed $week
     */
    public function setWeek($week)
    {
        $this->week = $week;
    }

    /**
     * @return mixed
     */
    public function getOpenedIssues()
    {
        return $this->openedIssues;
    }

    /**
     * @param mixed $openedIssues
     */
    public function setOpenedIssues($openedIssues)
    {
        $this->openedIssues = $openedIssues;
    }

    /**
     * @return mixed
     */
    public function getClosedIssues()
    {
        return $this->closedIssues;
    }

    /**
     * @param mixed $closedIssues
     */
    public function setClosedIssues($closedIssues)
    {
        $this->closedIssues = $closedIssues;
    }

    /**
     * @return mixed
     */
    public function getTotalIssues()
    {
        return $this->totalIssues;
    }

    /**
     * @param mixed $totalIssues
     */
    public function setTotalIssues($totalIssues)
    {
        $this->totalIssues = $totalIssues;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTracker()
    {
        return $this->tracker;
    }

    /**
     * @param mixed $tracker
     */
    public function setTracker($tracker)
    {
        $this->tracker = $tracker;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return mixed
     */
    public function getSoftware()
    {
        return $this->software;
    }

    /**
     * @param mixed $software
     */
    public function setSoftware($software)
    {
        $this->software = $software;
    }
}