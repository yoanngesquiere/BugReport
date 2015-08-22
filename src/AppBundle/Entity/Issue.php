<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\IssueRepository")
 * @ORM\Table(name="issue")
 */
class Issue
{
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     */
    protected $tracker;

    /**
     * @ORM\Column(type="integer")
     */
    protected $priority;

    /**
     * @ORM\Column(type="integer")
     */
    protected $state;

    /**
     * @ORM\Column(type="date")
     */
    protected $creationDate;

    /**
     * @ORM\Column(type="date")
     */
    protected $inProgressDate;

    /**
     * @ORM\Column(type="date")
     */
    protected $resolvedDate;

    /**
     * @ORM\Column(type="date")
     */
    protected $closedDate;

    /**
     * @ORM\ManyToOne(targetEntity="Software", inversedBy="id")
     * @ORM\JoinColumn(name="software_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $software;


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
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getInProgressDate()
    {
        return $this->inProgressDate;
    }

    /**
     * @param mixed $inProgressDate
     */
    public function setInProgressDate($inProgressDate)
    {
        $this->inProgressDate = $inProgressDate;
    }

    /**
     * @return mixed
     */
    public function getResolvedDate()
    {
        return $this->resolvedDate;
    }

    /**
     * @param mixed $resolvedDate
     */
    public function setResolvedDate($resolvedDate)
    {
        $this->resolvedDate = $resolvedDate;
    }

    /**
     * @return mixed
     */
    public function getClosedDate()
    {
        return $this->closedDate;
    }

    /**
     * @param mixed $closedDate
     */
    public function setClosedDate($closedDate)
    {
        $this->closedDate = $closedDate;
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
