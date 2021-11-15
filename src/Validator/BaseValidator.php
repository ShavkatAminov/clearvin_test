<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseValidator
{
    protected array $errors;

    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;

    /**
     * BaseValidator constructor.
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator) {
        $this->errors = [];
        $this->validator = $validator;
    }

    /**
     * @param array|null $data
     * @return bool
     */
    public function validate(?array $data): bool
    {
        $this->errors = [];
        $constraintViolations = $this->validator->validate($data, new Collection($this->getConstraints()));
        if (!empty($constraintViolations)) {
           foreach ($constraintViolations as $constraintViolation) {
               $this->errors[$constraintViolation->getPropertyPath()][] = $constraintViolation->getMessage();
           }
        }
        $this->afterValidate();
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    protected function addError(string $key, string $message)
    {
        if (!empty($this->errors[$key])) {
            $this->errors[$key][] = $message;
        } else {
            $this->errors[$key] = [$message];
        }
    }

    protected function afterValidate()
    {

    }

    /**
     * @return array
     */
    protected abstract function getConstraints();
}