<?php

namespace Shopline\PSP\ReportBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Util\Inflector;
use Shopline\PSP\ReportBundle\Entity\Transaction\Klarna as KlarnaTransaction;

/**
 * Class LoadTransactionData
 *
 * @package Shopline\PSP\ReportBundle\DataFixtures\ORM
 */
class LoadTransactionData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $om)
    {
        $transactionData = array(
            'net_total'      => 5,
            'gross_total'    => 5,
            'fee'            => 5,
            'currency'       => 'EUR',
            'factoring_fee'  => 5,
            'invoice_fee'    => 5,
            'order_id'       => 5,
            'refund'         => false,
            'invoice_number' => 5,
            'tax'            => 5,
            'tax_rate'       => 5,
        );

        $dateTimeNow = new \DateTime();
        for ($i = 1; $i <= 4; $i++) {
            $transaction = new KlarnaTransaction();
            $settlement  = $this->getReference(sprintf('settlement%d', $i < 3 ? 1 : 2));
            $transaction->setSettlement($settlement);
            foreach ($transactionData as $prop => $val) {
                $transaction->setCreatedAt($dateTimeNow);
                $transaction->setTransactionDate($dateTimeNow);

                if (is_numeric($val)) {
                    $val += ($i *2);
                }

                $setter = Inflector::camelize(sprintf('set%s', $prop));
                if (method_exists($transaction, $setter)) {
                    $transaction->$setter($val);
                }
            }

            $om->persist($transaction);
        }

        $om->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}