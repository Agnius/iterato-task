<?php

namespace App\Model\Request;

use App\Model\RequestModelInterface;
use Symfony\Component\Validator\Constraints as Assert;

class WeatherRequest implements RequestModelInterface
{
    /**
     * @Assert\NotBlank(message="api_key cannot be empty", payload="101")
     */
    public $api_key;

    /**
     * @Assert\NotBlank(message="City cannot be blank", payload="102")
     */
    public $city;

    public function getName(): string
    {
        return 'weather_request';
    }
}