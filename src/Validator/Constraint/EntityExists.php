<?php


namespace App\Validator\Constraint;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Validator\Constraint;

class EntityExists extends Constraint
{
    public string $message = 'The item "{{ string }}" does not exist in the system.';
    public string $messageInteger = 'The item "{{ string }}" must be of the type integer.';

    public ServiceEntityRepository $repository;
    public string $field;

    public function __construct(
        ServiceEntityRepository $repository,
        string                  $field = 'id',
                                $options = null,
        array                   $groups = null,
                                $payload = null
    )
    {
        parent::__construct($options, $groups, $payload);
        $this->repository = $repository;
        $this->field = $field;
    }
}