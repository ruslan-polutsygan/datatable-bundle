<?php

namespace RP\DatatableBundle\Datatable\Config;

interface ConfigInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getEntityName();

    /**
     * @return string
     */
    public function getEntityAlias();

    /**
     * @return array
     */
    public function getFields();

    /**
     * @return array
     */
    public function getRenderers();

    /**
     * @return string
     */
    public function getWhere();

    /**
     * @return array
     */
    public function getWhereParams();

    /**
     * @return array
     */
    public function getJoins();

    /**
     * @return string
     */
    public function getOrderField();

    /**
     * @return string
     */
    public function getOrderDirection();

    /**
     * @return bool
     */
    public function isAction();

    /**
     * @return bool
     */
    public function isSearch();

    /**
     * @return array
     */
    public function getSearchFields();
}
