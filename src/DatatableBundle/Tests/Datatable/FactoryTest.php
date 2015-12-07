<?php

namespace RP\DatatableBundle\Tests\Datatable;

use RP\DatatableBundle\Datatable\Config\Config;
use RP\DatatableBundle\Datatable\Factory;
use Symfony\Component\DependencyInjection\Container;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_config_values_passed_to_datatable_instance()
    {
        $config = new Config();
        $config->setId('some_key');
        $config->setEntityName('EntityName');
        $config->setEntityAlias('en');
        $config->setFields(['k' => 'v']);
        $config->setRenderers(['k1' => 'v1']);
        $config->setWhere('where = :yes');
        $config->setWhereParams(['k3' => 'v3']);
        $config->setOrderField('Order');
        $config->setOrderDirection('ASC');
        $config->setAction(true);
        $config->setSearch(false);
        $config->setSearchFields(['k2' => 'v2']);
        $config->setJoins([
            ['field' => 'F', 'alias' => 'a', 'type' => 'T'],
            ['field' => 'F1', 'alias' => 'a1', 'type' => 'T1'],
        ]);

        $datatableProphecy = $this->prophesize('\RP\DatatableBundle\Util\Datatable');
        $datatable = $datatableProphecy->reveal();

        $datatableProphecy->setEntity('EntityName', 'en')->willReturn($datatable)->shouldBeCalledTimes(1);
        $datatableProphecy->setFields(['k' => 'v'])->willReturn($datatable)->shouldBeCalledTimes(1);
        $datatableProphecy->setRenderers(['k1' => 'v1'])->willReturn($datatable)->shouldBeCalledTimes(1);
        $datatableProphecy->setWhere('where = :yes', ['k3' => 'v3'])->willReturn($datatable)->shouldBeCalledTimes(1);
        $datatableProphecy->setOrder('Order', 'ASC')->willReturn($datatable)->shouldBeCalledTimes(1);
        $datatableProphecy->setHasAction(true)->willReturn($datatable)->shouldBeCalledTimes(1);
        $datatableProphecy->setSearch(false)->willReturn($datatable)->shouldBeCalledTimes(1);
        $datatableProphecy->setSearchFields(['k2' => 'v2'])->willReturn($datatable)->shouldBeCalledTimes(1);
        $datatableProphecy->addJoin('F', 'a', 'T')->willReturn($datatable)->shouldBeCalledTimes(1);
        $datatableProphecy->addJoin('F1', 'a1', 'T1')->willReturn($datatable)->shouldBeCalledTimes(1);

        $container = new Container();
        $container->set('datatable', $datatable);

        $factory = new Factory();
        $factory->setContainer($container);

        $this->assertEquals($datatable, $factory->create($config));
    }
}
