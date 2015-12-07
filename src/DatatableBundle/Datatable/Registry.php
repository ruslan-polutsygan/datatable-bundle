<?php

namespace RP\DatatableBundle\Datatable;

use RP\DatatableBundle\Datatable\Config\ConfigInterface;
use RP\DatatableBundle\Util\Datatable;

class Registry
{
    /**
     * @var Datatable[]
     */
    protected $tables;

    /**
     * @var ConfigInterface[]
     */
    protected $configs;

    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
        $this->configs = [];
        $this->tables = [];
    }

    public function addConfig(ConfigInterface $config)
    {
        if (isset($this->configs[$config->getId()])) {
            throw new \InvalidArgumentException(sprintf('Datatable "%s" is already defined', $config->getId()));
        }

        $this->configs[$config->getId()] = $config;
    }

    public function getDatatable($id)
    {
        if (!isset($this->tables[$id])) {
            if (!isset($this->configs[$id])) {
                throw new \InvalidArgumentException(sprintf('Datatable "%s" is not defined', $id));
            }

            $this->tables[$id] = $this->factory->create($this->configs[$id]);
        }

        return $this->tables[$id];
    }
}
