<?php

namespace Shopline\PSP\ReportBundle\Entity\Transaction;

use Doctrine\ORM\Mapping AS ORM;
use Shopline\PSP\ReportBundle\Entity\Settlement\AbstractSettlement;

/**
 * Class AbstractTransaction
 *
 * @ORM\Table(name="report_settlement_transactions")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"klarna"="Klarna"})
 * 
 * @package Shopline\PSP\ReportBundle\Entity\Transaction
 */
class AbstractTransaction
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", nullable=false)
     */
    private $grossTotal;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", nullable=false)
     */
    private $invoiceFee;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", nullable=false)
     */
    private $factoringFee;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $invoiceNumber;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $orderId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=false)
     */
    private $transactionDate;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", nullable=false)
     */
    private $fee;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", nullable=false)
     */
    private $netTotal;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", nullable=false)
     */
    private $tax;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", nullable=false)
     */
    private $taxRate;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $refund;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $currency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Shopline\PSP\ReportBundle\Entity\Settlement\AbstractSettlement", inversedBy="transactions")
     * @ORM\JoinColumn(name="settlementId", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $settlement;

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getFactoringFee()
    {
        return $this->factoringFee;
    }

    /**
     * @param float $factoringFee
     */
    public function setFactoringFee($factoringFee)
    {
        $this->factoringFee = $factoringFee;
    }

    /**
     * @return float
     */
    public function getFee()
    {
        return $this->fee;
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
    public function getGrossTotal()
    {
        return $this->grossTotal;
    }

    /**
     * @param float $grossTotal
     */
    public function setGrossTotal($grossTotal)
    {
        $this->grossTotal = $grossTotal;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getInvoiceFee()
    {
        return $this->invoiceFee;
    }

    /**
     * @param float $invoiceFee
     */
    public function setInvoiceFee($invoiceFee)
    {
        $this->invoiceFee = $invoiceFee;
    }

    /**
     * @return int
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * @param int $invoiceNumber
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * @return float
     */
    public function getNetTotal()
    {
        return $this->netTotal;
    }

    /**
     * @param float $netTotal
     */
    public function setNetTotal($netTotal)
    {
        $this->netTotal = $netTotal;
    }

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return bool
     */
    public function getRefund()
    {
        return $this->refund;
    }

    /**
     * @param bool $refund
     */
    public function setRefund($refund)
    {
        $this->refund = $refund;
    }

    /**
     * @return AbstractSettlement
     */
    public function getSettlement()
    {
        return $this->settlement;
    }

    /**
     * @param AbstractSettlement $settlement
     */
    public function setSettlement(AbstractSettlement $settlement)
    {
        $settlement->addTransaction($this);
        $this->settlement = $settlement;
    }

    /**
     * @return float
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param float $tax
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
    }

    /**
     * @return float
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * @param float $taxRate
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;
    }

    /**
     * @return \DateTime
     */
    public function getTransactionDate()
    {
        return $this->transactionDate;
    }

    /**
     * @param \DateTime $transactionDate
     */
    public function setTransactionDate(\DateTime $transactionDate)
    {
        $this->transactionDate = $transactionDate;
    }
} 