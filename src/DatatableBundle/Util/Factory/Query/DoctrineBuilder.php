<?php

namespace RP\DatatableBundle\Util\Factory\Query;

use Ali\DatatableBundle\Util\Factory\Query\DoctrineBuilder as BaseDoctrineBuilder;

class DoctrineBuilder extends BaseDoctrineBuilder
{
    /**
     * get the search dql.
     *
     * @return string
     */
    protected function _addSearch(\Doctrine\ORM\QueryBuilder $queryBuilder)
    {
        if ($this->search == true) {
            $request = $this->request;
            $search_fields = array_values($this->fields);
            foreach ($search_fields as $i => $search_field) {
                $search_param = $request->get("sSearch_{$i}");

                if ($request->get("sSearch_{$i}") !== false && !empty($search_param)) {
                    $field = explode(' ', trim($search_field));
                    $search_field = $field[0];
                    if (preg_match('/~/', $search_param)) {
                        $search_params = explode('~', $search_param);
                        $from_date = date('Y-m-d 00:00:00', strtotime($search_params[0]));
                        $to_date = date('Y-m-d 23:59:59', strtotime($search_params[1]));
                        if (($search_params[0] == '' || $from_date < '2000-01-01 00:00:00') && ($search_params[1] == '' || $to_date < '2000-01-01 00:00:00')) {
                            // both date fields are empty/invalid -- do nothing
                        } elseif ($search_params[0] == '' || $from_date < '2000-01-01 00:00:00') {
                            $queryBuilder->andWhere(" $search_field <= '$to_date' ");
                        } elseif ($search_params[1] == '' || $to_date < '2000-01-01 00:00:00') {
                            $queryBuilder->andWhere(" $search_field >= '$from_date' ");
                        } else {
                            $queryBuilder->andWhere(" $search_field between '$from_date' and '$to_date' ");
                        }
                    } else {
                        $queryBuilder->andWhere(" $search_field like '%{$request->get("sSearch_{$i}")}%' ");
                    }
                }
            }
        }
    }
}
