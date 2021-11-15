<?php

namespace App\Validator\Model;

use App\Repository\MakeRepository;
use App\Repository\VehicleTypeRepository;
use App\Validator\BaseValidator;
use App\Validator\Constraint\EntityExists;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ModelValidator extends BaseValidator
{
    protected VehicleTypeRepository $vehicleTypeRepository;
    protected MakeRepository $makeRepository;

    public function __construct(
        ValidatorInterface    $validator,
        VehicleTypeRepository $vehicleTypeRepository,
        MakeRepository        $makeRepository
    )
    {
        parent::__construct($validator);
        $this->vehicleTypeRepository = $vehicleTypeRepository;
        $this->makeRepository = $makeRepository;
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
            ],
            'group'       => [
                new Type('string'),
                new NotNull(),
                new EntityExists($this->makeRepository, 'code')
            ]
        ];
    }
}