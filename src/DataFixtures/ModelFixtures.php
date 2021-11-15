<?php

namespace App\DataFixtures;

use App\Service\ModelService;
use App\Validator\Model\ModelValidator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModelFixtures extends Fixture implements DependentFixtureInterface
{
    protected ModelService $service;
    protected ModelValidator $validator;
    public function __construct(
        ModelService $service,
        ModelValidator $validator
    )
    {
        $this->service = $service;
        $this->validator = $validator;
    }

    public function load(ObjectManager $manager): void
    {
        $data = file_get_contents('data/json/models.json');
        $models = json_decode($data, true);

        foreach ($models as $model) {
            if ($this->validator->validate($model))
                $this->service->create($model);
        }
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            TypeFixtures::class,
            MakeFixtures::class
        ];
    }
}
