<?php

namespace Shopline\PSP\ReportBundle\Migrations\Data\ORM;

use Doctrine\Common\Util\Inflector;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Shopline\PSP\ReportBundle\Entity\Settlement\Klarna as KlarnaSettlement;

/**
 * Class LoadSettlementData
 *
 * @package Shopline\PSP\ReportBundle\DataFixtures\ORM
 */
class LoadSettlementData extends AbstractFixture implements OrderedFixtureInterface 
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $om)
    {
        $fixtures = array(
            'klarna' => array(
                array(
                    'channel_id'    => 5,
                    'currency'      => 'EUR',
                    'fee'           => 0.5,
                    'gross_total'   => 10,
                    'net_total'     => 0.7,
                    'source_data'   => 'test',
                    'tax_total'     => 5,
                    'terminal_id'   => 4,
                    'settlement_id' => 1,
                ),
                array(
                    'channel_id'    => 4,
                    'currency'      => 'USD',
                    'fee'           => 0.2,
                    'gross_total'   => 15,
                    'net_total'     => 0.2,
                    'source_data'   => 'test',
                    'tax_total'     => 7,
                    'terminal_id'   => 9,
                    'settlement_id' => 2,
                ),
            ),
        );

        $dateTimeNow = new \DateTime();

        foreach ($fixtures as $providerName => $settlements) {
            $providerRefName = sprintf('%s_settlement_provider', $providerName);
            if ($this->hasReference($providerRefName)) {
                /** @var \Shopline\PSP\ReportBundle\Entity\Provider\AbstractSettlementProvider $provider */
                $provider = $this->getReference($providerRefName);
                foreach ($settlements as $i => $settlementData) {
                    $settlement = new KlarnaSettlement();
                    $settlement->setCreatedAt($dateTimeNow);
                    $settlement->setUpdatedAt($dateTimeNow);
                    $settlement->setSettlementDate($dateTimeNow);
                    $settlement->setProvider($provider);
                    $settlement->setProviderInfo(array('name' => $provider->getName()));

                    foreach ($settlementData as $prop => $val) {
                        $setter = Inflector::camelize(sprintf('set%s', $prop));
                        if (method_exists($settlement, $setter)) {
                            $settlement->$setter($val);
                        }
                    }

                    $om->persist($settlement);

                    $this->addReference(sprintf('settlement%d', $i + 1), $settlement);
                }
            }
        }

        $om->flush();
    }
    
    /**
     * @return int
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
} 