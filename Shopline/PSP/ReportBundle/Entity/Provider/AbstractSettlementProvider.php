<?php

namespace Shopline\PSP\ReportBundle\Entity\Provider;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Shopline\PSP\ReportBundle\Entity\Settlement\AbstractSettlement;

/**
 * Class AbstractSettlementProvider
 *
 * @ORM\Table(name="report_settlement_providers")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"klarna"="Klarna"})
 *
 * @package Shopline\PSP\ReportBundle\Entity\Provider
 */
class AbstractSettlementProvider
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32)
     */
    protected $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Shopline\PSP\ReportBundle\Entity\Settlement\AbstractSettlement", mappedBy="provider")
     */
    protected $settlements;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->settlements = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param ArrayCollection $settlements
     */
    public function setSettlements(ArrayCollection $settlements)
    {
        $this->settlements = $settlements;
    }

    /**
     * @param AbstractSettlement $settlement
     */
    public function addSettlement(AbstractSettlement $settlement)
    {
        $settlements = $this->getSettlements();
        if (!$settlements->contains($settlement)) {
            $settlements->add($settlement);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getSettlements()
    {
        return $this->settlements;
    }
} 