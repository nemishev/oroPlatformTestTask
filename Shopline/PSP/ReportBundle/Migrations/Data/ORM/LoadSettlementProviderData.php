<?php

namespace Shopline\PSP\ReportBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Shopline\PSP\ReportBundle\Entity\Provider\Klarna as KlarnaProvider;

/**
 * Class LoadSettlementProviderData
 *
 * @package Shopline\PSP\ReportBundle\Migrations\Data\ORM
 */
class LoadSettlementProviderData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $om)
    {
        $klarnaProvider = new KlarnaProvider();
        $klarnaProvider->setName('Klarna');

        $om->persist($klarnaProvider);
        $om->flush();

        $this->addReference('klarna_settlement_provider', $klarnaProvider);
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
} 