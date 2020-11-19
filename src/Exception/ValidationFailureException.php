<?php

namespace App\Exception;

class ValidationFailureException extends \Exception
{
    const VALIDATION_FAILURE_CODE = 01001;

    public function __construct($validationData)
    {
        parent::__construct($validationData, ValidationFailureException::VALIDATION_FAILURE_CODE, null);
    }
}