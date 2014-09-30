<?php

namespace Shopline\PSP\ReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Shopline\PSP\ReportBundle\Entity\Provider\AbstractSettlementProvider;
use Shopline\PSP\ReportBundle\Entity\Settlement\AbstractSettlement;

class ReportController extends Controller
{
    /**
     * @param AbstractSettlementProvider $provider
     *
     * @Route("/provider/{id}/settlements", name="psp.report.index")
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
     * @Route("/settlement/{id}/details", name="psp.report.view", requirements={"id"="\d+"}))
     * @Template()
     *
     * @return array
     */
    public function viewAction(AbstractSettlement $settlement)
    {
        return array('settlement' => $settlement);
    }
}
