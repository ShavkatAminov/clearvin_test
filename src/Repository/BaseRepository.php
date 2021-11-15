<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;


abstract class BaseRepository extends ServiceEntityRepository
{
    /**
     * @param Request           $request
     * @param QueryBuilder|null $query
     *
     * @return QueryBuilder
     */
    public function filterPageAndLimit(
        Request      $request,
        QueryBuilder $query = null
    ): QueryBuilder
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 50);

        if (!$query)
            $query = $this->createQueryBuilder('a');

        return $query
            ->setMaxResults(+$limit)
            ->setFirstResult(($page - 1) * $limit);
    }

    /**
     * @param Request           $request
     * @param QueryBuilder|null $query
     * @param array             $mapping
     *
     * @return QueryBuilder
     */
    public function orderBy(
        Request      $request,
        QueryBuilder $query = null,
        array        $mapping = []
    ): QueryBuilder
    {

        $order = $request->get('order', 'ASC');
        $orderBy = $request->get('order_by', 'code');
        $orderBy = $this->isField($mapping, $orderBy) ?? 'code';
        if (!$query)
            $query = $this->createQueryBuilder('a');

        return $query
            ->addOrderBy("a.$orderBy", $order);
    }

    private function isField($mapping, $filed)
    {
        $class = $this->_class;

        // check mapping is existing
        if (isset($mapping[$filed]))
            $filed = $mapping[$filed];

        // check entity fields is existing
        if (!isset($class->fieldMappings[$filed])) {
            return null;
        }

        return $filed;
    }
}
