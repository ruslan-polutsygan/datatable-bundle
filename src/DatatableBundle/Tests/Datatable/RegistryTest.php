<?php

namespace RP\DatatableBundle\Tests\Datatable;

use RP\DatatableBundle\Datatable\Config\Config;
use RP\DatatableBundle\Datatable\Registry;

class RegistryTest extends \PHPUnit_Framework_TestCase
{
    public function test_config_added_to_internal_storage()
    {
        $factory = $this->prophesize('\RP\DatatableBundle\Datatable\Factory');
        $registry = new Registry($factory->reveal());

        $config = new Config();
        $config->setId('some_key');

        // guard
        $this->assertAttributeCount(0, 'configs', $registry);

        $registry->addConfig($config);

        $this->assertAttributeCount(1, 'configs', $registry);
        $this->assertAttributeContains($config, 'configs', $registry);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedMessage Datatable "some_key" is already defined
     */
    public function test_exception_thrown_if_config_key_is_busy()
    {
        $factory = $this->prophesize('\RP\DatatableBundle\Datatable\Factory');
        $registry = new Registry($factory->reveal());

        $config1 = new Config();
        $config1->setId('some_key');

        $config2 = new Config();
        $config2->setId('some_key');

        $registry->addConfig($config1);
        $registry->addConfig($config2);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedMessage Datatable "some_key2" is not defined
     */
    public function test_exception_thrown_if_datatable_is_not_configured()
    {
        $factory = $this->prophesize('\RP\DatatableBundle\Datatable\Factory');
        $registry = new Registry($factory->reveal());

        $config = new Config();
        $config->setId('some_key');

        // guard
        $this->assertAttributeCount(0, 'configs', $registry);

        $registry->addConfig($config);

        $registry->getDatatable('some_key2');
    }

    public function test_datatable_created_via_factory()
    {
        $config = new Config();
        $config->setId('some_key');

        $factory = $this->prophesize('\RP\DatatableBundle\Datatable\Factory');
        $factory->create($config)->willReturn('something')->shouldBeCalled();

        $registry = new Registry($factory->reveal());
        $registry->addConfig($config);

        $this->assertEquals('something', $registry->getDatatable('some_key'));
    }

    public function test_datatable_put_in_internal_storage()
    {
        $config = new Config();
        $config->setId('some_key');

        $factory = $this->prophesize('\RP\DatatableBundle\Datatable\Factory');
        $factory->create($config)->willReturn('something')->shouldBeCalled();

        $registry = new Registry($factory->reveal());
        $registry->addConfig($config);

        // guard
        $this->assertAttributeCount(0, 'tables', $registry);

        $registry->getDatatable('some_key');

        $this->assertAttributeCount(1, 'tables', $registry);
        $this->assertAttributeContains('something', 'tables', $registry);
    }

    public function test_factory_called_only_on_first_request()
    {
        $config = new Config();
        $config->setId('some_key');

        $factory = $this->prophesize('\RP\DatatableBundle\Datatable\Factory');
        $factory->create($config)->willReturn('something')->shouldBeCalledTimes(1);

        $registry = new Registry($factory->reveal());
        $registry->addConfig($config);

        $registry->getDatatable('some_key');
        $registry->getDatatable('some_key');
        $registry->getDatatable('some_key');
    }
}
