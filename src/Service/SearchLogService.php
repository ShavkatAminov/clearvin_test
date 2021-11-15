<?php

namespace App\Service;

use App\Entity\SearchLog;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;

class SearchLogService extends BaseService
{
    public function create(
        Request      $request,
        QueryBuilder $query
    ): SearchLog
    {
        $searchLog = new SearchLog();
        $searchLog
            ->setMake($request->get('make'))
            ->setType($request->get('type'))
            ->setCount(count($query->getQuery()->execute()))
            ->setIpAddress($request->getClientIp())
            ->setUserAgent($request->headers->get('User-Agent'))
            ->setRequestTime();

        $this->entityManager->persist($searchLog);
        $this->entityManager->flush();

        return $searchLog;
    }
}