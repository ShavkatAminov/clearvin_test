<?php

namespace App\Service;

use App\Entity\VehicleType;

class VehicleTypeService extends BaseService
{
    public function create(array $data): VehicleType
    {
        $type = new VehicleType();

        $type
            ->setCode($data['code'])
            ->setDescription($data['description'])
            ->setCreatedAt();

        $this->entityManager->persist($type);
        $this->entityManager->flush();

        return $type;
    }
}