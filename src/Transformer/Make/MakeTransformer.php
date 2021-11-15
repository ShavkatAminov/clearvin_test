<?php

namespace App\Transformer\Make;

use App\Entity\Make;
use App\Transformer\BaseTransformer;

class MakeTransformer extends BaseTransformer
{
    /**
     * @param Make $entity
     *
     * @return array
     */
    protected function format($entity): array
    {
        return [
            'code'        => $entity->getCode(),
            'description' => $entity->getDescription(),
            'type'        => $entity->getType()->getCode()
        ];
    }
}