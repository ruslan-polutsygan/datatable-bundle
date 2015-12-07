<?php

namespace RP\DatatableBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as Extra;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DatatableController extends Controller
{
    /**
     * @Extra\Route("/grid", name="datatable_grid")
     */
    public function gridAction(Request $request)
    {
        $datatableId = $request->query->get('e');
        $dataTable = $this->get('datatable.registry')->getDatatable($datatableId);

        /** @var Response $response */
        $response = $dataTable->execute();
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
