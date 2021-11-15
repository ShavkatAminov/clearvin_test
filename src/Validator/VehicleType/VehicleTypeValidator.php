<?php

namespace App\Validator\VehicleType;

use App\Validator\BaseValidator;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class VehicleTypeValidator extends BaseValidator
{

    protected function getConstraints(): array
    {
        return [
            'code' => [
                new Type('string'),
                new NotNull()
            ],
            'description' => [
                new Type('string'),
                new NotNull()
            ]
        ];
    }
}