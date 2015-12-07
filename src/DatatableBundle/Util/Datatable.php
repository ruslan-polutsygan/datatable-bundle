<?php

namespace RP\DatatableBundle\Util;

use Symfony\Component\DependencyInjection\ContainerInterface;
use RP\DatatableBundle\Util\Factory\Query\DoctrineBuilder;
use Ali\DatatableBundle\Util\Datatable as BaseDatatable;

class Datatable extends BaseDatatable
{
    /**
     * class constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->_container = $container;
        $this->_config = $this->_container->getParameter('ali_datatable');
        $this->_em = $this->_container->get('doctrine.orm.entity_manager');
        $this->_request = $this->_container->get('request');
        $this->_queryBuilder = new DoctrineBuilder($container, $this->_em);
        self::$_current_instance = $this;
        $this->_applyDefaults();
    }
}
