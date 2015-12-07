<?php

namespace RP\DatatableBundle\Datatable;

use RP\DatatableBundle\Datatable\Config\ConfigInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Factory implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @param ConfigInterface $config
     *
     * @return \RP\DatatableBundle\Util\Datatable
     */
    public function create(ConfigInterface $config)
    {
        $table = $this->container->get('datatable')
            ->setEntity($config->getEntityName(), $config->getEntityAlias())
            ->setFields($config->getFields())
            ->setRenderers($config->getRenderers())
            ->setWhere($config->getWhere(), $config->getWhereParams())
            ->setOrder($config->getOrderField(), $config->getOrderDirection())
            ->setHasAction($config->isAction())
            ->setSearch($config->isSearch())
            ->setSearchFields($config->getSearchFields())
        ;

        foreach ($config->getJoins() as $join) {
            $table->addJoin($join['field'], $join['alias'], $join['type']);
        }

        return $table;
    }
}
