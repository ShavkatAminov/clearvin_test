<?php

namespace App\Transformer\Model;

use App\Entity\Model;
use App\Transformer\BaseTransformer;

class ModelTransformer extends BaseTransformer
{
    /**
     * @param Model $entity
     *
     * @return array
     */
    protected function format($entity): array
    {
        return [
            'code'        => $entity->getCode(),
            'description' => $entity->getDescription(),
            'type'        => $entity->getType()->getCode(),
            'group'       => $entity->getMake()->getCode()
        ];
    }
}