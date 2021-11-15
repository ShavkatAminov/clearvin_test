<?php

namespace App\Validator\Make;

use App\Repository\VehicleTypeRepository;
use App\Validator\BaseValidator;
use App\Validator\Constraint\EntityExists;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MakeValidator extends BaseValidator
{
    protected VehicleTypeRepository $vehicleTypeRepository;

    public function __construct(
        ValidatorInterface    $validator,
        VehicleTypeRepository $vehicleTypeRepository
    )
    {
        $this->vehicleTypeRepository = $vehicleTypeRepository;
        parent::__construct($validator);
    }

    protected function getConstraints(): array
    {
        return [
            'code'        => [
                new Type('string'),
                new NotNull()
            ],
            'description' => [
                new Type('string'),
                new NotNull()
            ],
            'type'        => [
                new Type('string'),
                new NotNull(),
                new EntityExists($this->vehicleTypeRepository, 'code')
            ]
        ];
    }
}