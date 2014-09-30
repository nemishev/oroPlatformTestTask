<?php

namespace Shopline\PSP\ReportBundle\Menu;

use Knp\Menu\ItemInterface;
use Oro\Bundle\NavigationBundle\Menu\BuilderInterface;
use Doctrine\ORM\EntityManager;

class MainMenuBuilder implements BuilderInterface
{
    /** @var EntityManager */
    private $em;

    /**
     * Constructor
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param ItemInterface $menu
     * @param array         $options
     * @param null          $alias
     */
    public function build(ItemInterface $menu, array $options = array(), $alias = null)
    {
        $menu->setExtra('type', 'dropdown');
        $settlementsTab = $menu->addChild(
            'settlements_tab',
            array(
                'uri'    => '#',
                'label'  => 'Settlements',
            )
        );

        $settlementProviders = $this->em
            ->getRepository('ShoplinePSPReportBundle:Provider\AbstractSettlementProvider')
            ->findAll();

        /** @var \Shopline\PSP\ReportBundle\Entity\Provider\AbstractSettlementProvider $settlementProvider */
        foreach ($settlementProviders as $settlementProvider) {
            $settlementsTab->addChild(
                sprintf('settlement_provider_%s', $settlementProvider->getName()),
                array(
                    'route'           => 'psp.report.index',
                    'routeParameters' => array('id' => $settlementProvider->getId()),
                    'label'           => $settlementProvider->getName(),
                    'extras'          => array(
                        'routes'   => '/^psp.report.(index|view)$/'
                    )
                )
            );
        }
    }
}