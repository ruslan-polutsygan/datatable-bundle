<?php

namespace RP\DatatableBundle\Datatable\Config;

class Config implements ConfigInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $entityName;

    /**
     * @var string
     */
    protected $entityAlias;

    /**
     * @var array
     */
    protected $fields;

    /**
     * @var array
     */
    protected $renderers;

    /**
     * @var string
     */
    protected $where;

    /**
     * @var array
     */
    protected $whereParams;

    /**
     * @var array
     */
    protected $joins;

    /**
     * @var array
     */
    protected $orderField;

    /**
     * @var string
     */
    protected $orderDirection;

    /**
     * @var bool
     */
    protected $action;

    /**
     * @var bool
     */
    protected $search;

    /**
     * @var array
     */
    protected $searchFields;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * @param string $entityName
     */
    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;
    }

    /**
     * @return string
     */
    public function getEntityAlias()
    {
        return $this->entityAlias;
    }

    /**
     * @param string $entityAlias
     */
    public function setEntityAlias($entityAlias)
    {
        $this->entityAlias = $entityAlias;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return array
     */
    public function getRenderers()
    {
        return $this->renderers;
    }

    /**
     * @param array $renderers
     */
    public function setRenderers(array $renderers)
    {
        $this->renderers = $renderers;
    }

    /**
     * @return string
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * @param string $where
     */
    public function setWhere($where)
    {
        $this->where = $where;
    }

    /**
     * @return array
     */
    public function getWhereParams()
    {
        return $this->whereParams;
    }

    /**
     * @param array $whereParams
     */
    public function setWhereParams(array $whereParams = [])
    {
        $this->whereParams = $whereParams;
    }

    /**
     * @return array
     */
    public function getJoins()
    {
        return $this->joins;
    }

    /**
     * @param array $joins
     */
    public function setJoins(array $joins)
    {
        $this->joins = $joins;
    }

    /**
     * @return string
     */
    public function getOrderField()
    {
        return $this->orderField;
    }

    /**
     * @param string $orderField
     */
    public function setOrderField($orderField)
    {
        $this->orderField = $orderField;
    }

    /**
     * @return string
     */
    public function getOrderDirection()
    {
        return $this->orderDirection;
    }

    /**
     * @param string $orderDirection
     */
    public function setOrderDirection($orderDirection)
    {
        $this->orderDirection = $orderDirection;
    }
    /**
     * @return bool
     */
    public function isAction()
    {
        return $this->action;
    }

    /**
     * @param bool $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return bool
     */
    public function isSearch()
    {
        return $this->search;
    }

    /**
     * @param bool $search
     */
    public function setSearch($search)
    {
        $this->search = $search;
    }

    /**
     * @return array
     */
    public function getSearchFields()
    {
        return $this->searchFields;
    }

    /**
     * @param array $searchFields
     */
    public function setSearchFields(array $searchFields)
    {
        $this->searchFields = $searchFields;
    }
}
