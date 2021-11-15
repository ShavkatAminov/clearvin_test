<?php

namespace App\Controller;


use App\Transformer\BaseTransformer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BaseController extends AbstractController
{

    /**
     * @param string          $nameArray
     * @param QueryBuilder    $queryBuilder
     * @param BaseTransformer $transformer
     * @param array|null      $messages
     *
     * @return JsonResponse
     */
    protected function formattedResponse(
        string          $nameArray,
        QueryBuilder    $queryBuilder,
        BaseTransformer $transformer,
        array           $messages = []
    ): JsonResponse
    {
        $result = [
            'status'   => 200,
            'messages' => $messages,
            'total'    => count(new Paginator($queryBuilder)),
            $nameArray => $transformer->getFormattedData($queryBuilder->getQuery()->execute())
        ];

        return new JsonResponse($result);
    }

    /**
     * @param ServiceEntityRepository $repository
     * @param                         $value
     * @param string                  $field
     *
     * @return object
     */
    protected function findOneOrNotFound(ServiceEntityRepository $repository, $value, string $field = 'code'): object
    {
        if (!$entity = $repository->findOneBy([$field => $value])) {
            throw new NotFoundHttpException();
        }
        return $entity;
    }

    /**
     * @param ServiceEntityRepository $repository
     * @param                         $value
     * @param string                  $field
     *
     * @return object|null
     */
    protected function findOneOrNull(ServiceEntityRepository $repository, $value, string $field = 'code'): ?object
    {
        if (!$entity = $repository->findOneBy([$field => $value])) {
            return null;
        }
        return $entity;
    }
}