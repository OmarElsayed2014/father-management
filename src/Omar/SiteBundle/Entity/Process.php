<?php

namespace Omar\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints AS Assert;

/**
 * ØProcess
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Process
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
     * @ORM\ManyToOne(targetEntity="\Omar\SiteBundle\Entity\Deal", inversedBy="processes",cascade={"persist"})
     * @ORM\JoinColumn(name="deal_id", referencedColumnName="id", onDelete="CASCADE")},
     */
    private $deal;

    /**
     * @var \DateTime
     * @Assert\NotBlank
     * @Assert\DateTime
     * @ORM\Column(name="date", type="datetime")
     */
    private $Date;

    /**
     * @var float
     * @Assert\NotBlank
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="remain", type="float")
     */
    private $remain;


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
     * Set Date
     *
     * @param \DateTime $Date
     * @return ØProcess
     */
    public function setDate($Date)
    {
        $this->Date = $Date;

        return $this;
    }

    /**
     * Get Date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return ØProcess
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set remain
     *
     * @param float $remain
     * @return ØProcess
     */
    public function setRemain($remain)
    {
        $this->remain = $remain;

        return $this;
    }

    /**
     * Get remain
     *
     * @return float 
     */
    public function getRemain()
    {
        return $this->remain;
    }

    /**
     * Set deal
     *
     * @param \Omar\SiteBundle\Entity\Deal $deal
     * @return Process
     */
    public function setDeal(\Omar\SiteBundle\Entity\Deal $deal = null)
    {
        $this->deal = $deal;

        return $this;
    }

    /**
     * Get deal
     *
     * @return \Omar\SiteBundle\Entity\Deal 
     */
    public function getDeal()
    {
        return $this->deal;
    }
    
    public function __toString() {
        return (String) "Deal";
    }
}
