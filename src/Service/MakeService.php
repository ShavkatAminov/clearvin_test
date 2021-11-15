<?php

namespace App\Service;

use App\Entity\Make;
use App\Repository\VehicleTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class MakeService extends BaseService
{
    protected VehicleTypeRepository $vehicleTypeRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        VehicleTypeRepository  $vehicleTypeRepository
    )
    {
        $this->vehicleTypeRepository = $vehicleTypeRepository;
        parent::__construct($entityManager);
    }

    public function create(array $data): Make
    {
        $make = new Make();
        $make
            ->setCode($data['code'])
            ->setDescription($data['description'])
            ->setType($this->vehicleTypeRepository->findOneBy(['code' => $data['type']]))
            ->setCreatedAt();

        $this->entityManager->persist($make);
        $this->entityManager->flush();

        return $make;
    }
}