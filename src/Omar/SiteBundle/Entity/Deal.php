<?php

namespace Omar\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints AS Assert;

/**
 * Deal
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Deal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="\Omar\SiteBundle\Entity\Dealer", inversedBy="deals",cascade={"persist"})
     * @ORM\JoinColumn(name="dealer_id", referencedColumnName="id", onDelete="CASCADE")},
     */
    private $dealer;
    
    /**
     * @ORM\OneToMany(targetEntity="\Omar\SiteBundle\Entity\Process", mappedBy="deal", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $processes;

    /**
     * @var \DateTime
     * @Assert\NotBlank
     * @Assert\DateTime
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var float
     * @Assert\NotBlank
     * @ORM\Column(name="absoluteTarget", type="float")
     */
    private $absoluteTarget;

    /**
     * @var float
     * 
     * @ORM\Column(name="profit", type="float")
     */
    private $profit;

    /**
     * @var float
     *
     * @ORM\Column(name="profitPercentage", type="float")
     */
    private $profitPercentage;

    /**
     * @var float
     * @Assert\NotBlank
     * @ORM\Column(name="realTarget", type="float")
     */
    private $realTarget;

    /**
     * @var \DateTime
     * @Assert\DateTime
     * @ORM\Column(name="endDate", type="datetime")
     */
    private $endDate;

    /**
     * @var \DateTime
     * @Assert\DateTime
     * @ORM\Column(name="expectedEndDate", type="datetime")
     */
    private $expectedEndDate;

    /**
     * @var string
     *
     * @ORM\Column(name="behaviour", type="string", length=255)
     */
    private $behaviour;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;


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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Deal
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set absoluteTarget
     *
     * @param float $absoluteTarget
     * @return Deal
     */
    public function setAbsoluteTarget($absoluteTarget)
    {
        $this->absoluteTarget = $absoluteTarget;

        return $this;
    }

    /**
     * Get absoluteTarget
     *
     * @return float 
     */
    public function getAbsoluteTarget()
    {
        return $this->absoluteTarget;
    }

    /**
     * Set profit
     *
     * @param float $profit
     * @return Deal
     */
    public function setProfit($profit)
    {
        $this->profit = $profit;

        return $this;
    }

    /**
     * Get profit
     *
     * @return float 
     */
    public function getProfit()
    {
        return $this->profit;
    }

    /**
     * Set profitPercentage
     *
     * @param float $profitPercentage
     * @return Deal
     */
    public function setProfitPercentage($profitPercentage)
    {
        $this->profitPercentage = $profitPercentage;

        return $this;
    }

    /**
     * Get profitPercentage
     *
     * @return float 
     */
    public function getProfitPercentage()
    {
        return $this->profitPercentage;
    }

    /**
     * Set realTarget
     *
     * @param float $realTarget
     * @return Deal
     */
    public function setRealTarget($realTarget)
    {
        $this->realTarget = $realTarget;

        return $this;
    }

    /**
     * Get realTarget
     *
     * @return float 
     */
    public function getRealTarget()
    {
        return $this->realTarget;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Deal
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set expectedEndDate
     *
     * @param \DateTime $expectedEndDate
     * @return Deal
     */
    public function setExpectedEndDate($expectedEndDate)
    {
        $this->expectedEndDate = $expectedEndDate;

        return $this;
    }

    /**
     * Get expectedEndDate
     *
     * @return \DateTime 
     */
    public function getExpectedEndDate()
    {
        return $this->expectedEndDate;
    }

    /**
     * Set behaviour
     *
     * @param string $behaviour
     * @return Deal
     */
    public function setBehaviour($behaviour)
    {
        $this->behaviour = $behaviour;

        return $this;
    }

    /**
     * Get behaviour
     *
     * @return string 
     */
    public function getBehaviour()
    {
        return $this->behaviour;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Deal
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->processes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set dealer
     *
     * @param \Omar\SiteBundle\Entity\Dealer $dealer
     * @return Deal
     */
    public function setDealer(\Omar\SiteBundle\Entity\Dealer $dealer = null)
    {
        $this->dealer = $dealer;

        return $this;
    }

    /**
     * Get dealer
     *
     * @return \Omar\SiteBundle\Entity\Dealer 
     */
    public function getDealer()
    {
        return $this->dealer;
    }

    /**
     * Add processes
     *
     * @param \Omar\SiteBundle\Entity\Process $processes
     * @return Deal
     */
    public function addProcess(\Omar\SiteBundle\Entity\Process $processes)
    {
        $this->processes[] = $processes;

        return $this;
    }

    /**
     * Remove processes
     *
     * @param \Omar\SiteBundle\Entity\Process $processes
     */
    public function removeProcess(\Omar\SiteBundle\Entity\Process $processes)
    {
        $this->processes->removeElement($processes);
    }

    /**
     * Get processes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProcesses()
    {
        return $this->processes;
    }
}
