<?php

namespace Shopline\PSP\ReportBundle\Entity\Settlement;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Shopline\PSP\ReportBundle\Entity\Provider\AbstractSettlementProvider;
use Shopline\PSP\ReportBundle\Entity\Transaction\AbstractTransaction;

/**
 * Class AbstractSettlement
 *
 * @ORM\Table(name="report_settlements")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"klarna"="Klarna"})
 *
 * @package Shopline\PSP\ReportBundle\Entity\Settlement
 */
abstract class AbstractSettlement
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
     * @var float
     *
     * @ORM\Column(type="decimal")
     */
    protected $grossTotal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    protected $settlementDate;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $terminalId;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $channelId;

    /**
     * @var int
     *
     * @ORM\Column(type="bigint", unique=true)
     */
    protected $settlementId;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal")
     */
    protected $fee;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal")
     */
    protected $taxTotal;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal")
     */
    protected $netTotal;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $currency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @ConfigField(
     *      defaultValues={
     *          "entity"={
     *              "label"="oro.ui.created_at"
     *          }
     *      }
     * )
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @ConfigField(
     *      defaultValues={
     *          "entity"={
     *              "label"="oro.ui.updated_at"
     *          }
     *      }
     * )
     */
    protected $updatedAt;

    /**
     * @ORM\Column(type="blob")
     */
    protected $sourceData;

    /**
     * @var array
     *
     * @ORM\Column(type="json_array", nullable=true)
     */
    protected $providerInfo;

    /**
     * @var AbstractSettlementProvider
     *
     * @ORM\ManyToOne(targetEntity="Shopline\PSP\ReportBundle\Entity\Provider\AbstractSettlementProvider", inversedBy="settlements")
     * @ORM\JoinColumn(name="providerId", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $provider;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Shopline\PSP\ReportBundle\Entity\Transaction\AbstractTransaction", mappedBy="settlement")
     */
    protected $transactions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $grossTotal
     */
    public function setGrossTotal($grossTotal)
    {
        $this->grossTotal = $grossTotal;
    }

    /**
     * @return mixed
     */
    public function getGrossTotal()
    {
        return $this->grossTotal;
    }

    /**
     * @param \DateTime $settlementDate
     */
    public function setSettlementDate(\DateTime $settlementDate)
    {
        $this->settlementDate = $settlementDate;
    }

    /**
     * @return \DateTime
     */
    public function getSettlementDate()
    {
        return $this->settlementDate;
    }

    /**
     * @param int $terminalId
     */
    public function setTerminalId($terminalId)
    {
        $this->terminalId = $terminalId;
    }

    /**
     * @return int
     */
    public function getTerminalId()
    {
        return $this->terminalId;
    }

    /**
     * @param int $settlementId
     */
    public function setSettlementId($settlementId)
    {
        $this->settlementId = $settlementId;
    }

    /**
     * @return int
     */
    public function getSettlementId()
    {
        return $this->settlementId;
    }

    /**
     * @param int $channelId
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;
    }

    /**
     * @return int
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * @param float $fee
     */
    public function setFee($fee)
    {
        $this->fee = $fee;
    }

    /**
     * @return float
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @param float $taxTotal
     */
    public function setTaxTotal($taxTotal)
    {
        $this->taxTotal = $taxTotal;
    }

    /**
     * @return float
     */
    public function getTaxTotal()
    {
        return $this->taxTotal;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param float $netTotal
     */
    public function setNetTotal($netTotal)
    {
        $this->netTotal = $netTotal;
    }

    /**
     * @return float
     */
    public function getNetTotal()
    {
        return $this->netTotal;
    }

    /**
     * @param array $providerInfo
     */
    public function setProviderInfo($providerInfo)
    {
        $this->providerInfo = $providerInfo;
    }

    /**
     * @return array
     */
    public function getProviderInfo()
    {
        return $this->providerInfo;
    }

    /**
     * @param mixed $sourceData
     */
    public function setSourceData($sourceData)
    {
        $this->sourceData = $sourceData;
    }

    /**
     * @return mixed
     */
    public function getSourceData()
    {
        return $this->sourceData;
    }

    /**
     * @return AbstractSettlementProvider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param AbstractSettlementProvider $provider
     */
    public function setProvider($provider)
    {
        $provider->addSettlement($this);
        $this->provider = $provider;
    }

    /**
     * @param ArrayCollection $transactions
     */
    public function setTransactions(ArrayCollection $transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * @param AbstractTransaction $transaction
     */
    public function addTransaction(AbstractTransaction $transaction)
    {
        $transactions = $this->getTransactions();
        if (!$transactions->contains($transaction)) {
            $transactions->add($transaction);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
} 