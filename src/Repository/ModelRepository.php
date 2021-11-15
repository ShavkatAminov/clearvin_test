<?php

namespace App\Repository;

use App\Entity\Make;
use App\Entity\Model;
use App\Entity\VehicleType;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Model|null find($id, $lockMode = null, $lockVersion = null)
 * @method Model|null findOneBy(array $criteria, array $orderBy = null)
 * @method Model[]    findAll()
 * @method Model[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Model::class);
    }

    public function getModelsOfTypeAndMake(
        VehicleType  $type,
        Make         $make,
        QueryBuilder $query = null
    ): QueryBuilder
    {
        if (!$query)
            $query = $this->createQueryBuilder('a');

        return $query
            ->andWhere('a.type = :type')
            ->andWhere('a.make = :make')
            ->setParameter('type', $type)
            ->setParameter('make', $make);
    }

    // /**
    //  * @return Model[] Returns an array of Model objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Model
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
