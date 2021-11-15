<?php

namespace App\Transformer\VehicleType;

use App\Entity\VehicleType;
use App\Transformer\BaseTransformer;

class VehicleTypeTransformer extends BaseTransformer
{
    /**
     * @param VehicleType $entity
     *
     * @return array
     */
    protected function format($entity): array
    {
        return [
            'code'        => $entity->getCode(),
            'description' => $entity->getDescription()
        ];
    }
}