<?php

namespace App\Service;

use App\Entity\Model;
use App\Repository\MakeRepository;
use App\Repository\VehicleTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ModelService extends BaseService
{
    protected VehicleTypeRepository $vehicleTypeRepository;
    protected MakeRepository $makeRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        VehicleTypeRepository  $vehicleTypeRepository,
        MakeRepository         $makeRepository
    )
    {
        $this->vehicleTypeRepository = $vehicleTypeRepository;
        $this->makeRepository = $makeRepository;
        parent::__construct($entityManager);
    }

    public function create(array $data): Model
    {
        $model = new Model();

        $model
            ->setCode($data['code'])
            ->setDescription($data['description'])
            ->setType($this->vehicleTypeRepository->findOneBy(['code' => $data['type']]))
            ->setMake($this->makeRepository->findOneBy(['code' => $data['group']]))
            ->setCreatedAt();

        $this->entityManager->persist($model);
        $this->entityManager->flush();

        return $model;
    }
}