<?php

namespace App\Service;

use App\Exception\ValidationFailureException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class Validator
 * @package App\Service
 */
class Validator
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * Validator constructor.
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Validates an model object and returns it as an array if no errors occurred
     *
     * @param array|string $data
     * @param string $model
     * @throws ValidationFailureException
     * @return array
     */
    public function validate($data, string $model)
    {
        $object = $this->prepareModel($data, $model);
        $errors = $this->validator->validate($object);

        if (count($errors) > 0) {
            throw new  ValidationFailureException($this->formatErrors($errors));
        }

        // Theoretically we could return back $data but because it comes from the user input
        // And it can contain additional data witch is not required for request and not belongs to be in array
        // We should avoid returning it back, so the safest way is to return deserialized object as an array
        return (array) $object;
    }

    /**
     * Deserialize data to a given model object
     * Supported data types: JSON, ARRAY
     *
     * @param $data
     * @param string $model
     * @return object
     */
    private function prepareModel($data, string $model)
    {
        return $this->serializer->deserialize(json_encode($data), $model, 'json');
    }

    /**
     * @param ConstraintViolationListInterface $list
     * @return array
     */
    private function formatErrors(ConstraintViolationListInterface $list)
    {
        /** @var array $errors */
        $errors = [];

        foreach ($list as $error) {
            $errors[$error->getPropertyPath()] = [
                'code' => $error->getConstraint()->payload,
                'message' => $error->getMessage()
            ];
        }

        return json_encode($errors);
    }
}