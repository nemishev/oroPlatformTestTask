<?php

namespace Shopline\PSP\ReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Shopline\PSP\ReportBundle\Entity\Provider\AbstractSettlementProvider;
use Shopline\PSP\ReportBundle\Entity\Settlement\AbstractSettlement;

class SettlementController extends Controller
{
    /**
     * @param AbstractSettlementProvider $provider
     *
     * @Route("/provider/{id}/settlements", name="psp.report.settlements.index")
     * @Template()
     *
     * @return array
     */
    public function indexAction(AbstractSettlementProvider $provider)
    {
        return array('provider' => $provider);
    }

    /**
     * @param AbstractSettlement $settlement
     *
     * @Route("/settlement/{id}/view", name="psp.report.settlements.view", requirements={"id"="\d+"}))
     * @Template()
     *
     * @return array
     */
    public function viewAction(AbstractSettlement $settlement)
    {
        return array('entity' => $settlement);
    }

    /**
     * @param AbstractSettlement $settlement
     *
     * @Route("/settlement/{id}/info", name="psp.report.settlements.info", requirements={"id"="\d+"}))
     * @Template()
     *
     * @return array
     */
    public function infoAction(AbstractSettlement $settlement)
    {
        return array('entity' => $settlement);
    }

    /**
     * @param AbstractSettlement $settlement
     *
     * @Route("/settlement/{id}/transactions", name="psp.report.settlements.widget.transactions", requirements={"id"="\d+"}))
     * @Template()
     *
     * @return array
     */
    public function transactionsAction(AbstractSettlement $settlement)
    {
        return array('entity' => $settlement);
    }
}
