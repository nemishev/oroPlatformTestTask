<?php

namespace Shopline\PSP\ReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Shopline\PSP\ReportBundle\Entity\Provider\AbstractSettlementProvider;

class ProviderController extends Controller
{
    /**
     * @param AbstractSettlementProvider $provider
     *
     * @Route("/settlement-provider/{id}/info", name="psp.report.provider.info", requirements={"id"="\d+"}))
     * @Template()
     *
     * @return array
     */
    public function infoAction(AbstractSettlementProvider $provider)
    {
        return array('entity' => $provider);
    }
} 