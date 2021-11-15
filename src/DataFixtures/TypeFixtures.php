<?php

namespace App\DataFixtures;

use App\Service\VehicleTypeService;
use App\Validator\VehicleType\VehicleTypeValidator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    protected VehicleTypeService $service;
    protected VehicleTypeValidator $validator;

    public function __construct(
        VehicleTypeService   $service,
        VehicleTypeValidator $validator
    )
    {
        $this->service = $service;
        $this->validator = $validator;
    }

    public function load(ObjectManager $manager): void
    {
        $data = file_get_contents('data/json/vehicle_types.json');
        $types = json_decode($data, true);

        foreach ($types as $type) {
            if ($this->validator->validate($type))
                $this->service->create($type);
        }
    }
}
