<?php

namespace App\DataFixtures;

use App\Service\MakeService;
use App\Validator\Make\MakeValidator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MakeFixtures extends Fixture implements DependentFixtureInterface
{
    protected MakeService $service;
    protected MakeValidator $validator;

    public function __construct(
        MakeService $service,
        MakeValidator $validator
    )
    {
        $this->service = $service;
        $this->validator = $validator;
    }

    public function load(ObjectManager $manager): void
    {
        $data = file_get_contents('data/json/makes.json');
        $makes = json_decode($data, true);

        foreach ($makes as $make) {
            if ($this->validator->validate($make))
                $this->service->create($make);
        }
    }

    public function getDependencies(): array
    {
        return [
          TypeFixtures::class
        ];
    }
}
